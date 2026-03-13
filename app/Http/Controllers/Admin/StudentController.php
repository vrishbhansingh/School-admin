<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentRegistration;
use App\Models\StudentAddmission;
use App\Models\School;
use App\Models\SchoolClass;
use App\Models\SchoolSection;
use App\Models\SchoolSession;
use App\Models\ExamClasses;
use App\Models\ExamSubjects;
use App\Models\Parents;
use App\Models\StudentPromotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function student_list()
    {
        $Sclass = SchoolClass::where('school_id', Auth::guard('admin')->user()->school_id)->where('status','ACTIVE')->get();
        $Ssection = SchoolSection::where('school_id', Auth::guard('admin')->user()->school_id)->where('status','ACTIVE')->get();
       
      return view('admin.student.student-list', compact('Sclass','Ssection'));

    }


    public function student_details($id)
    {
        $student_id = base64_decode($id);
        $student = StudentAddmission::where('id', $student_id)->first();
        $class = SchoolClass::where('id', $student->class_id)->first();
        $session = SchoolSession::where('id', $student->session_id)->first();
        $section = SchoolSection::where('id', $student->section_id)->first();
        
        $exam = ExamClasses::where('school_id', Auth::guard('admin')->user()->school_id)->where('class_id', $student->class_id)->where('status','ACTIVE')->count();
       
      return view('admin.student.student-details', compact('student','class','session','section','exam'));

    }
    
    
    public function print_student_id_card($id)
    {
        $student_id = base64_decode($id);
        $student = StudentAddmission::where('id', $student_id)->first();
        $class = SchoolClass::where('id', $student->class_id)->first();
        $session = SchoolSession::where('id', $student->session_id)->first();
        $section = SchoolSection::where('id', $student->section_id)->first();
        $school = School::where('id', $student->school_id)->first();
      return view('admin.student.print-student-id-card', compact('student','class','session','section','school'));
    }
    
    
    

    public function add_student()
    {
        $school = School::where('id', Auth::guard('admin')->user()->school_id)->first();
        $schoolId = Auth::guard('admin')->user()->school_id;
       
        $maxSn = StudentAddmission::where('school_id', Auth::guard('admin')->user()->school_id)->max('s_no');
        
        $sn = 0;
        if(!empty($maxSn) && $maxSn > 0){
            $sn = $maxSn +1;
            
        }else{
            $sn = 1;
        }
        
        if($sn > 0 && $sn < 10){
            $addmission_no = $school->code.'-'.date('Y').'-00'.$sn;
        }elseif($sn > 9 && $sn < 100){
            $addmission_no = $school->code.'-'.date('Y').'-0'.$sn;
        }else{
            $addmission_no = $school->code.'-'.date('Y').'-'.$sn;
        }
        
        
        $Sclass = SchoolClass::where('school_id', Auth::guard('admin')->user()->school_id)->where('status','ACTIVE')->get();
        $Ssection = SchoolSection::where('school_id', Auth::guard('admin')->user()->school_id)->where('status','ACTIVE')->get(); 
        
      return view('admin.student.add-student', compact('sn','addmission_no','Sclass','Ssection'));
    }

    public function student_promotion()
    {
        $Sses = SchoolSession::all();
        $Sclass = SchoolClass::where('school_id', Auth::guard('admin')->user()->school_id)->where('status','ACTIVE')->get();
        $Ssection = SchoolSection::where('school_id', Auth::guard('admin')->user()->school_id)->where('status','ACTIVE')->get();
        $students = StudentAddmission::where('school_id', Auth::guard('admin')->user()->school_id)->where('status','ACTIVE')->get();
      return view('admin.student.student-promotion', compact('Sses','Sclass','Ssection','students'));
    }
    
    
    
    
    public function student_registration()
    {
        $Sclass = SchoolClass::where('status','ACTIVE')->get();
        $Ssection = SchoolSection::where('status','ACTIVE')->get();
      return view('admin.student.student_registration', compact('Sclass','Ssection'));
    }
    
    
    
        
