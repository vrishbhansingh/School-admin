<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentRegistration;
use App\Models\StudentAddmission;
use App\Models\School;
use App\Models\ExamAdmitCard;
use App\Models\SchoolClass;
use App\Models\SchoolSection;
use App\Models\SchoolSubject;
use App\Models\Exams;
use App\Models\ExamClasses;
use App\Models\ExamSubjects;
use App\Models\ExamMarks;
use App\Models\StudentPromotion;
use App\Models\SchoolSession;
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
use Illuminate\Validation\Rule;

class Exam extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function exam_schedule()
    {
        
       $session = SchoolSession::where('status', 'ACTIVE')->get();
      return view('admin.exam.exam-schedule', compact('session'));

    }
    
    
     public function exam_grade()
    {
       
      return view('admin.exam.exam-grade');

    }
    
    
    
    public function get_exam(Request $request)
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
    $total = Exams::where('school_id', Auth::guard('admin')->user()->school_id)
        ->where('status', 'ACTIVE')
        ->count();

    // Get filtered records
    $students = Exams::select('exams.*','exams.exam_name as examName','exams.start_date as startDate','exams.end_date as endDate','school_session.session as cSession'
    ,'exams.session_year as sessionYear')
    ->join('school_session','exams.session_year','=','school_session.id')
        ->where('exams.school_id', Auth::guard('admin')->user()->school_id)
        ->where('exams.status', 'ACTIVE')
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('exams.exam_name', 'like', '%' . $search . '%');
                  
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
       
       if($student->status == 'ACTIVE') {
        $status = '<button class="btn btn-warning btn-sm toggle-status-btn" data-id="'.$student->id.'" data-status="DISABLE">Disable</button>';
    } else {
        $status = '<button class="btn btn-primary btn-sm toggle-status-btn" data-id="'.$student->id.'" data-status="ENABLE">Enable</button>';
    }

        $data[] = [
            $i++,
            $student->cSession,
            $student->examName,
            date('d M, Y', strtotime($student->startDate)),
            date('d M, Y', strtotime($student->endDate)),
            $status,
            '<button type="button" data-id="'.$student->id.'" data-session_year="'.$student->sessionYear.'" data-exam_name="'.$student->examName.'" data-start_date="'.$student->startDate.'" data-end_date="'.$student->endDate.'" id="update_exam"  
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
   
   
   
   
   
   public function save_exam(Request $request)
{
    DB::beginTransaction();

    try {
        $schoolId = Auth::guard('admin')->user()->school_id;

        // ✅ Step 1: Validation
        $validator = Validator::make($request->all(), [
            'session_year' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'exam_name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('exams')->where(function ($query) use ($schoolId, $request) {
                    return $query->where('school_id', $schoolId)
                                 ->where('session_year', $request->session_year)
                                 ->whereRaw('LOWER(exam_name) = ?', [strtolower($request->exam_name)]);
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
        $section = new Exams();
        $section->school_id = $schoolId;
        $section->session_year = $request->session_year;
        $section->exam_name = $request->exam_name;
        $section->start_date = $request->start_date;
        $section->end_date = $request->end_date;
        $section->save();

        DB::commit();

        return response()->json([
            'status'   => true,
            'msg'      => "Exam added successfully",
            
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
    
    
    
    
    public function delete_exam(Request $request)
            {
                
                try {
                    
                    
                    
                    $exam = Exams::where('school_id', Auth::guard('admin')->user()->school_id)->where('id', $request->id)->first();
            
                    if (!$exam) {
                        return response()->json([
                            'status' => false,
                            'msg' => 'Exam class not found.'
                        ]);
                    }
            
                    $exam->delete();
            
                    return response()->json([
                        'status' => true,
                        'msg' => 'Exam deleted successfully.'
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => false,
                        'msg' => 'Something went wrong. Please try again.'
                    ]);
                }
            }
            
            
            
            
    public function update_exam(Request $request)
    {
    DB::beginTransaction();

    try {
        $schoolId = Auth::guard('admin')->user()->school_id;

        // ✅ Step 1: Validation
        $validator = Validator::make($request->all(), [
            'session_year' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'exam_name' => [
                'required',
                'string',
                'max:200',
                
            ],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msg'    => $validator->errors()->first()
            ]);
        }

        // ✅ Step 2: Save section
        $section = Exams::where('id', $request->id)->first();
        $section->school_id = $schoolId;
        $section->session_year = $request->session_year;
        $section->exam_name = $request->exam_name;
        $section->start_date = $request->start_date;
        $section->end_date = $request->end_date;
        $section->update();

        DB::commit();

        return response()->json([
            'status'   => true,
            'msg'      => "Exam update successfully",
            
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
            
            
            
            
            public function update_exam_class(Request $request)
    {
    DB::beginTransaction();

    try {
        $schoolId = Auth::guard('admin')->user()->school_id;

        // ✅ Step 1: Validation
        $validator = Validator::make($request->all(), [
            'class_id' => 'required',
            'exam_id' => 'required',
            
              ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msg'    => $validator->errors()->first()
            ]);
        }

        // ✅ Step 2: Save section
        $section = ExamClasses::where('id', $request->id)->first();
        $section->school_id = $schoolId;
        $section->class_id = $request->class_id;
        $section->exam_id = $request->exam_id;
        $section->update();

        DB::commit();

        return response()->json([
            'status'   => true,
            'msg'      => "Exam Class update successfully",
            
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
    
    
    
    public function exam_classes()
    {
        
       $exam = Exams::where('school_id', Auth::guard('admin')->user()->school_id)->where('status', 'ACTIVE')->get();
       $class = SchoolClass::where('school_id', Auth::guard('admin')->user()->school_id)->where('status', 'ACTIVE')->get();
      return view('admin.exam.exam-classes', compact('exam', 'class'));

    }
    
    
    
    public function get_exam_classes(Request $request)
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
    $total = ExamClasses::where('school_id', Auth::guard('admin')->user()->school_id)
        ->where('status', 'ACTIVE')
        ->count();

    // Get filtered records
    $students = ExamClasses::select('exam_classes.*','exams.exam_name as examName','school_class.name as className','exam_classes.exam_id','exam_classes.class_id')
    ->join('school_class','exam_classes.class_id','=','school_class.id')
    ->join('exams','exam_classes.exam_id','=','exams.id')
        ->where('exams.school_id', Auth::guard('admin')->user()->school_id)
        ->where('exams.status', 'ACTIVE')
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('exams.exam_name', 'like', '%' . $search . '%');
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
            $student->examName,
            $student->className,
            '<button type="button" data-id="'.$student->id.'" data-exam_id="'.$student->exam_id.'" data-class_id="'.$student->class_id.'"  id="update_exam_class"  
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
     
     
     public function save_exam_class(Request $request)
     {
        DB::beginTransaction();
    
        try {
        $schoolId = Auth::guard('admin')->user()->school_id;

        // ✅ Step 1: Validation
        $validator = Validator::make($request->all(), [
            'exam_id' => 'required',
            'class_id' => 'required',
        ]);
        
        
        $check  = ExamClasses::where('school_id', $schoolId)
                                 ->where('class_id', $request->class_id)
                                 ->where('exam_id', $request->exam_id)->first();
                                 
      if($check){
          return response()->json([
                'status' => false,
                'msg'    => 'Exam Class already exists.'
            ]);
      }                             
                

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msg'    => $validator->errors()->first()
            ]);
        }

        // ✅ Step 2: Save section
        $section = new ExamClasses();
        $section->school_id = $schoolId;
        $section->exam_id = $request->exam_id;
        $section->class_id = $request->class_id;
        $section->save();

        DB::commit();

        return response()->json([
            'status'   => true,
            'msg'      => "Exam Class added successfully",
            
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
    
    
    
    
    public function delete_exam_classes(Request $request)
            {
                
                try {
                    
                    
                    
                    $exam = ExamClasses::where('school_id', Auth::guard('admin')->user()->school_id)->where('id', $request->id)->first();
            
                    if (!$exam) {
                        return response()->json([
                            'status' => false,
                            'msg' => 'Exam class not found.'
                        ]);
                    }
            
                    $exam->delete();
            
                    return response()->json([
                        'status' => true,
                        'msg' => 'Exam Class deleted successfully.'
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => false,
                        'msg' => 'Something went wrong. Please try again.'
                    ]);
                }
            }
            
            
            
            public function exam_subjects()
            {
                
               $exam = Exams::where('school_id', Auth::guard('admin')->user()->school_id)->where('status', 'ACTIVE')->get();
               $class = SchoolClass::where('school_id', Auth::guard('admin')->user()->school_id)->where('status', 'ACTIVE')->get();
               $subject = SchoolSubject::where('school_id', Auth::guard('admin')->user()->school_id)->where('status', 'ACTIVE')->get();
              return view('admin.exam.exam-subjects', compact('exam', 'class','subject'));
        
            }
            
            
            
            public function get_exam_subjects(Request $request)
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
    $total = ExamSubjects::where('school_id', Auth::guard('admin')->user()->school_id)
        ->where('status', 'ACTIVE')
        ->count();

    // Get filtered records
    $students = ExamSubjects::select('exam_subjects.*','exams.exam_name as examName','school_class.name as className','exam_subjects.exam_id','exam_subjects.subject_id'
    ,'exam_subjects.class_id','school_subject.name as subjectName','exam_subjects.exam_date','exam_subjects.start_time','exam_subjects.end_time','exam_subjects.max_marks'
    ,'exam_subjects.pass_marks','exam_subjects.duration')
    ->join('school_class','exam_subjects.class_id','=','school_class.id')
    ->join('exams','exam_subjects.exam_id','=','exams.id')
    ->join('school_subject','exam_subjects.subject_id','=','school_subject.id')
        ->where('exams.school_id', Auth::guard('admin')->user()->school_id)
        ->where('exams.status', 'ACTIVE')
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('exams.exam_name', 'like', '%' . $search . '%');
                $q->orWhere('school_class.name', 'like', '%' . $search . '%');
                $q->orWhere('school_subject.name', 'like', '%' . $search . '%');
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
            $student->examName,
            $student->className,
            $student->subjectName,
            $student->exam_date,
            $student->duration.' Hours',
            $student->start_time,
            $student->end_time,
            $student->max_marks,
            $student->pass_marks,
            '<button type="button" data-id="'.$student->id.'" data-pass_marks="'.$student->pass_marks.'" data-max_marks="'.$student->max_marks.'" data-end_time="'.$student->end_time.'" data-start_time="'.$student->start_time.'" data-duration="'.$student->duration.'" data-exam_date="'.$student->exam_date.'" data-exam_id="'.$student->exam_id.'" data-class_id="'.$student->class_id.'" data-subject_id="'.$student->subject_id.'"  id="update_exam_subject"  
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
     
     
     
     
     public function save_exam_subject(Request $request)
     {
        DB::beginTransaction();
    
        try {
        $schoolId = Auth::guard('admin')->user()->school_id;

        // ✅ Step 1: Validation
        $validator = Validator::make($request->all(), [
            'exam_id' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required',
            'exam_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'duration' => 'required',
            'max_marks' => 'required',
            'pass_marks' => 'required',
        ]);
        
        
        $check  = ExamSubjects::where('school_id', $schoolId)
                                 ->where('class_id', $request->class_id)
                                 ->where('exam_id', $request->exam_id)->where('subject_id', $request->subject_id)->first();
                                 
      if($check){
          return response()->json([
                'status' => false,
                'msg'    => 'Exam Subject already exists.'
            ]);
      }                             
                

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msg'    => $validator->errors()->first()
            ]);
        }

        // ✅ Step 2: Save section
        $section = new ExamSubjects();
        $section->school_id = $schoolId;
        $section->exam_id = $request->exam_id;
        $section->class_id = $request->class_id;
        $section->subject_id = $request->subject_id;
        $section->exam_date = $request->exam_date;
        $section->start_time = $request->start_time;
        $section->end_time = $request->end_time;
        $section->duration = $request->duration;
        $section->max_marks = $request->max_marks;
        $section->pass_marks = $request->pass_marks;
        $section->save();

        DB::commit();

        return response()->json([
            'status'   => true,
            'msg'      => "Exam Subject added successfully",
            
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
    
    
    
    public function get_classe_data(Request $request){
            
            $class = ExamClasses::select('exam_classes.*','school_class.name as className')
            ->join('school_class','exam_classes.class_id','=','school_class.id')
            ->where('exam_classes.exam_id', $request->exam_id)
            ->where('exam_classes.school_id', Auth::guard('admin')->user()->school_id)
            ->get();
            
            return response()->json([
            'status'   => true,
            'data'      => $class
            
        ]);
            
        }
        
        
        
        public function delete_exam_subject(Request $request)
            {
                
                try {
                    
                    
                    
                    $exam = ExamSubjects::where('school_id', Auth::guard('admin')->user()->school_id)->where('id', $request->id)->first();
            
                    if (!$exam) {
                        return response()->json([
                            'status' => false,
                            'msg' => 'Exam class not found.'
                        ]);
                    }
            
                    $exam->delete();
            
                    return response()->json([
                        'status' => true,
                        'msg' => 'Exam Subject deleted successfully.'
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => false,
                        'msg' => 'Something went wrong. Please try again.'
                    ]);
                }
               }
               
               
               
               
               
               public function update_exam_subject(Request $request)
            {
            DB::beginTransaction();
        
            try {
                $schoolId = Auth::guard('admin')->user()->school_id;

        // ✅ Step 1: Validation
        $validator = Validator::make($request->all(), [
            'class_id' => 'required',
            'exam_id' => 'required',
            'subject_id' => 'required',
            'exam_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'duration' => 'required',
            'max_marks' => 'required',
            'pass_marks' => 'required',
            
              ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msg'    => $validator->errors()->first()
            ]);
        }

        // ✅ Step 2: Save section
        $section = ExamSubjects::where('id', $request->id)->first();
        $section->school_id = $schoolId;
        $section->class_id = $request->class_id;
        $section->exam_id = $request->exam_id;
        $section->subject_id = $request->subject_id;
        $section->exam_date = $request->exam_date;
        $section->duration = $request->duration;
        $section->start_time = $request->start_time;
        $section->end_time = $request->end_time;
        $section->max_marks = $request->max_marks;
        $section->pass_marks = $request->pass_marks;
        $section->update();

        DB::commit();

        return response()->json([
            'status'   => true,
            'msg'      => "Exam Create successfully",
            
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
    
    
          public function exam_admin_card()
            {
                
               $exam = Exams::where('school_id', Auth::guard('admin')->user()->school_id)->where('status', 'ACTIVE')->get();
               $class = SchoolClass::where('school_id', Auth::guard('admin')->user()->school_id)->where('status', 'ACTIVE')->get();
               $subject = SchoolSubject::where('school_id', Auth::guard('admin')->user()->school_id)->where('status', 'ACTIVE')->get();
              return view('admin.exam.exam_admin_card', compact('exam', 'class','subject'));
        
            }
            
            
            
            
            
            public function get_exam_admin_card(Request $request)
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
            $total = ExamAdmitCard::where('school_id', Auth::guard('admin')->user()->school_id)
                ->where('status', 'ACTIVE')
                ->count();
        
            // Get filtered records
            $students = ExamAdmitCard::select('exam_admin_card.*','exams.exam_name as examName','school_class.name as className','student_addmission.name as studentName'
            ,'student_addmission.father_name as fatherName','student_addmission.phone as phone','student_addmission.roll_no as rollNo','exam_admin_card.issue_date','student_addmission.id as student_id')
            ->join('school_class','exam_admin_card.class_id','=','school_class.id')
            ->join('exams','exam_admin_card.exam_id','=','exams.id')
            ->join('student_addmission','exam_admin_card.student_id','=','student_addmission.id')
                ->where('exams.school_id', Auth::guard('admin')->user()->school_id)
        ->where('exams.status', 'ACTIVE')
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('exams.exam_name', 'like', '%' . $search . '%');
                $q->orWhere('school_class.name', 'like', '%' . $search . '%');
                $q->orWhere('student_addmission.name', 'like', '%' . $search . '%');
                $q->orWhere('student_addmission.roll_no', 'like', '%' . $search . '%');
                $q->orWhere('student_addmission.phone', 'like', '%' . $search . '%');
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
            $student->examName,
            $student->className,
            $student->studentName,
            $student->fatherName,
            $student->phone,
            $student->rollNo,
            $student->issue_date,
            
            '<a href="'.route('admin.print_admit_card',[base64_encode($student->student_id)]).'" class="btn-action admit-card">
                        <i class="fas fa-user-shield"></i> View Admit Card
                    </a>'

        ];
            }
        
            // Final JSON response
            return response()->json([
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
                'data' => $data
            ]);
             }
             
             
             
             public function generate_admit_card(Request $request)
{
    DB::beginTransaction();

    try {
        $schoolId = Auth::guard('admin')->user()->school_id;

        // Step 1: Validation
        $validator = Validator::make($request->all(), [
            'exam_id' => 'required',
            'class_id' => 'required',
        ]);

        // Return validation errors
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors()->first()
            ]);
        }

        // Step 2: Check if Admit Card is already generated for the given exam & class
        $admitCardExists = ExamAdmitCard::where('school_id', $schoolId)
            ->where('class_id', $request->class_id)
            ->where('exam_id', $request->exam_id)
            ->exists();

        if ($admitCardExists) {
            return response()->json([
                'status' => false,
                'msg' => 'This exam admit card has already been generated.'
            ]);
        }

        // Step 3: Get the students for the given class
        $students = StudentAddmission::where('class_id', $request->class_id)
            ->where('status', 'ACTIVE')
            ->get();

        // Step 4: Generate Admit Cards for each student
        foreach ($students as $student) {
            $admitCard = new ExamAdmitCard();
            $admitCard->school_id = $schoolId;
            $admitCard->exam_id = $request->exam_id;
            $admitCard->class_id = $request->class_id;
            $admitCard->student_id = $student->id;
            $admitCard->issue_date = now();
            $admitCard->save();
        }

        DB::commit();

        return response()->json([
            'status' => true,
            'msg' => 'Admit card(s) generated successfully.'
        ], 201);

    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'status' => false,
            'msg' => 'Something went wrong. Please try again later.',
            'error' => $e->getMessage()
        ], 500);
    }
     }
     
     
          public function exam_marks()
            {
                
               $exam = Exams::where('school_id', Auth::guard('admin')->user()->school_id)->where('status', 'ACTIVE')->get();
               $class = SchoolClass::where('school_id', Auth::guard('admin')->user()->school_id)->where('status', 'ACTIVE')->get();
               $subject = SchoolSubject::where('school_id', Auth::guard('admin')->user()->school_id)->where('status', 'ACTIVE')->get();
              return view('admin.exam.exam-marks', compact('exam', 'class','subject'));
        
            }
            
            
            
            
            public function get_exam_marks(Request $request)
{
    $search = $request->input('search.value', '');
    $limit = $request->input('length', 10);
    $offset = $request->input('start', 0);

    // Default sorting
    $orderColumnIndex = $request->input('order.0.column', 0);
    $orderType = $request->input('order.0.dir', 'desc');
    $columns = $request->input('columns', []);
    $nameOrder = isset($columns[$orderColumnIndex]['name']) ? $columns[$orderColumnIndex]['name'] : 'exam_marks.id';

    $schoolId = Auth::guard('admin')->user()->school_id;

    // Get total count (without search)
    $total = ExamMarks::where('school_id', $schoolId)
        ->where('status', 'ACTIVE')
        ->count();

    // Base query with joins
    $baseQuery = ExamMarks::select(
            'exam_marks.*',
            'exams.exam_name as examName',
            'school_class.name as className',
            'student_addmission.name as studentName',
            'student_addmission.father_name as fatherName',
            'exam_marks.marks_obtained',
            'student_addmission.id as student_id',
            'school_subject.name as subjectName',
            'exam_subjects.max_marks as totalMarks',
            'exam_marks.remarks'
        )
        ->join('school_class', 'exam_marks.class_id', '=', 'school_class.id')
        ->join('school_subject', 'exam_marks.subject_id', '=', 'school_subject.id')
        ->join('exam_subjects', function ($join) {
            $join->on('exam_marks.subject_id', '=', 'exam_subjects.subject_id')
                 ->on('exam_marks.exam_id', '=', 'exam_subjects.exam_id')
                 ->on('exam_marks.class_id', '=', 'exam_subjects.class_id');
        })
        ->join('exams', 'exam_marks.exam_id', '=', 'exams.id')
        ->join('student_addmission', 'exam_marks.student_id', '=', 'student_addmission.id')
        ->where('exam_marks.school_id', $schoolId)
        ->where('exam_marks.status', 'ACTIVE');

    // Apply search filter if any
    if ($search) {
        $baseQuery->where(function ($query) use ($search) {
            $query->orWhere('exams.exam_name', 'like', '%' . $search . '%')
                  ->orWhere('school_class.name', 'like', '%' . $search . '%')
                  ->orWhere('student_addmission.name', 'like', '%' . $search . '%')
                  ->orWhere('student_addmission.father_name', 'like', '%' . $search . '%')
                  ->orWhere('school_subject.name', 'like', '%' . $search . '%');
        });
    }

    // Get filtered count
    $filteredCount = $baseQuery->count();

    // Get data with pagination and sorting
    $students = $baseQuery
        ->offset($offset)
        ->limit($limit)
        ->orderBy($nameOrder, $orderType)
        ->get();

    // Format data for response
    $data = [];
    $i = $offset + 1;

    foreach ($students as $student) {
        $data[] = [
            $i++,
            $student->examName,
            $student->className,
            $student->studentName,
            $student->fatherName,
            $student->subjectName,
            $student->totalMarks,
            $student->marks_obtained,
            $student->remarks,
            '<button type="button" data-id="' . $student->id . '" data-exam_id="' . $student->exam_id . '" data-class_id="' . $student->class_id . '" id="update_exam_class"  
                class="btn btn-sm btn-outline-primary" style="font-size: 16px; padding: 0px 16px;" title="Edit">
                <i class="fas fa-pen"></i>
            </button> 
            <button class="btn btn-danger btn-icon-sm delete-btn" data-id="' . $student->id . '" title="Delete">
                <i class="fas fa-trash-alt"></i>
            </button>'
        ];
    }

    // Final JSON response for DataTable
    return response()->json([
        'recordsTotal' => $total,
        'recordsFiltered' => $filteredCount,
        'data' => $data
    ]);
}

             
             
             
             
             public function get_student_data(Request $request){
            
            $student = StudentAddmission::where('class_id', $request->class_id)
            ->where('school_id', Auth::guard('admin')->user()->school_id)
            ->where('status','ACTIVE')
            ->get();
            
            return response()->json([
            'status'   => true,
            'data'      => $student
            
        ]);
            
        }
        
        
        public function get_student_subjects(Request $request){
            
            $student = ExamSubjects::select('exam_subjects.*', 'school_subject.name as subjectName')
            ->join('school_subject','exam_subjects.subject_id','=','school_subject.id')->where('class_id', $request->class_id)
            ->where('exam_subjects.school_id', Auth::guard('admin')->user()->school_id)
            ->where('exam_subjects.status','ACTIVE')
            ->get();
            
            return response()->json([
            'status'   => true,
            'data'      => $student
            
        ]);
            
        }
        
        
        
        public function save_exam_marks(Request $request)
{
    $user = Auth::guard('admin')->user();
    if (!$user) {
        return response()->json([
            'status' => false,
            'msg' => 'Admin user not authenticated',
        ]);
    }
    $schoolId = $user->school_id;

    if (!$schoolId) {
        return response()->json([
            'status' => false,
            'msg' => 'School ID not found on logged in user',
        ]);
    }

    // Validation
    $validator = Validator::make($request->all(), [
        'exam_id' => 'required|exists:exams,id',
        'class_id' => 'required|exists:school_class,id',
        'student_id' => 'required|exists:student_addmission,id',
        'subjects_id' => 'required|array',
        'marks_scored' => 'required|array',
        'max_marks' => 'required|array',
        'subjects_id.*' => 'required|integer',
        'marks_scored.*' => 'required|numeric|min:0',
        'max_marks.*' => 'required|numeric|min:0',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'msg' => $validator->errors()->first(),
        ]);
    }

    DB::beginTransaction();

    try {
        $exam_id = $request->exam_id;
        $class_id = $request->class_id;
        $student_id = $request->student_id;
        $subjects = $request->subjects_id;
        $marks_scored = $request->marks_scored;
        $max_marks = $request->max_marks;

        foreach ($subjects as $index => $subject_id) {
            // Check if marks already exist for this exam, class, student, subject
            $exists = ExamMarks::where('school_id', $schoolId)
                ->where('exam_id', $exam_id)
                ->where('class_id', $class_id)
                ->where('student_id', $student_id)
                ->where('subject_id', $subject_id)
                ->first();

            if ($exists) {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'msg' => "Marks for subject ID {$subject_id} already exist for this exam, class, and student.",
                ]);
            }

            ExamMarks::create([
                'school_id' => $schoolId,
                'exam_id' => $exam_id,
                'class_id' => $class_id,
                'student_id' => $student_id,
                'subject_id' => $subject_id,
                'marks_obtained' => $marks_scored[$index],
            ]);
        }

        DB::commit();

        return response()->json([
            'status' => true,
            'msg' => 'Exam marks saved successfully.',
        ]);
    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'status' => false,
            'msg' => 'Something went wrong. Please try again later.',
            'error' => $e->getMessage(),
        ]);
    }
}



    
   
    


}
