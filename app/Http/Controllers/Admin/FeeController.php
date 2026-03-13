<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentRegistration;
use App\Models\StudentAddmission;
use App\Models\School;
use App\Models\SchoolClass;
use App\Models\SchoolSection;
use App\Models\SchoolSession;
use App\Models\StudentPromotion;
use App\Models\FeeType;
use App\Models\FeeSetting;
use App\Models\StudentFees;
use App\Models\StudentFeePayments;
use App\Models\StudentFeePaymentDetail;
use App\Models\FamilyFeePayments;
use App\Models\FamilyFeeStudents;
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

class FeeController extends Controller
{
    /**
     * Show the admin dashboard.
     */
     
     
     public function fees_type()
    {
        
        $class = SchoolClass::where('school_id', Auth::guard('admin')->user()->school_id)->get();
       
      return view('admin.fee.fees_type',compact('class'));

    }
     
     
    public function fee_setting()
    {
        
        $class = SchoolClass::where('school_id', Auth::guard('admin')->user()->school_id)->get();
        $fees = FeeType::where('school_id', Auth::guard('admin')->user()->school_id)->get();
       
      return view('admin.fee.fee_setting',compact('class','fees'));

    }
    
    
    
    
    
          public function get_fee_setting(Request $request)
          {
    $search = $request->input('search.value', '');
    $limit = $request->input('length', 10);
    $ofset = $request->input('start', 0);

    $orderColumnIndex = $request->input('order.0.column', 0);
    $orderType = $request->input('order.0.dir', 'desc');
    $columns = $request->input('columns', []);
    $nameOrder = isset($columns[$orderColumnIndex]['name']) ? $columns[$orderColumnIndex]['name'] : 'id';

    $total = FeeSetting::where('school_id', Auth::guard('admin')->user()->school_id)
        ->where('status', 'ACTIVE')
        ->count();

    $students = FeeSetting::select('fee_setting.*', 'school_class.name as class_name')
        ->join('school_class', 'fee_setting.class_id', '=', 'school_class.id')
        ->where('fee_setting.school_id', Auth::guard('admin')->user()->school_id)
        ->where('fee_setting.status', 'ACTIVE')
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('fee_setting.fees_type', 'like', '%' . $search . '%')
                    ->orWhere('school_class.name', 'like', '%' . $search . '%');
            });
        })
        ->offset($ofset)
        ->limit($limit)
        ->orderBy($nameOrder, $orderType)
        ->get();

    $data = [];
    $i = $ofset + 1;

    foreach ($students as $student) {
        
        if($student->status== "ACTIVE"){
            $status = '<span class="badge-status badge-active">Active</span>';
        }else{
            $status = '<span class="badge-status badge-inactive">Inactive</span>';
        }
        
        $action = '<button class="btn btn-warning btn-icon-sm edit-btn" data-id="'.$student->id.'" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button> <button class="btn btn-danger btn-icon-sm delete-btn" data-id="'.$student->id.'" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>';
        

        $data[] = [
            $i++,
            $student->class_name,
            $student->fees_type,
            '&#8377;' . number_format($student->amount, 2),
            $status,
            $action
        ];
    }

    return response()->json([
        'recordsTotal' => $total,
        'recordsFiltered' => $total,
        'data' => $data
    ]);
}

   
   
   
   
        public function save_fee_setting(Request $request){
            DB::beginTransaction();

          try {
              
              $chk = FeeSetting::where('school_id', Auth::guard('admin')->user()->school_id)->where('class_id', $request->class_id)->where('fees_type', $request->fees_type)->first();
              
              if($chk){
                  return response()->json([
                'status' => false,
                'msg'    => 'Fees already set.'
            ]);
              }
            
            $fee = new FeeSetting();
            $fee->school_id = Auth::guard('admin')->user()->school_id;
            $fee->class_id = $request->class_id;
            $fee->fees_type = $request->fees_type;
            $fee->amount = $request->amount;
            $fee->status = $request->status;
            $fee->save();
            
            DB::commit();

        return response()->json([
            'status'   => true,
            'msg'      => "Fee Setting Successfully."
        ]);

    } catch (\Exception $e) {
        DB::rollback();

        return response()->json([
            'status' => false,
            'msg'    => "Error: " . $e->getMessage()
        ]);
    }
            
        }
        
        
        
        
        
        public function get_fees_type(Request $request)
          {
    $search = $request->input('search.value', '');
    $limit = $request->input('length', 10);
    $ofset = $request->input('start', 0);

    $orderColumnIndex = $request->input('order.0.column', 0);
    $orderType = $request->input('order.0.dir', 'desc');
    $columns = $request->input('columns', []);
    $nameOrder = isset($columns[$orderColumnIndex]['name']) ? $columns[$orderColumnIndex]['name'] : 'id';

    $total = FeeType::where('school_id', Auth::guard('admin')->user()->school_id)
        ->where('status', 'ACTIVE')
        ->count();

    $students = FeeType::select('fee_types.*')
        
        ->where('fee_types.school_id', Auth::guard('admin')->user()->school_id)
        ->where('fee_types.status', 'ACTIVE')
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('fee_types.name', 'like', '%' . $search . '%');
                    
            });
        })
        ->offset($ofset)
        ->limit($limit)
        ->orderBy($nameOrder, $orderType)
        ->get();

    $data = [];
    $i = $ofset + 1;

    foreach ($students as $student) {
        
        if($student->status== "ACTIVE"){
            $status = '<span class="badge-status badge-active">Active</span>';
        }else{
            $status = '<span class="badge-status badge-inactive">Inactive</span>';
        }
        
        $action = '<button class="btn btn-warning btn-icon-sm edit-btn" data-id="'.$student->id.'" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button> <button class="btn btn-danger btn-icon-sm delete-btn" data-id="'.$student->id.'" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>';

        $data[] = [
            $i++,
            $student->name,
            $student->fees_code,
            $status,
            $action,
        ];
    }

    return response()->json([
        'recordsTotal' => $total,
        'recordsFiltered' => $total,
        'data' => $data
    ]);
}
        
        
        
        
        
         public function save_fee_type(Request $request){
         
            DB::beginTransaction();
        
            try {
        
        
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'fees_code' => 'required|string|max:50',
                    
                ]);
        
                if ($validator->fails()) {
                    return response()->json([
                        'status' => false,
                        'msg'    => $validator->errors()->first()
                    ]);
                }
        
        
        
        // Step 2: Check for duplicate fee code for the same school
        $chk = FeeType::where('school_id', Auth::guard('admin')->user()->school_id)
                      ->where('fees_code', $request->fees_code)
                      ->first();

        if ($chk) {
            return response()->json([
                'status' => false,
                'msg'    => 'Fees type already exists.'
            ]);
        }

        // Step 3: Save new fee type
        $fee = new FeeType();
        $fee->school_id = Auth::guard('admin')->user()->school_id;
        $fee->name = $request->name;
        $fee->fees_code = $request->fees_code;
        $fee->save();

        DB::commit();

        return response()->json([
            'status' => true,
            'msg'    => "Fee Setting Successfully."
        ]);

    } catch (\Exception $e) {
        DB::rollback();

        return response()->json([
            'status' => false,
            'msg'    => "Error: " . $e->getMessage()
        ]);
    }
  }
  
  
  
    

        
        
        
        public function delete_fee_type(Request $request)
            {
               
                try {
                    $feeType = FeeType::find($request->id);
            
                    if (!$feeType) {
                        return response()->json([
                            'status' => false,
                            'msg' => 'Fee Type not found.'
                        ]);
                    }
            
                    $feeType->delete();
            
                    return response()->json([
                        'status' => true,
                        'msg' => 'Fee Type deleted successfully.'
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => false,
                        'msg' => 'Something went wrong. Please try again.'
                    ]);
                }
            }
            
            
            
            public function delete_fee_setting(Request $request)
            {
               
                try {
                    $feeType = FeeSetting::find($request->id);
            
                    if (!$feeType) {
                        return response()->json([
                            'status' => false,
                            'msg' => 'Fee Setting not found.'
                        ]);
                    }
            
                    $feeType->delete();
            
                    return response()->json([
                        'status' => true,
                        'msg' => 'Fee Setting deleted successfully.'
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => false,
                        'msg' => 'Something went wrong. Please try again.'
                    ]);
                }
            }        

        
        
         public function student_fees()
            {
                $student = StudentAddmission::where('school_id', Auth::guard('admin')->user()->school_id)->get();
                $class = SchoolClass::where('school_id', Auth::guard('admin')->user()->school_id)->get();
                
                $fees = FeeSetting::select('fee_setting.*','school_class.name as class_name','fee_setting.class_id')
                ->join('school_class','fee_setting.class_id','=','school_class.id')
                ->where('fee_setting.school_id', Auth::guard('admin')->user()->school_id)->get();
               
              return view('admin.fee.student_fees',compact('class','fees','student'));
        
            }
            
            
            
            public function add_student_fee(Request $request)
                {
                    // ðŸ”¹ Step 1: Validation Rules
                    $validator = \Validator::make($request->all(), [
                        'fee_type_id' => 'required|integer|exists:fee_setting,id',
                        'class_id'    => 'required|integer|exists:school_class,id',
                        'month'       => 'required|integer|min:1|max:12',
                        'year'        => 'required|integer|min:2000|max:2100',
                        'amount'      => 'required|numeric|min:0',
                        'due_date'    => 'required|date',
                        'status'      => 'required|in:partial,paid,unpaid',
                    ]);
                
                    // ðŸ”¹ Step 2: If validation fails
                    if ($validator->fails()) {
                        return response()->json([
                            'status' => false,
                            'msg'    => $validator->errors()->first()
                        ]);
                    }
                
                    DB::beginTransaction();
                
                    try {
                        // Get the school ID once
                        $schoolId = Auth::guard('admin')->user()->school_id;
                        
                        // Check if the fee is already set for the student/class/month/year
                        $chk = StudentFees::where('school_id', $schoolId)
                            ->where('fee_type_id', $request->fee_type_id)
                            ->where('class_id', $request->class_id)
                            ->where('month', $request->month)
                            ->where('year', $request->year)
                            ->first();
                
                        if ($chk) {
                            return response()->json([
                                'status' => false,
                                'msg'    => 'Student Fees already set.'
                            ]);
                        }
                
                        // Fetch all students in the given class
                        $students = StudentAddmission::where('school_id', $schoolId)
                            ->where('class_id', $request->class_id)
                            ->get();
                
                        if ($students->isEmpty()) {
                            return response()->json([
                                'status' => false,
                                'msg'    => 'No students found in this class.'
                            ]);
                        }
                
                        // Collect all fee entries to insert in bulk
                        $feeEntries = [];
                        foreach ($students as $student) {
                            $feeEntries[] = [
                                'school_id'     => $schoolId,
                                'fee_type_id'   => $request->fee_type_id,
                                'student_id'    => $student->id,
                                'amount'        => $request->amount,
                                'due_date'      => $request->due_date,
                                'month'         => $request->month,
                                'year'          => $request->year,
                                'class_id'      => $request->class_id,
                                'date'          => now(),
                                'status'        => $request->status,
                            ];
                        }
                
                        // Bulk insert fee entries
                        StudentFees::insert($feeEntries);
                
                        DB::commit();
                
                        return response()->json([
                            'status' => true,
                            'msg'    => 'Student Fee Setting Successfully.'
                        ]);
                
                    } catch (\Exception $e) {
                        DB::rollback();
                
                        \Log::error("Error adding student fees: " . $e->getMessage());
                
                        return response()->json([
                            'status' => false,
                            'msg'    => 'Error: ' . $e->getMessage()
                        ]);
                    }
                }


        
        
        
        
        
        public function get_student_fee_list(Request $request)
          {
              
         date_default_timezone_set('Asia/Kolkata');
              
    $search = $request->input('search.value', '');
    $limit = $request->input('length', 10);
    $ofset = $request->input('start', 0);

    $orderColumnIndex = $request->input('order.0.column', 0);
    $orderType = $request->input('order.0.dir', 'desc');
    $columns = $request->input('columns', []);
    $nameOrder = isset($columns[$orderColumnIndex]['name']) ? $columns[$orderColumnIndex]['name'] : 'id';

    $total = StudentFees::where('school_id', Auth::guard('admin')->user()->school_id)
        
        ->count();

    $students = StudentFees::select('student_fees.*', 'fee_setting.fees_type as fees_name','student_addmission.name as student_name','student_addmission.father_name as fatherName'
    ,'student_addmission.phone as studentPhone','school_class.name as class_name')
        ->join('student_addmission', 'student_fees.student_id', '=', 'student_addmission.id')
        ->join('fee_setting', 'student_fees.fee_type_id', '=', 'fee_setting.id')
        ->join('school_class', 'student_addmission.class_id', '=', 'school_class.id')
        ->where('student_fees.school_id', Auth::guard('admin')->user()->school_id)
        
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('student_addmission.name', 'like', '%' . $search . '%')
                    ->orWhere('fee_setting.fees_type', 'like', '%' . $search . '%');
            });
        })
        ->offset($ofset)
        ->limit($limit)
        ->orderBy($nameOrder, $orderType)
        ->get();

    $data = [];
    $i = $ofset + 1;

    foreach ($students as $student) {
        
        if($student->status== "paid"){
            $status = '<span class="badge-status badge-active">Paid</span>';
        }else{
            $status = '<span class="badge-status badge-inactive">Unpaid</span>';
        }
        
        $action = '<button class="btn btn-warning btn-icon-sm edit-btn" data-id="'.$student->id.'" title="Edit" style="display:none;">
                                <i class="fas fa-edit"></i>
                            </button> <button class="btn btn-danger btn-icon-sm delete-btn" data-id="'.$student->id.'" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>';
          $feeDate = date($student->year . '-' . $student->month . '-01');                    
          $date = date('M, Y', strtotime($feeDate));
                
        

        $data[] = [
            $i++,
            $student->class_name,
            $student->student_name,
            $student->fatherName,
            $student->studentPhone,
            $student->fees_name,
            '&#8377;' . number_format($student->amount, 2),
            $date,
            date('d M, Y', strtotime($student->due_date)),
            $status,
        ];
    }

    return response()->json([
        'recordsTotal' => $total,
        'recordsFiltered' => $total,
        'data' => $data
    ]);
    }
    
    
    public function get_fee_type_data(Request $request){
        
        $feeType = FeeSetting::find($request->id);
            
                    if ($feeType) {
                        return response()->json([
                            'status' => true,
                            'due_date' => $feeType->due_date,
                            'amount' => $feeType->amount
                        ]);
                    }
        
    }
    
    
    
    public function all_fees()
    {
       
      $student = StudentAddmission::where('school_id', Auth::guard('admin')->user()->school_id)->get();
                $class = SchoolClass::where('school_id', Auth::guard('admin')->user()->school_id)->get();
                $fees = FeeSetting::select('fee_setting.*','school_class.name as class_name','fee_setting.class_id')
                ->join('school_class','fee_setting.class_id','=','school_class.id')
                ->where('fee_setting.school_id', Auth::guard('admin')->user()->school_id)->get();
               
              return view('admin.fee.all-fees',compact('class','fees','student'));

    }
    
    
    
    public function delete_student_fee(Request $request)
            {
               
                try {
                    $feeType = StudentFees::find($request->id);
            
                    if (!$feeType) {
                        return response()->json([
                            'status' => false,
                            'msg' => 'Student fee not found.'
                        ]);
                    }
            
                    $feeType->delete();
            
                    return response()->json([
                        'status' => true,
                        'msg' => 'Student Fee deleted successfully.'
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => false,
                        'msg' => 'Something went wrong. Please try again.'
                    ]);
                }
            }  
            
            
            
            
             public function get_student_payment_list(Request $request)
          {
    $search = $request->input('search.value', '');
    $limit = $request->input('length', 10);
    $ofset = $request->input('start', 0);

    $orderColumnIndex = $request->input('order.0.column', 0);
    $orderType = $request->input('order.0.dir', 'desc');
    $columns = $request->input('columns', []);
    $nameOrder = isset($columns[$orderColumnIndex]['name']) ? $columns[$orderColumnIndex]['name'] : 'id';

    $total = StudentFeePayments::where('school_id', Auth::guard('admin')->user()->school_id)
        
        ->count();

    $students = StudentFeePayments::select('student_fee_payments.*','student_addmission.name as student_name','school_class.name as class_name')
        ->join('student_addmission', 'student_fee_payments.student_id', '=', 'student_addmission.id')
        ->join('school_class', 'student_addmission.class_id', '=', 'school_class.id')
        ->where('student_fee_payments.school_id', Auth::guard('admin')->user()->school_id)
        
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('student_addmission.name', 'like', '%' . $search . '%');
            });
        })
        ->offset($ofset)
        ->limit($limit)
        ->orderBy($nameOrder, $orderType)
        ->get();

    $data = [];
    $i = $ofset + 1;

    foreach ($students as $student) {
        
        if($student->status== "paid"){
            $status = '<span class="badge-status badge-active">Paid</span>';
        }else{
            $status = '<span class="badge-status badge-inactive">Unpaid</span>';
        }
        
        $action = '<button class="btn btn-warning btn-icon-sm edit-btn" data-id="'.$student->id.'" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button> <button class="btn btn-danger btn-icon-sm delete-btn" data-id="'.$student->id.'" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>';
                            
        if($student->family_plan > 0){                    
        $receipt = '<a href="'.url('admin/print-family-receipt/'.$student->family_plan.'').'" class="btn btn-success btn-icon-sm" target="_blank" title="Print Receipt">
                <i class="fas fa-print"></i>
            </a>';
            
        }else{
           
           $receipt = '<a href="'.url('admin/print-receipt/'.$student->id.'').'" class="btn btn-success btn-icon-sm" target="_blank" title="Print Receipt">
                <i class="fas fa-print"></i>
            </a>'; 
        }

        $data[] = [
            $i++,
            date('d M, Y', strtotime($student->date)),
            $student->receipt_no,
            $student->student_name,
            $student->class_name,
            $student->payment_mode,
            '&#8377;' . number_format($student->total_amount, 2),
            '&#8377;' . number_format($student->due_amount, 2),
            $receipt,
            $status,
            $action
        ];
    }

    return response()->json([
        'recordsTotal' => $total,
        'recordsFiltered' => $total,
        'data' => $data
    ]);
    }
    
    
        
        public function get_student_due_amount(Request $request)
        {
            $studentId = $request->id;
        
            $schoolId = Auth::guard('admin')->user()->school_id;
        
            // Total due amount (only unpaid or partial)
            $dueAmount = StudentFees::where('school_id', $schoolId)
                ->where('student_id', $studentId)
                
                ->sum('amount');
                
        
            // Total paid amount
            $paidAmount = DB::table('student_fee_payment_details')
                ->join('student_fee_payments', 'student_fee_payments.id', '=', 'student_fee_payment_details.payment_id')
                ->where('student_fee_payments.student_id', $studentId)
                ->sum('student_fee_payment_details.amount_paid');
                
                
        
            $balanceAmt = $dueAmount - $paidAmount;
        
            return response()->json([
                'status' => true,
                'balance_amt' => $balanceAmt
            ]);
        }

          
          
          
        public function get_student_fee_month(Request $request){
            
            $class = FeeSetting::where('class_id', $request->class_id)->get();
            
            return response()->json([
            'status'   => true,
            'data'      => $class
            
        ]);
            
        }
        
        
        public function get_student_fee_data(Request $request){
            
            $class = StudentAddmission::where('class_id', $request->class_id)->get();
            
            return response()->json([
            'status'   => true,
            'data'      => $class
            
        ]);
            
        }
        
        
        
        
        
        public function add_student_payment(Request $request)
       {
    
        // Validate request
        $request->validate([
            'student_id'    => 'required|exists:student_addmission,id',
            'class_id'    => 'required|exists:school_class,id',
            'amount'        => 'required|numeric|min:0',
            'due_amount'    => 'nullable|numeric|min:0',
            'date'          => 'required|date',
            'payment_mode'  => 'required|string|max:50',
            
        ]);

        // Generate receipt number
        $year   = now()->format('Y');
        $prefix = 'R-' . $year . '-';
        $count = StudentFeePayments::whereYear('created_at', $year)->count();
        $serial = str_pad($count + 1, 4, '0', STR_PAD_LEFT);
        $receiptNo = $prefix . $serial;

        // Create main payment entry
        $payment = new StudentFeePayments();
        $payment->school_id     = Auth::guard('admin')->user()->school_id;
        $payment->class_id    = $request->class_id;
        $payment->student_id    = $request->student_id;
        $payment->total_amount  = $request->amount;
        $payment->due_amount    = $request->due_amount ?? 0;
        $payment->date          = $request->date;
        $payment->payment_mode  = $request->payment_mode;
        $payment->receipt_no    = $receiptNo;
        $payment->save();

        // Fetch student_fees rows for the given student/month/year
        $studentFees = StudentFees::where('student_id', $request->student_id)->where('status','!=','paid')->get();

        $remainingAmount = $request->amount;

        foreach ($studentFees as $fee) {
            if ($remainingAmount <= 0) break;

           $Sfee = StudentFeePaymentDetail::where('student_fee_id', $fee->id)->sum(DB::raw('amount_paid'));
           if($Sfee > 0){
            $due = $fee->amount - $Sfee;
           }else{
               $due = $fee->amount;
           }
            $paidNow = ($remainingAmount >= $due) ? $due : $remainingAmount;

            // Insert into student_fee_payment_details
            DB::table('student_fee_payment_details')->insert([
                'payment_id'      => $payment->id,
                'student_fee_id'  => $fee->id,
                'fee_type_id'     => $fee->fee_type_id ?? null,
                'amount_paid'     => $paidNow,
                'status'          => 'ACTIVE',
                'date'            => $request->date,
                'created_at'      => now(),
                'updated_at'          => now(),
            ]);

            

            
            
            if($Sfee > 0){
            if ($fee->amount <= ($Sfee + $request->amount)) {
                $status = 'paid';
                
            } elseif ($fee->amount > ($Sfee + $request->amount)) {
                $status = 'partial';
            } else {
                $status = 'unpaid';
            }
            }else{
                
                
                if ($fee->amount <= $paidNow) {
                $status = 'paid';
                
            } elseif ($fee->amount > $paidNow) {
                $status = 'partial';
            } else {
                $status = 'unpaid';
            }
            }

            // Update status in student_fees
            $fee->status = $status;
            $fee->update();

            $remainingAmount -= $paidNow;
        }

        

        return response()->json([
            'status'  => true,
            'msg'     => "Student fee payment added successfully.",
            'receipt' => $receiptNo
        ]);

    
}

   
   
   public function generateReceipt($id){
       $payment = StudentFeePayments::where('id', $id)->first();
       $fee = StudentFeePaymentDetail::select('student_fee_payment_details.*', 'fee_types.name as fee_name')
    ->join('student_fee_payments', 'student_fee_payment_details.payment_id', '=', 'student_fee_payments.id')
    ->join('fee_types', 'student_fee_payment_details.fee_type_id', '=', 'fee_types.id')
    ->where('payment_id', $id)
    ->get();
    
    $total_amt = StudentFeePaymentDetail::where('payment_id', $id)->sum('amount_paid');
    
    $numberToWords = new NumberToWords();
    $numberTransformer = $numberToWords->getNumberTransformer('en'); // 'en' is for English language
    $amountInWords = $numberTransformer->toWords($total_amt);

       $student = StudentAddmission::where('id', $payment->student_id)
        ->first();
        $school = School::where('id', Auth::guard('admin')->user()->school_id)->first();
        $Cclass = SchoolClass::where('id', $student->class_id)->first();
        $Ssec = SchoolSection::where('id', $student->section_id)->first();
        $session = SchoolSession::where('id', $student->session_id)->first();
       return view('admin.fee.fee_invoice',compact('fee','student','payment','school','Cclass','Ssec','total_amt','amountInWords','session'));
   }
   
   
   
   public function family_fee_collection()
    {
        
        $class = SchoolClass::where('school_id', Auth::guard('admin')->user()->school_id)->get();
       
      return view('admin.fee.family_fee_collection', compact('class'));

    }
    
    
    
          public function search_parent_due(Request $request)
{
    $parent = DB::table('parents')->where('phone', $request->mobile)->first();

    if (!$parent) {
        return response()->json(['status' => false, 'msg' => 'Parent not found.']);
    }

    // Get all students under parent
    $students = DB::table('student_addmission')
        ->select('student_addmission.*', 'school_class.name as class_name')
        ->join('school_class', 'student_addmission.class_id', '=', 'school_class.id')
        ->where('student_addmission.parent_id', $parent->id)
        ->get();

    if ($students->isEmpty()) {
        return response()->json(['status' => false, 'msg' => 'No students found for this parent.']);
    }

    // If only one student → not a family
    if ($students->count() == 1) {
        return response()->json([
            'status' => false,
            'msg' => 'Only one student found for this parent — no family group available.'
        ]);
    }

    $data = [];
    $studentsWithDue = 0; // ✅ count of students having pending dues

    foreach ($students as $stu) {
        // Fetch fee entries of this student
        $fees = DB::table('student_fees')->where('student_id', $stu->id)->get();

        if ($fees->isEmpty()) {
            continue; // skip if no fees
        }

        $total_fee = 0;
        $paid_fee = 0;

        foreach ($fees as $f) {
            $total_fee += $f->amount;

            if ($f->status == 'paid') {
                $paid_fee += $f->amount;
            } elseif ($f->status == 'partial') {
                $paid_fee += $f->paid_amount ?? 0;
            }
        }

        $due_fee = $total_fee - $paid_fee;

        // ✅ Count only if student has dues
        if ($due_fee > 0) {
            $studentsWithDue++;
        }

        $data[] = [
            'student_name' => $stu->name,
            'class_name'   => $stu->class_name,
            'total_fee'    => $total_fee,
            'paid_fee'     => $paid_fee,
            'due_fee'      => $due_fee,
        ];
    }

    // ✅ Check if 2 or more students have dues
    if ($studentsWithDue < 2) {
        return response()->json([
            'status' => false,
            'msg' => 'Family dues not found — less than 2 students have pending fees.'
        ]);
    }

    // ✅ Return family data
    return response()->json([
        'status' => true,
        'msg' => 'Family students and dues loaded successfully.',
        'data' => $data
    ]);
}







            public function family_fee_payment(Request $request)
{
    $request->validate([
        'mobile'        => 'required',
        'total_due'     => 'required|numeric|min:0',
        'discount'      => 'nullable|numeric|min:0',
        'payable'       => 'required|numeric|min:0',
        'date'          => 'nullable|date',
        'payment_mode'  => 'nullable|string|max:50',
    ]);

    // ✅ Fetch parent
    $parent = DB::table('parents')->where('phone', $request->mobile)->first();
    if (!$parent) {
        return response()->json(['status' => false, 'msg' => 'Parent not found.']);
    }

    // ✅ Fetch students
    $students = DB::table('student_addmission')
        ->select('student_addmission.*', 'school_class.name as class_name')
        ->join('school_class', 'student_addmission.class_id', '=', 'school_class.id')
        ->where('student_addmission.parent_id', $parent->id)
        ->get();

    if ($students->isEmpty()) {
        return response()->json(['status' => false, 'msg' => 'No students found for this parent.']);
    }

    $schoolId = Auth::guard('admin')->user()->school_id;
    $date = $request->date ?? now();
    $paymentMode = $request->payment_mode ?? 'Cash';
    $currentMonth = now()->format('m');
    $currentYear = now()->format('Y');

    // ✅ Family Receipt Number
    $prefix = 'F-' . $currentYear . '-';
    $count = DB::table('family_fee_payments')->whereYear('created_at', $currentYear)->count();
    $serial = str_pad($count + 1, 4, '0', STR_PAD_LEFT);
    $receiptNo = $prefix . $serial;

    // ✅ 1. Insert into family_fee_payments
    $familyPaymentId = DB::table('family_fee_payments')->insertGetId([
        'school_id'    => $schoolId,
        'parent_id'    => $parent->id,
        'total_due'    => $request->total_due,
        'discount'     => $request->discount ?? 0,
        'paid_amount'  => $request->payable,
        'status'       => 'ACTIVE',
        'payment_mode' => $paymentMode,
        'date'         => $date,
        'created_at'   => now(),
        'updated_at'   => now(),
    ]);

    $remainingAmount = $request->payable;
    $studentDiscountShare = ($request->discount ?? 0) / max(1, $students->count());

    // ✅ 2. Loop through students
    foreach ($students as $stu) {
        if ($remainingAmount <= 0) break;

        // Fetch all pending fees (multiple months also)
        $studentFees = DB::table('student_fees')
            ->where('student_id', $stu->id)
            ->whereIn('status', ['unpaid', 'partial'])
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        if ($studentFees->isEmpty()) continue;

        $studentTotalPaid = 0;
        $studentTotalDue = 0;

        // ✅ Create master student_fee_payments entry
        $studentPaymentId = DB::table('student_fee_payments')->insertGetId([
            'school_id'    => $schoolId,
            'student_id'   => $stu->id,
            'class_id'     => $stu->class_id,
            'month'        => $currentMonth,
            'year'         => $currentYear,
            'total_amount' => 0,
            'discount'     => $studentDiscountShare,
            'due_amount'   => 0,
            'payment_mode' => $paymentMode,
            'receipt_no'   => $receiptNo,
            'date'         => $date,
            'status'       => 'ACTIVE',
            'family_plan'  => $familyPaymentId,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        // ✅ 3. Iterate over all due fee months
        foreach ($studentFees as $fee) {
            if ($remainingAmount <= 0) break;

            $alreadyPaid = DB::table('student_fee_payment_details')
                ->where('student_fee_id', $fee->id)
                ->sum('amount_paid');

            $due = $fee->amount - $alreadyPaid;
            if ($due <= 0) continue;

            $payNow = min($request->total_due, $due);

            // ✅ Validate fee_type_id
            $feeTypeId = DB::table('fee_types')->where('id', $fee->fee_type_id)->exists()
                ? $fee->fee_type_id
                : null;

            // ✅ Insert into student_fee_payment_details (month tracked)
            DB::table('student_fee_payment_details')->insert([
                'payment_id'     => $studentPaymentId,
                'fee_type_id'    => $feeTypeId,
                'student_fee_id' => $fee->id,
                'amount_paid'    => $fee->amount,
                'month'          => $fee->month,
                'year'           => $fee->year,
                'status'         => 'ACTIVE',
                'date'           => $date,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);

            // ✅ Update student_fees status
            $newPaid = $alreadyPaid + $payNow;
            $status = $newPaid >= $fee->amount ? 'paid' : ($newPaid > 0 ? 'partial' : 'unpaid');

            DB::table('student_fees')->where('id', $fee->id)->update([
                'status'     => $status,
                'updated_at' => now(),
            ]);

            // ✅ Update counters
            $studentTotalPaid += $payNow;
            $studentTotalDue += 0;
            $remainingAmount -= $payNow;
        }

        // ✅ Update student_fee_payments summary
        DB::table('student_fee_payments')->where('id', $studentPaymentId)->update([
            'total_amount' => $studentTotalPaid,
            'due_amount'   => $studentTotalDue,
            'updated_at'   => now(),
        ]);

        // ✅ Insert into family_fee_students summary
        if ($studentTotalPaid > 0) {
            DB::table('family_fee_students')->insert([
                'school_id'   => $schoolId,
                'family_id'   => $parent->id,
                'payment_id'  => $familyPaymentId,
                'class_id'    => $stu->class_id,
                'student_id'  => $stu->id,
                'fee_amount'  => $studentTotalPaid,
                'month'       => $currentMonth,
                'year'        => $currentYear,
                'status'      => 'ACTIVE',
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }

    return response()->json([
        'status'    => true,
        'msg'       => 'Family fee payment recorded successfully with month-wise tracking.',
        'receipt'   => $receiptNo,
        'family_id' => $familyPaymentId,
    ]);
}



    
    
    
    public function print_family_receipt($id)
{
    // 1️⃣ Main Family Payment Record
    $familyPayment = DB::table('family_fee_payments')->where('id', $id)->first();
    if (!$familyPayment) {
        abort(404, 'Family payment not found');
    }

    // 2️⃣ Parent Info
    $parent = DB::table('parents')->where('id', $familyPayment->parent_id)->first();

    // 3️⃣ Family Students
    $students = DB::table('family_fee_students')
        ->select(
            'family_fee_students.*',
            'student_addmission.name as student_name',
            'school_class.name as class_name'
        )
        ->join('student_addmission', 'family_fee_students.student_id', '=', 'student_addmission.id')
        ->join('school_class', 'family_fee_students.class_id', '=', 'school_class.id')
        ->where('family_fee_students.payment_id', $familyPayment->id)
        ->get();

    // 4️⃣ School Info (corrected table name)
    $school = DB::table('school')->where('id', Auth::guard('admin')->user()->school_id)->first();

    // 5️⃣ Amount in Words
    $numberToWords = new \NumberToWords\NumberToWords();
    $numberTransformer = $numberToWords->getNumberTransformer('en');
    $amountInWords = ucfirst(strtolower($numberTransformer->toWords($familyPayment->paid_amount))) . ' only';

    // 6️⃣ Final Totals
    $totalDue = (float)$familyPayment->total_due;
    $discount = (float)$familyPayment->discount;
    $paidAmount = (float)$familyPayment->paid_amount;

    return view('admin.fee.print-family-receipt', compact(
        'familyPayment', 'parent', 'students', 'school', 'totalDue', 'discount', 'paidAmount', 'amountInWords'
    ));
}










    
     
   
    


}