public function register_student(Request $request)
{
    DB::beginTransaction();

    try {
        $validator = Validator::make($request->all(), [
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'phone'          => 'required|string|max:15',
            'email'          => 'nullable|email|max:255',
            'gender'         => 'required|in:Male,Female,Other',
            'dob'            => 'required|date_format:d/m/Y',
            'reg_date'       => 'required|date_format:d/m/Y',
            'address'        => 'nullable|string',
            'reference'      => 'nullable|string|max:255',
            'class_id'       => 'required|exists:school_class,id',
            'section_id'     => 'required|exists:school_section,id',
            'aadhar_number'  => 'nullable|digits:12',
            'city'           => 'nullable|string|max:255',
            'state'          => 'nullable|string|max:255',
            'pincode'        => 'nullable|string|max:10',
            'reg_amount'     => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msg'    => $validator->errors()->first()
            ]);
        }

        $dob = Carbon::createFromFormat('d/m/Y', $request->dob)->format('Y-m-d');
        $reg_date = Carbon::createFromFormat('d/m/Y', $request->reg_date)->format('Y-m-d');
        
        $lastRegNo = StudentRegistration::where('school_id', Auth::guard('admin')->user()->school_id)->max('reg_no');
        $nextRegNo = $lastRegNo ? $lastRegNo + 1 : 1;
        

        $sch = new StudentRegistration();
        $sch->school_id      = Auth::guard('admin')->user()->school_id;
        $sch->reg_no = $nextRegNo;
        $sch->first_name     = $request->first_name;
        $sch->last_name      = $request->last_name;
        $sch->phone          = $request->phone;
        $sch->email          = $request->email;
        $sch->gender         = $request->gender;
        $sch->dob            = $dob;
        $sch->address        = $request->address;
        $sch->reg_date       = $reg_date;
        $sch->reference      = $request->reference;
        $sch->class_id       = $request->class_id;
        $sch->section_id     = $request->section_id;
        $sch->aadhar_number  = $request->aadhar_number;
        $sch->city           = $request->city;
        $sch->state          = $request->state;
        $sch->pincode        = $request->pincode;
        $sch->reg_amount     = $request->reg_amount;

        $sch->save();

        DB::commit();

        return response()->json([
            'status'   => true,
            'msg'      => "Student Successfully Registered",
            'location' => '/school/admin/student-registration-list'
        ]);

    } catch (\Exception $e) {
        DB::rollback();

        return response()->json([
            'status' => false,
            'msg'    => "Error: " . $e->getMessage()
        ]);
    }
    }
    
    
          public function student_registration_list(Request $request)
          {
              
              return view('admin.student.student-registration-list');
          }
          
          
          
          public function get_student_registration_list(Request $request)
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
    $total = StudentRegistration::where('school_id', Auth::guard('admin')->user()->school_id)
        ->where('status', 'ACTIVE')
        ->count();

    // Get filtered records
    $students = StudentRegistration::select('student_registration.*')
        ->where('school_id', Auth::guard('admin')->user()->school_id)
        ->where('status', 'ACTIVE')
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('aadhar_number', 'like', '%' . $search . '%')
                    ->orWhere('reg_date', 'like', '%' . $search . '%')
                    ->orWhere('reg_no', 'like', '%' . $search . '%');
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
        // Format Registration No
        if ($student->reg_no > 0 && $student->reg_no < 10) {
            $regNo = 'STRG00' . $student->reg_no;
        } elseif ($student->reg_no >= 10 && $student->reg_no < 100) {
            $regNo = 'STRG0' . $student->reg_no;
        } else {
            $regNo = 'STRG' . $student->reg_no;
        }

        $data[] = [
            $i++,
            '<div style="width:100px;">'.date('d-m-Y', strtotime($student->reg_date)).'</div>',
            '<div style="width:100px;">'.$regNo.'</div>',
            '<div style="width:100px;"><a href="'.url('/admin/student-registration-view/'.base64_encode($student->id).'').'">'.$student->first_name . ' ' . $student->last_name.'</a></div>',
            $student->phone,
            $student->email,
            $student->gender,
            '<div style="width:100px;">'.date('d-m-Y', strtotime($student->dob)).'</div>',
            $student->address,
            $student->city,
            $student->state,
            $student->pincode,
            $student->aadhar_number,
            number_format((float) $student->reg_amount, 2, '.', '')
        ];
    }

    // Final JSON response
    return response()->json([
        'recordsTotal' => $total,
        'recordsFiltered' => $total,
        'data' => $data
    ]);
   }
   
   
   
   
   public function student_registration_view($id){
       
       $reg_id = base64_decode($id);
       
       
       $student = StudentRegistration::where('id', $reg_id)->first();
       
       $Cclass = SchoolClass::where('id', $student->class_id)->first();
       $Ssec = SchoolSection::where('id', $student->section_id)->first();
       return view('admin.student.student-registration-view', compact('student','Cclass','Ssec'));
   }
   
   
   
     
     public function print_student_registration($id){
         $reg_id = base64_decode($id);
       
       $school = School::where('id', Auth::guard('admin')->user()->school_id)->first();
       $student = StudentRegistration::where('id', $reg_id)->first();
       $Cclass = SchoolClass::where('id', $student->class_id)->first();
       $Ssec = SchoolSection::where('id', $student->section_id)->first();
       return view('admin.student.print-student-registration', compact('student','Cclass','Ssec','school'));
     }
     
     
     
     
        public function student_addmission(Request $request)
        {
            
            date_default_timezone_set("Asia/Kolkata");
            
        $validator = Validator::make($request->all(), [
        'addmission_no'             => 'required|string|max:50|unique:student_addmission,addmission_no',
        'name'                      => 'required|string|max:255',
        's_no'                      => 'required|numeric',
        'class_id'                  => 'required|integer',
        'section_id'                => 'required|integer',
        'roll_no'                   => 'required|numeric',
        'father_name'               => 'required|string|max:255',
        'father_phone'              => 'required|string|max:15',
        'phone'                     => 'nullable|string|max:15',
        'address'                   => 'nullable|string|max:500',
        'religion'                  => 'nullable|string|max:100',
        'category'                  => 'nullable|string|max:50',
        'photo'                     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
        'transfer_certificate' => 'nullable|string|max:255',
        
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'msg'    => $validator->errors()->first()
        ]);
    }

    try {
        $photoPath = null;
        $tcPath = null;

        // Upload student photo
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time().'_photo.'.$photo->getClientOriginalExtension();
            $photo->move(public_path('admin/student'), $photoName);
            $photoPath = $photoName;
        }

        // Upload transfer certificate
        if ($request->hasFile('transfer_certificate')) {
            $tc = $request->file('transfer_certificate');
            $tcName = time().'_tc.'.$tc->getClientOriginalExtension();
            $tc->move(public_path('admin/student'), $tcName);
            $tcPath = $tcName;
        }

        
        $dob = Carbon::createFromFormat('d/m/Y', $request->dob)->format('Y-m-d');
        
        $student = StudentAddmission::create([
            'addmission_no'             => $request->addmission_no,
            'name'                      => $request->name,
            's_no'                      => $request->s_no,
            'gender'                    => $request->gender,
            'school_id'                 => Auth::guard('admin')->user()->school_id,
            'session_id'                => Auth::guard('admin')->user()->session,
            'class_id'                  => $request->class_id,
            'section_id'                => $request->section_id,
            'roll_no'                   => $request->roll_no,
            'email'                     => $request->email,
            'password'                  => Hash::make($request->phone),
            'phone'                     => $request->phone,
            'address'                   => $request->address,
            'gender'                    => $request->gender,
            'dob'                       => $dob,
            'addmission_date'           => date('Y-m-d H:i:s'),
            'photo'                     => $photoPath,
            'city'                      => $request->city,
            'state'                     => $request->state,
            'pincode'                   => $request->pincode,
            'religion'                  => $request->religion,
            'father_name'               => $request->father_name,
            'father_phone'              => $request->father_phone,
            'mother_name'               => $request->mother_name,
            'blood_group'               => $request->blood_group,
            'nationality'               => $request->nationality,
            'category'                  => $request->category,
            'aadhar_number'             => $request->aadhar_number,
            'permanent_address'         => $request->permanent_address,
            'previous_school'           => $request->previous_school,
            'last_class_attended'       => $request->last_class_attended,
            'emergency_contact_name'    => $request->emergency_contact_name,
            'emergency_contact_number'  => $request->emergency_contact_number,
            'transfer_certificate'      => $tcPath,
        ]);

        return response()->json([
            'status'   => true,
            'msg'      => "Student Admission Successfully Done.",
            'location' => '/school/admin/student-list'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'msg'    => "Error: " . $e->getMessage()
        ]);
    }
}

     
     
             
        public function get_section_data(Request $request){
            
            $class = SchoolSection::where('class_id', $request->class_id)->get();
            
            return response()->json([
            'status'   => true,
            'data'      => $class
            
        ]);
            
        }
        
        
        
        
        public function get_student_addmission_list(Request $request)
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
    $total = StudentAddmission::where('school_id', Auth::guard('admin')->user()->school_id)
        
        ->count();

    // Get filtered records
    $students = StudentAddmission::select('student_addmission.*', 'school_class.name as class_name', 'school_section.name as section_name')
    ->join('school_class','student_addmission.class_id','=','school_class.id')
    ->join('school_section','student_addmission.section_id','=','school_section.id')
        ->where('student_addmission.school_id', Auth::guard('admin')->user()->school_id)
        
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('student_addmission.name', 'like', '%' . $search . '%')
                    ->orWhere('student_addmission.addmission_no', 'like', '%' . $search . '%')
                    ->orWhere('student_addmission.phone', 'like', '%' . $search . '%')
                    ->orWhere('student_addmission.email', 'like', '%' . $search . '%')
                    ->orWhere('student_addmission.aadhar_number', 'like', '%' . $search . '%')
                    ->orWhere('school_class.name', 'like', '%' . $search . '%')
                    ->orWhere('student_addmission.roll_no', 'like', '%' . $search . '%')
                    ->orWhere('school_section.name', 'like', '%' . $search . '%');
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
            $student->roll_no,
            $student->addmission_no,
            '<div style="width:100px;"><a href="'.url('/admin/student-details/'.base64_encode($student->id).'').'">'.$student->name.'</a></div>',
            $student->gender,
            $student->class_name,
            $student->section_name,
            $student->father_name,
            $student->address,
            '<div style="width:100px;">'.date('d-m-Y', strtotime($student->dob)).'</div>',
            $student->phone,
            $student->email,
            
        ];
    }

    // Final JSON response
    return response()->json([
        'recordsTotal' => $total,
        'recordsFiltered' => $total,
        'data' => $data
    ]);
   }
    


     public function promote_new_class_student(Request $request){
         
         date_default_timezone_set("Asia/Kolkata");
            
        $validator = Validator::make($request->all(), [
        
        'old_session_id' => 'required|integer',
        'new_session_id' => 'required|integer',
        'old_class_id'   => 'required|integer',
        'new_class_id'   => 'required|integer',
        'student_id'     => 'required|integer',
        
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'msg'    => $validator->errors()->first()
        ]);
    }
    
    
    $chk = StudentPromotion::where('school_id', Auth::guard('admin')->user()->school_id)
        ->where('id', $request->student_id)->where('old_session_id', $request->old_session_id)->where('new_session_id', $request->new_session_id)
        ->where('old_class_id', $request->old_class_id)->where('new_class_id', $request->new_class_id)
        ->first();
    
    if($chk){
        return response()->json([
                'status' => false,
                'msg'    => 'Student already promoted.'
            ]);
    } 
    
    
    if($request->old_session_id == $request->new_session_id){
        return response()->json([
                'status' => false,
                'msg'    => 'Old session & new session both are same.'
            ]);
    } 
    
    
    if($request->old_class_id == $request->new_class_id){
        return response()->json([
                'status' => false,
                'msg'    => 'Old class & new class both are same.'
            ]);
    } 
    
    
    $stu = new StudentPromotion();
    $stu->school_id = Auth::guard('admin')->user()->school_id;
    $stu->old_session_id = $request->old_session_id;
    $stu->new_session_id = $request->new_session_id;
    $stu->old_class_id = $request->old_class_id;
    $stu->new_class_id = $request->new_class_id;
    $stu->student_id = $request->student_id;
    $stu->promotion_date = date('Y-m-d H:i:s');
    $stu->remarks = $request->remarks;
    $result = $stu->save();
    
    if($result){
        $key = StudentAddmission::where('school_id', Auth::guard('admin')->user()->school_id)->where('id', $request->student_id)->first();
        if($key){
            $key->session_id = $request->new_session_id;
            $key->class_id  = $request->new_class_id;
            $key->update();
        }
        return response()->json([
            'status'   => true,
            'msg'      => "Student Successfully Promoted",
            'location' => '/school/admin/student-promotion-list'
        ]);
    }else{
        return response()->json([
                'status' => false,
                'msg'    => 'Old session & new session both are same.'
            ]);
    }
         
     }
    
    
    
    public function student_promotion_list()
    {
       
      return view('admin.student.student-promotion-list');

    }
    
    
    
    
    public function get_student_promotion_list(Request $request)
{
    $search = $request->input('search.value', '');
    $limit = $request->input('length', 10);
    $ofset = $request->input('start', 0);

    // Sorting info
    $orderColumnIndex = $request->input('order.0.column', 0);
    $orderType = $request->input('order.0.dir', 'desc');
    $columns = $request->input('columns', []);
    $nameOrder = isset($columns[$orderColumnIndex]['name']) ? $columns[$orderColumnIndex]['name'] : 'student_promotion.id';

    $query = StudentPromotion::select(
        'student_promotion.*',
        'old_class.name as old_class_name',
        'new_class.name as new_class_name',
        'old_session.session as old_session_name', // ✅ Fixed column name
        'new_session.session as new_session_name', // ✅ Fixed column name
        'student_addmission.name as student_name',
        'student_addmission.addmission_no',
        'student_addmission.id as student_id'
    )
    ->join('student_addmission', 'student_promotion.student_id', '=', 'student_addmission.id')
    ->leftJoin('school_class as old_class', 'student_promotion.old_class_id', '=', 'old_class.id')
    ->leftJoin('school_class as new_class', 'student_promotion.new_class_id', '=', 'new_class.id')
    ->leftJoin('school_session as old_session', 'student_promotion.old_session_id', '=', 'old_session.id')
    ->leftJoin('school_session as new_session', 'student_promotion.new_session_id', '=', 'new_session.id')
    ->where('student_addmission.school_id', Auth::guard('admin')->user()->school_id)
    ->where('student_addmission.status', 'ACTIVE');

    // Clone for filtered count
    $filtered = clone $query;

    // Apply search if any
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->orWhere('student_addmission.name', 'like', "%{$search}%")
              ->orWhere('student_addmission.addmission_no', 'like', "%{$search}%");
        });

        $filtered->where(function ($q) use ($search) {
            $q->orWhere('student_addmission.name', 'like', "%{$search}%")
              ->orWhere('student_addmission.addmission_no', 'like', "%{$search}%");
        });
    }

    // Get final data with limit and order
    $students = $query
        ->offset($ofset)
        ->limit($limit)
        ->orderBy($nameOrder, $orderType)
        ->get();

    $data = [];
    $i = $ofset + 1;

    foreach ($students as $student) {
        
        
        $data[] = [
            $i++,
            $student->addmission_no,
            '<div style="width:100px;"><a href="' . url('/admin/student-details/' . base64_encode($student->student_id)) . '">' . $student->student_name . '</a></div>',
            $student->old_session_name,
            $student->new_session_name,
            $student->old_class_name,
            $student->new_class_name,
            date('d M, Y', strtotime($student->promotion_date)),
            $student->remarks,
        ];
    }

    return response()->json([
        'recordsTotal' => StudentPromotion::where('school_id', Auth::guard('admin')->user()->school_id)->count(),
        'recordsFiltered' => $filtered->count(),
        'data' => $data
    ]);
}


    
    
    public function bulkUploadDirect(Request $request)
{
    $request->validate([
        'class_id' => 'required|integer',
        'section_id' => 'required|integer',
        'file' => 'required'
    ]);

    try {
        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $school = School::where('id', Auth::guard('admin')->user()->school_id)->first(); // Assuming relation exists
        $school_id = Auth::guard('admin')->user()->school_id;
        $session_id = Auth::guard('admin')->user()->session;
        $class_id  = $request->class_id;
        $section_id = $request->section_id;

        DB::beginTransaction();

        foreach ($rows as $index => $row) {
            if ($index == 0) continue; // skip header row

            // Generate S.No & Admission No
            $maxSn = DB::table('student_addmission')->where('school_id', $school_id)->max('s_no');
            $sn = ($maxSn) ? $maxSn + 1 : 1;

            if ($sn < 10) {
                $admission_no = $school->code . '-' . date('Y') . '-00' . $sn;
            } elseif ($sn < 100) {
                $admission_no = $school->code . '-' . date('Y') . '-0' . $sn;
            } else {
                $admission_no = $school->code . '-' . date('Y') . '-' . $sn;
            }

            // Required fields
            $name = trim($row[0] ?? '');
            if (empty($name)) {
                continue; // skip row if name missing
            }

            // Optional fields with default values
            $email = $row[1] ?? null;
            $phone = $row[2] ?? null;
            $address = $row[3] ?? null;
            $gender = $row[4] ?? null;

            // Safe Date Parsing
            $dobRaw = $row[5] ?? null;
            $dob = $this->parseDate($dobRaw); // custom method

            $city = $row[6] ?? null;
            $state = $row[7] ?? null;
            $pincode = $row[8] ?? null;

            $admDateRaw = $row[9] ?? null;
            $dateOfAdmission = $this->parseDate($admDateRaw);

            $religion = $row[10] ?? null;
            $father_name = $row[11] ?? null;
            $father_phone = $row[12] ?? null;
            $mother_name = $row[13] ?? null;
            $blood_group = $row[14] ?? null;
            $category = $row[15] ?? null;
            $aadhar_no = $row[16] ?? null;
            $permanent_address = $row[17] ?? null;
            $last_class = $row[18] ?? null;
            $pre_school = $row[19] ?? null;
            $roll_no = $row[20] ?? null;

            $password = Hash::make($phone ?? '123456');
            
            if ($gender && strtolower($gender) === 'male') {
                $photo = 'male_student.png'; 
                
            } elseif ($gender && strtolower($gender) === 'female') {
             $photo = 'female_student.png';
            } else {
            $photo = 'male_student.png'; // fallback 
            }

            DB::table('student_addmission')->updateOrInsert(
                ['addmission_no' => $admission_no],
                [
                    's_no' => $sn,
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address,
                    'gender' => $gender,
                    'photo' => $photo,
                    'dob' => $dob,
                    'city' => $city,
                    'state' => $state,
                    'pincode' => $pincode,
                    'nationality' => 'Indian',
                    'addmission_date' => $dateOfAdmission,
                    'religion' => $religion,
                    'father_name' => $father_name,
                    'father_phone' => $father_phone,
                    'mother_name' => $mother_name,
                    'blood_group' => $blood_group,
                    'category' => $category,
                    'aadhar_number' => $aadhar_no,
                    'permanent_address' => $permanent_address,
                    'previous_school' => $pre_school,
                    'last_class_attended' => $last_class,
                    'roll_no' => $roll_no,
                    'school_id' => $school_id,
                    'session_id' => $session_id,
                    'class_id' => $class_id,
                    'section_id' => $section_id,
                    'password' => $password,
                    'updated_at' => now(),
                    'created_at' => now()
                ]
            );
        }

        DB::commit();
        return response()->json(['status'   => true, 'message' => 'Students uploaded successfully!']);
    } catch (\Exception $e) {
    DB::rollBack();
    return response()->json([
        'status' => false,
        'message' => 'Error: ' . $e->getMessage()
    ], 500);
}
}
    
    
    
    private function parseDate($date)
{
    if (empty($date)) return null;

    $date = str_replace('-', '/', $date);
    $formats = ['d/m/Y', 'd-m-Y', 'Y-m-d', 'd.m.Y'];

    foreach ($formats as $format) {
        try {
            return Carbon::createFromFormat($format, $date)->format('Y-m-d');
        } catch (\Exception $e) {
            continue;
        }
    }

    return null; // invalid date
}
    
    
    
    public function edit_student_details(Request $request, $id)
    {
        $student_id = base64_decode($id);
        $student = StudentAddmission::where('id', $student_id)->first();
        $school = School::where('id', Auth::guard('admin')->user()->school_id)->first();
        $schoolId = Auth::guard('admin')->user()->school_id;
        $parent = Parents::where('school_id', Auth::guard('admin')->user()->school_id)->get();
        $Sclass = SchoolClass::where('school_id', Auth::guard('admin')->user()->school_id)->where('status','ACTIVE')->get();
        $Ssection = SchoolSection::where('school_id', Auth::guard('admin')->user()->school_id)->where('class_id', $student->class_id)->where('status','ACTIVE')->get(); 
        
      return view('admin.student.edit-student', compact('Sclass','Ssection','student','parent'));
    }
    
    
    
    
    public function update_student_addmission(Request $request)
{
    date_default_timezone_set("Asia/Kolkata");

    // Validate the input data
    $validator = Validator::make($request->all(), [
        'name'                      => 'required|string|max:255',
        'class_id'                  => 'required|integer',
        'section_id'                => 'required|integer',
        'roll_no'                   => 'required|numeric',
        'father_name'               => 'required|string|max:255',
        'father_phone'              => 'required|string|max:15',
        'phone'                     => 'nullable|string|max:15',
        'address'                   => 'nullable|string|max:500',
        'religion'                  => 'nullable|string|max:100',
        'category'                  => 'nullable|string|max:50',
        'photo'                     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'transfer_certificate'      => 'nullable|mimes:pdf|max:2048',
        'dob'                       => 'nullable|string', // Removed strict date validation here
    ]);

    // If validation fails, return the error message
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'msg'    => $validator->errors()->first()
        ]);
    }

    try {
        // Fetch the student record
        $student = StudentAddmission::where('id', $request->id)->first();

        // If student not found, return error
        if (!$student) {
            return response()->json([
                'status' => false,
                'msg'    => "Student not found."
            ]);
        }

        // Handle the photo upload
        $photoPath = $student->photo; // Default to existing photo
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '_photo.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('admin/student'), $photoName);
            $photoPath = $photoName;
        }

        // Handle the transfer certificate upload
        $tcPath = $student->transfer_certificate; // Default to existing transfer certificate
        if ($request->hasFile('transfer_certificate')) {
            $tc = $request->file('transfer_certificate');
            $tcName = time() . '_tc.' . $tc->getClientOriginalExtension();
            $tc->move(public_path('admin/student'), $tcName);
            $tcPath = $tcName;
        }

        // Parse the 'dob' (Date of Birth) manually
        $dob = null;
        if ($request->has('dob') && !empty($request->dob)) {
            // Replace any slashes with dashes
            $dob = str_replace('/', '-', $request->dob);

            // Now try to convert it to a valid date format 'Y-m-d'
            try {
                $dob = Carbon::createFromFormat('Y-m-d', $dob)->format('Y-m-d');
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'msg'    => "Invalid date format. Please use YYYY-MM-DD."
                ]);
            }
        }

        // Update the student record with the provided data
        $student->update([
            'name'                      => $request->name,
            'parent_id'                 => $request->parent_id ?? 0,
            'gender'                    => $request->gender,
            'class_id'                  => $request->class_id,
            'section_id'                => $request->section_id,
            'roll_no'                   => $request->roll_no,
            'email'                     => $request->email,
            'password'                  => Hash::make($request->phone),
            'phone'                     => $request->phone,
            'address'                   => $request->address,
            'dob'                       => $dob,
            'addmission_date'           => $student->addmission_date,
            'photo'                     => $photoPath,
            'city'                      => $request->city,
            'state'                     => $request->state,
            'pincode'                   => $request->pincode,
            'religion'                  => $request->religion,
            'father_name'               => $request->father_name,
            'father_phone'              => $request->father_phone,
            'mother_name'               => $request->mother_name,
            'blood_group'               => $request->blood_group,
            'nationality'               => $request->nationality,
            'category'                  => $request->category,
            'aadhar_number'             => $request->aadhar_number,
            'permanent_address'         => $request->permanent_address,
            'previous_school'           => $request->previous_school,
            'last_class_attended'       => $request->last_class_attended,
            'emergency_contact_name'    => $request->emergency_contact_name,
            'emergency_contact_number'  => $request->emergency_contact_number,
            'transfer_certificate'      => $tcPath,
        ]);

        return response()->json([
            'status'   => true,
            'msg'      => "Student record successfully updated.",
            'location' => '/school/admin/student-list'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'msg'    => "Error: " . $e->getMessage()
        ]);
    }
    }
    
    
    
            public function change_student_status(Request $request){
                
                
                $student= StudentAddmission::where('id', $request->student_id)->first();
                
                if($student){
                    
                    $student->status = $request->status;
                    $student->update();
                    
                    return response()->json([
                    'status'   => true,
                    'msg'      => "Student status successfully updated.",
            
                     ]);
                    
                }else{
                    
                    return response()->json([
                        'status' => false,
                        'msg'    => "Error: " . $e->getMessage()
                    ]);
                }
            }



               public function print_admit_card($id)
                {
                    $student_id = base64_decode($id);
                    $student = StudentAddmission::where('id', $student_id)->first();
                    $class = SchoolClass::where('id', $student->class_id)->first();
                    $session = SchoolSession::where('id', $student->session_id)->first();
                    $section = SchoolSection::where('id', $student->section_id)->first();
                    $school = School::where('id', $student->school_id)->first();
                    $exam = ExamSubjects::select('exam_subjects.*', 'school_subject.name as subName')
                    ->join('school_subject','exam_subjects.subject_id','=','school_subject.id')
                    ->where('exam_subjects.school_id', Auth::guard('admin')->user()->school_id)->where('exam_subjects.class_id', $class->id)->get();
                  return view('admin.student.print-student-id-card', compact('student','class','session','section','school','exam'));
                }


    
    
    
    
    
}
