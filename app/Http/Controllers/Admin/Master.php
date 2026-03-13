<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentRegistration;
use App\Models\School;
use App\Models\SchoolClass;
use App\Models\SchoolSection;
use App\Models\StudentAddmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Master extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function class_list()
    {
       
      return view('admin.master.class-list');

    }
    
    
    
    
    public function get_class(Request $request)
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
    $total = SchoolClass::where('school_id', Auth::guard('admin')->user()->school_id)
        ->where('status', 'ACTIVE')
        ->count();

    // Get filtered records
    $students = SchoolClass::select('school_class.*')
        ->where('school_id', Auth::guard('admin')->user()->school_id)
        ->where('status', 'ACTIVE')
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('name', 'like', '%' . $search . '%');
                    
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
   
   
   
          

public function save_class(Request $request)
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
                Rule::unique('school_class')->where(function ($query) use ($schoolId) {
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
        $sch = new SchoolClass();
        $sch->school_id = $schoolId;
        $sch->name = $request->name;
        $sch->save();

        DB::commit();

        return response()->json([
            'status'   => true,
            'msg'      => "Class added successfully",
            'location' => '/school/admin/class-list'
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

   
   public function school_section()
    {
        
        $Sclass = SchoolClass::where('school_id', Auth::guard('admin')->user()->school_id)
        ->where('status', 'ACTIVE')
        ->get();
       
      return view('admin.master.school-section',compact('Sclass'));

    }
    
    
    
     public function get_section(Request $request)
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
    $total = SchoolSection::where('school_id', Auth::guard('admin')->user()->school_id)
        ->where('status', 'ACTIVE')
        ->count();

    // Get filtered records
    $students = SchoolSection::select('school_section.*','school_class.name as cName')
    ->join('school_class','school_section.class_id','=','school_class.id')
        ->where('school_section.school_id', Auth::guard('admin')->user()->school_id)
        ->where('school_section.status', 'ACTIVE')
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('school_section.name', 'like', '%' . $search . '%');
                $q->orWhere('school_class.name', 'like', '%' . $search . '%');    
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
            $student->cName,
            $student->name,
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
   
   
   
   public function save_section(Request $request)
{
    DB::beginTransaction();

    try {
        $schoolId = Auth::guard('admin')->user()->school_id;

        // ✅ Step 1: Validation
        $validator = Validator::make($request->all(), [
            'class_id' => 'required|exists:school_class,id',
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('school_section')->where(function ($query) use ($schoolId, $request) {
                    return $query->where('school_id', $schoolId)
                                 ->where('class_id', $request->class_id)
                                 ->whereRaw('LOWER(name) = ?', [strtolower($request->name)]);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msg'    => $validator->errors()->first()
            ]);
        }

        // ✅ Step 2: Save section
        $section = new SchoolSection();
        $section->school_id = $schoolId;
        $section->class_id = $request->class_id;
        $section->name = $request->name;
        $section->save();

        DB::commit();

        return response()->json([
            'status'   => true,
            'msg'      => "Section added successfully",
            
        ], 201);

    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'status' => false,
            'msg'    => "Something went wrong. Please try again later.",
            'error'  => $e->getMessage()
        ], 500);
    }
}
   
   
   
   
   
          public function delete_class(Request $request)
            {
                
                try {
                    $check  = StudentAddmission::where('school_id', Auth::guard('admin')->user()->school_id)->where('class_id', $request->id)->count();
                    if($check > 0){
                       return response()->json([
                'status' => false,
                'msg' => 'This class cannot be deleted because students are still assigned to it.'
            ]); 
                    }
                    
                    $Scheck  = SchoolSection::where('school_id', Auth::guard('admin')->user()->school_id)->where('class_id', $request->id)->count();
                    
                    if($Scheck > 0){
                       return response()->json([
                'status' => false,
                'msg' => 'This class cannot be deleted because subjects are still assigned to it.'
            ]); 
                    }
                    
                    
                    
                    $feeType = SchoolClass::where('school_id', Auth::guard('admin')->user()->school_id)->where('id', $request->id)->first();
            
                    if (!$feeType) {
                        return response()->json([
                            'status' => false,
                            'msg' => 'Student class not found.'
                        ]);
                    }
            
                    $feeType->delete();
            
                    return response()->json([
                        'status' => true,
                        'msg' => 'Class deleted successfully.'
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => false,
                        'msg' => 'Something went wrong. Please try again.'
                    ]);
                }
            } 
            
            
            
            
            public function delete_section(Request $request)
            {
                
                try {
                    
                    $feeType = SchoolSection::where('school_id', Auth::guard('admin')->user()->school_id)->where('id', $request->id)->first();
                    
                    $check  = StudentAddmission::where('school_id', Auth::guard('admin')->user()->school_id)->where('class_id', $feeType->class_id)->where('section_id', $request->id)->count();
                    if($check > 0){
                       return response()->json([
                'status' => false,
                'msg' => 'This class cannot be deleted because students are still assigned to it.'
            ]); 
                    }
                    
                    
                    
                    
                    
                    
            
                    if (!$feeType) {
                        return response()->json([
                            'status' => false,
                            'msg' => 'Student class not found.'
                        ]);
                    }
            
                    $feeType->delete();
            
                    return response()->json([
                        'status' => true,
                        'msg' => 'Section deleted successfully.'
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => false,
                        'msg' => 'Something went wrong. Please try again.'
                    ]);
                }
            } 
   
   
   
   
   
   
   
   
   
   
   
   
    
    
}