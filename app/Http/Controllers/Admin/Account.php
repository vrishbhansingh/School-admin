<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\UserPlanExport;
use Maatwebsite\Excel\Facades\Excel;

class Account extends Controller
{
    /**
     * Show the admin dashboard.
     */
    
    
    
    public function all_expense()
    {
       
      return view('admin.account.all-expense');

    }
    
    public function add_expense()
    {
       
      return view('admin.account.add-expense');

    }
    
    
    public function account_setting()
    {
       
      return view('admin.account.account-settings');

    }
    
    
    public function notice_board()
    {
       
      return view('admin.account.notice-board');

    }
    
    public function account_security()
    {
       
      return view('admin.setting.account-security');

    }
    
    
                

                

            public function change_account_security(Request $request)
{
    $validator = Validator::make($request->all(), [
        'old_password'      => 'required',
        'new_password'      => 'required|min:6',
        'confirm_password'  => 'required|same:new_password',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'msg'    => $validator->errors()->first()
        ]);
    }

    $user = Auth::user();

    try {
        // Check if old password is correct
        if (!(password_verify($request->old_password, $user->password))) {
            return response()->json([
                'status' => false,
                'msg'    => 'Old password is incorrect.'
            ]);
        }

        // Prevent using the same password again
        if ($request->old_password === $request->new_password) {
            return response()->json([
                'status' => false,
                'msg'    => 'New password cannot be the same as old password.'
            ]);
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'status'   => true,
            'msg'      => 'Password updated successfully.',
            'location' => '/school/admin/dashboard'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'msg'    => 'Something went wrong: ' . $e->getMessage()
        ]);
    }
    }
    
    
    public function plan_list()
    {
       
      return view('admin.account.plan_list');

    }
    
    
    
    public function exportUserPlanPDF(Request $request)
    {
        set_time_limit(120); // ✅ This line added
        $totalMembers = (int) $request->totalMembers;
        $totalLevels  = (int) $request->totalLevels;

        $data = $this->generateUserPlan($totalMembers, $totalLevels);

        // Blade view se PDF banayein
        $pdf = Pdf::loadView('admin.account.userplan_pdf', compact('data', 'totalMembers', 'totalLevels'));

        return $pdf->download('user_plan.pdf');
    }
    
    
    

    
    private function generateUserPlan($totalMembers, $totalLevels)
{
    $levelIncentives = [
        1 => 5000,
        2 => 4000,
        3 => 4000,
        4 => 4000,
        5 => 8000,
        6 => 16000,
        7 => 32000,
        8 => 64000,
        9 => 128000,
        10 => 256000,
        11 => 512000,
        12 => 1024000,
        13 => 2048000,
        14 => 4096000,
        15 => 8192000,
    ];

    $records = [];

    // Step 1: Initialize users with parent-child relation
    for ($id = 1; $id <= $totalMembers; $id++) {
        $username = 'A' . $id;
        $parent = $id == 1 ? null : 'A' . floor($id / 2);

        $records[$username] = [
            'Username'      => $username,
            'Parent'        => $parent,
            'Left'          => null,
            'Right'         => null,
            'Current Level' => 0,
            'Total Income'  => 0,
            'Income History'=> []
        ];

        // assign children to parent
        if ($parent) {
            if ($records[$parent]['Left'] === null) {
                $records[$parent]['Left'] = $username;
            } else {
                $records[$parent]['Right'] = $username;
            }
        }
    }

    // Step 2: Process level completion
    $updated = true;
    while ($updated) {
        $updated = false;
        foreach ($records as $user => &$data) {
            $nextLevel = $data['Current Level'] + 1;
            if ($nextLevel > $totalLevels) continue;

            $left  = $data['Left'];
            $right = $data['Right'];
            if (!$left || !$right) continue; // need both children

            // ✅ Level 1 condition → just left & right member exist
            if ($nextLevel == 1) {
                if ($records[$left] && $records[$right]) {
                    $data['Current Level'] = 1;
                    $incentive = $levelIncentives[1];
                    $data['Total Income'] += $incentive;
                    $data['Income History'][] = "{$user} achieved Level 1 and earned ₹{$incentive}";
                    $updated = true;
                }
            } else {
                // ✅ Level >1 → both children must complete (nextLevel-1)
                if ($records[$left]['Current Level'] >= $nextLevel-1 &&
                    $records[$right]['Current Level'] >= $nextLevel-1) {

                    $data['Current Level'] = $nextLevel;
                    $incentive = $levelIncentives[$nextLevel] ?? 0;
                    $data['Total Income'] += $incentive;
                    $data['Income History'][] = "{$user} achieved Level {$nextLevel} and earned ₹{$incentive}";
                    $updated = true;
                }
            }
        }
    }

    return array_values($records);
}


    /**
     * ✅ Export to Excel
     */
    public function exportUserPlanExcel(Request $request)
    {
        set_time_limit(300);
        ini_set('memory_limit', '512M');

        $totalMembers = (int) $request->totalMembers;
        $totalLevels  = (int) $request->totalLevels;

        $data = $this->generateUserPlan($totalMembers, $totalLevels);

        return Excel::download(new UserPlanExport($data), 'user_plan.xlsx');
    }







    
    
    
    
    


}
