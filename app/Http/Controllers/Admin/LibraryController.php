<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LibraryController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function library_book_list()
    {
       
      return view('admin.library.library-book-list');

    }
    
    
    public function add_library_book()
    {
       
      return view('admin.library.add-library-book');

    }
    
    
    public function all_subject()
    {
       
      return view('admin.subject.all-subject');

    }
    
    
    
    public function get_subject(Request $request)
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
    $total = SchoolSubject::where('school_id', Auth::guard('admin')->user()->school_id)
        ->where('status', 'ACTIVE')
        ->count();

    // Get filtered records
    $students = SchoolSubject::select('school_subject.*')
    
        ->where('school_id', Auth::guard('admin')->user()->school_id)
        ->where('status', 'ACTIVE')
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('name', 'like', '%' . $search . '%');
                $q->orWhere('subject_code', 'like', '%' . $search . '%');    
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
       

        $data[] = [
            $i++,
            $student->name,
            $student->subject_code,
            '<button type="button" data-id="'.$student->id.'"  
                class="btn btn-sm btn-outline-primary" style="font-size: 16px; padding: 0px 16px;" title="Edit">
                <i class="fas fa-pen"></i>
            </button> <button class="btn btn-danger btn-icon-sm delete-btn" data-id="'.$student->id.'" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>'

        ];
    }

    // Final JSON response
    return response()->json([
        'recordsTotal' => $total,
        'recordsFiltered' => $total,
        'data' => $data
    ]);
   }
   
   
   
   public function save_subject(Request $request)
{
    DB::beginTransaction();

    try {
        $schoolId = Auth::guard('admin')->user()->school_id;

        // ✅ Step 1: Validation with unique per school_id
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('school_subject')->where(function ($query) use ($schoolId) {
                    return $query->where('school_id', $schoolId);
                }),
            ]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msg'    => $validator->errors()->first()
            ]);
        }

        // ✅ Step 2: Save class
        $sch = new SchoolSubject();
        $sch->school_id = $schoolId;
        $sch->name = $request->name;
        $sch->subject_code = $request->subject_code;
        $sch->save();

        DB::commit();

        return response()->json([
            'status'   => true,
            'msg'      => "Subject added successfully",
            'location' => '/school/admin/all-subject'
        ], 201);

    } catch (\Exception $e) {
        DB::rollback();

        return response()->json([
            'status' => false,
            'msg'    => "Something went wrong. Please try again later.",
            'error'  => $e->getMessage() // Optional: remove in production
        ], 500);
    }
    }
    
    
    
    
    public function delete_subject(Request $request)
            {
                
                try {
                    
                    $feeType = SchoolSubject::where('school_id', Auth::guard('admin')->user()->school_id)->where('id', $request->id)->first();
                    
            
                    if (!$feeType) {
                        return response()->json([
                            'status' => false,
                            'msg' => 'Student class not found.'
                        ]);
                    }
            
                    $feeType->delete();
            
                    return response()->json([
                        'status' => true,
                        'msg' => 'Subject deleted successfully.'
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => false,
                        'msg' => 'Something went wrong. Please try again.'
                    ]);
                }
            }
    
    

    


}
