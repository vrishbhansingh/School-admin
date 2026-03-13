<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Parents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use NumberToWords\NumberToWords;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Validator;

class ParentController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function parent_list()
    {
       
      return view('admin.parent.parent-list');

    }
    
    public function parent_details()
    {
       
      return view('admin.parent.parent-details');

    }
    
    public function add_parent()
    {
        
        $class = SchoolClass::where('school_id', Auth::guard('admin')->user()->school_id)->get();
       
      return view('admin.parent.add-parent', compact('class'));

    }
    
    
    
    public function save_parent(Request $request)
       {
           
           date_default_timezone_set("Asia/Kolkata");
    
        $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'gender'       => 'required|string|max:255',
        'photo'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'msg'    => $validator->errors()->first()
        ]);
    }
    
       $photoPath = null;
       
       // Upload student photo
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time().'_photo.'.$photo->getClientOriginalExtension();
            $photo->move(public_path('admin/student'), $photoName);
            $photoPath = $photoName;
        }
        
        // Fetch student_fees rows for the given student/month/year
        $studentFees = Parents::where('school_id', Auth::guard('admin')->user()->school_id)->where('phone', $request->phone)->first();
        
        if($studentFees && $studentFees->phone==$request->phone){
        return response()->json([
                'status' => false,
                'msg'    => 'Phone Number aleady exists.'
            ]);
    } 

        
        $payment = new Parents();
        $payment->school_id     = Auth::guard('admin')->user()->school_id;
        $payment->name          = $request->name;
        $payment->email         = $request->email ?? 0;
        $payment->phone         = $request->phone ?? 0;
        $payment->gender        = $request->gender ?? 0;
        $payment->address       = $request->address;
        $payment->religion      = $request->religion;
        $payment->photo         = $photoPath;
        $result = $payment->save();

        

        if($result){
        
        return response()->json([
            'status'   => true,
            'msg'      => "Parent Successfully Added",
            
        ]);
    }else{
        return response()->json([
                'status' => false,
                'msg'    => 'Something went wrong'
            ]);
    }

    }
    
    
    
    
    public function get_parent_list(Request $request)
          {
    $search = $request->input('search.value', '');
    $limit = $request->input('length', 10);
    $ofset = $request->input('start', 0);

    // Default sorting
    $orderColumnIndex = $request->input('order.0.column', 0);
    $orderType = $request->input('order.0.dir', 'desc');
    $columns = $request->input('columns', []);
    $nameOrder = isset($columns[$orderColumnIndex]['name']) ? $columns[$orderColumnIndex]['name'] : 'id';

    // Get total count
    $total = Parents::where('school_id', Auth::guard('admin')->user()->school_id)
        
        ->count();

    // Get filtered records
    $students = Parents::where('school_id', Auth::guard('admin')->user()->school_id)
        
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%');
                    
            });
        })
        ->offset($ofset)
        ->limit($limit)
        ->orderBy($nameOrder, $orderType)
        ->get();

    // Format data
    $data = [];
    $i = $ofset + 1;

    foreach ($students as $student) {
        
        $img = '<img src="'.url('public/admin/student/'.$student->photo.'').'" style="width:60px;">';
        
        if($student->status== 'ACTIVE'){
            $status= '<i class="fas fa-circle text-success ml-2" title="Active"></i>';
            
        }else{
            $status = '<i class="fas fa-circle text-danger ml-2" title="Inactive"></i>';
        }

        $data[] = [
            $status.'  '.$i++,
            $img,
            '<div style="width:100px;"><a href="'.url('/admin/parent-details/'.base64_encode($student->id).'').'">'.$student->name.'</a></div>',
            $student->email,
            $student->phone,
            $student->gender,
            $student->address,
        ];
    }

    // Final JSON response
    return response()->json([
        'recordsTotal' => $total,
        'recordsFiltered' => $total,
        'data' => $data
    ]);
   }

    


}
