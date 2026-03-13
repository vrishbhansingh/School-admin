<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Middleware\VerifyCsrfToken;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\ParentController;
use App\Http\Controllers\Admin\LibraryController;
use App\Http\Controllers\Admin\Attendence;
use App\Http\Controllers\Admin\Exam;
use App\Http\Controllers\Admin\Account;
use App\Http\Controllers\Admin\StudentClass;
use App\Http\Controllers\Admin\Master;
use App\Http\Controllers\Admin\FeeController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login-submit', [AuthController::class, 'login'])->name('go_login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {
        
        //Student dashboard information
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/get_student_dashboard_data', [DashboardController::class, 'get_student_dashboard_data'])->name('get_student_dashboard_data');
    
    Route::get('/plan-list', [Account::class, 'plan_list'])->name('plan_list');
    Route::post('getData' , [Account::class , 'getData'])->name('admin.getData');
Route::get('getExport/{totalMembers}/{totalLevels}' , [Account::class , 'exportUserPlanExcel'])->name('admin.getExport');
Route::get('/export-user-plan-pdf', [Account::class, 'exportUserPlanPDF']);




    Route::get('/account-security', [Account::class, 'account_security'])->name('account_security');
    Route::post('/change_account_security', [Account::class, 'change_account_security'])->name('change_account_security');
    
    Route::get('/student-registration', [StudentController::class, 'student_registration'])->name('student_registration');
    Route::get('/student-registration-list', [StudentController::class, 'student_registration_list'])->name('student_registration_list');
    Route::get('/student-registration-view/{id}', [StudentController::class, 'student_registration_view'])->name('student_registration_view');
    Route::post('/get_student_registration_list', [StudentController::class, 'get_student_registration_list'])->name('get_student_registration_list');
    Route::get('/print-student-registration/{id}', [StudentController::class, 'print_student_registration'])->name('print_student_registration');
    
    Route::post('/register_student', [StudentController::class, 'register_student'])->name('register_student');
    Route::get('/student-list', [StudentController::class, 'student_list'])->name('student_list');
    Route::post('/change_student_status', [StudentController::class, 'change_student_status'])->name('change_student_status');
    Route::get('/student-details/{id}', [StudentController::class, 'student_details'])->name('student_details');
    Route::get('/edit-student-details/{id}', [StudentController::class, 'edit_student_details'])->name('edit_student_details');
    Route::get('/print-student-id-card/{id}', [StudentController::class, 'print_student_id_card'])->name('print_student_id_card');
    Route::get('/print-admit-card/{id}', [StudentController::class, 'print_admit_card'])->name('print_admit_card');
    
    Route::get('/add-student', [StudentController::class, 'add_student'])->name('add_student');
    Route::post('/student_addmission', [StudentController::class, 'student_addmission'])->name('student_addmission');
    Route::post('/update_student_addmission', [StudentController::class, 'update_student_addmission'])->name('update_student_addmission');
    Route::get('/student-promotion', [StudentController::class, 'student_promotion'])->name('student_promotion');
    Route::post('/get_student_addmission_list', [StudentController::class, 'get_student_addmission_list'])->name('get_student_addmission_list');
    Route::post('/get_section_data', [StudentController::class, 'get_section_data'])->name('get_section_data');
    Route::post('/promote_new_class_student', [StudentController::class, 'promote_new_class_student'])->name('promote_new_class_student');
    Route::get('/student-promotion-list', [StudentController::class, 'student_promotion_list'])->name('student_promotion_list'); 
    Route::post('/get_student_promotion_list', [StudentController::class, 'get_student_promotion_list'])->name('get_student_promotion_list');
    Route::post('/bulk_upload_students', [StudentController::class, 'bulkUploadDirect'])->name('bulk_upload_students');
    
    
    
    Route::get('/teacher-list', [TeacherController::class, 'teacher_list'])->name('teacher_list');
    Route::get('/teacher-details', [TeacherController::class, 'teacher_details'])->name('teacher_details');
    Route::get('/add-teacher', [TeacherController::class, 'add_teacher'])->name('add_teacher');
    Route::get('/teacher-payments', [TeacherController::class, 'teacher_payments'])->name('teacher_payments');
    
    Route::get('/parent-list', [ParentController::class, 'parent_list'])->name('parent_list');
    Route::get('/parent-details', [ParentController::class, 'parent_details'])->name('parent_details');
    Route::get('/add-parent', [ParentController::class, 'add_parent'])->name('add_parent');
    
    
    Route::get('/library-book-list', [LibraryController::class, 'library_book_list'])->name('library_book_list');
    Route::get('/add-library-book', [LibraryController::class, 'add_library_book'])->name('add_library_book');
    
    Route::get('/all-subject', [LibraryController::class, 'all_subject'])->name('all_subject');
    Route::post('/get_subject', [LibraryController::class, 'get_subject'])->name('get_subject');
    Route::post('/save-subject', [LibraryController::class, 'save_subject'])->name('save_subject');
    Route::post('/delete_subject', [LibraryController::class, 'delete_subject'])->name('delete_subject');
    
    
    Route::get('/attendence', [Attendence::class, 'student_attendence'])->name('attendence_list');
    
    // Exam Routes Created By Rajan
    Route::get('/exam-schedule', [Exam::class, 'exam_schedule'])->name('exam_schedule');
    Route::post('/get_exam', [Exam::class, 'get_exam'])->name('get_exam');
    Route::post('/save-exam', [Exam::class, 'save_exam'])->name('save_exam');
    Route::post('/update-exam', [Exam::class, 'update_exam'])->name('update_exam');
    Route::post('/delete_exam', [Exam::class, 'delete_exam'])->name('delete_exam');
    Route::get('/exam-grade', [Exam::class, 'exam_grade'])->name('exam_grade');
    
    Route::get('/exam-classes', [Exam::class, 'exam_classes'])->name('exam_classes');
    Route::post('/get_exam_classes', [Exam::class, 'get_exam_classes'])->name('get_exam_classes');
    Route::post('/save-exam-class', [Exam::class, 'save_exam_class'])->name('save_exam_class');
    Route::post('/update-exam-class', [Exam::class, 'update_exam_class'])->name('update_exam_class');
    Route::post('/delete_exam_classes', [Exam::class, 'delete_exam_classes'])->name('delete_exam_classes');
    
    
    Route::post('/get_classe_data', [Exam::class, 'get_classe_data'])->name('get_classe_data');
    Route::get('/exam-subjects', [Exam::class, 'exam_subjects'])->name('exam_subjects');
    Route::post('/get_exam_subjects', [Exam::class, 'get_exam_subjects'])->name('get_exam_subjects');
    Route::post('/save-exam-subject', [Exam::class, 'save_exam_subject'])->name('save_exam_subject');
    Route::post('/delete_exam_subject', [Exam::class, 'delete_exam_subject'])->name('delete_exam_subject');
    Route::post('/update-exam-subject', [Exam::class, 'update_exam_subject'])->name('update_exam_subject');
    Route::get('/exam_admin_card', [Exam::class, 'exam_admin_card'])->name('exam_admin_card');
    Route::post('/get_exam_admin_card', [Exam::class, 'get_exam_admin_card'])->name('get_exam_admin_card');
    Route::post('/generate-admit-card', [Exam::class, 'generate_admit_card'])->name('generate_admit_card');
    Route::get('/exam-marks', [Exam::class, 'exam_marks'])->name('exam_marks');
    Route::post('/get_exam_marks', [Exam::class, 'get_exam_marks'])->name('get_exam_marks');
    Route::post('/get_student_data', [Exam::class, 'get_student_data'])->name('get_student_data');
    Route::post('/get_student_subjects', [Exam::class, 'get_student_subjects'])->name('get_student_subjects');
    Route::post('/save-exam-marks', [Exam::class, 'save_exam_marks'])->name('save_exam_marks');
    
    
    Route::get('/all-expense', [Account::class, 'all_expense'])->name('all_expense');
    Route::get('/add-expense', [Account::class, 'add_expense'])->name('add_expense');
    
    Route::get('/account-settings', [Account::class, 'account_setting'])->name('account_setting');
    Route::get('/notice-board', [Account::class, 'notice_board'])->name('notice_board');
    
    Route::get('/all-class', [StudentClass::class, 'all_class'])->name('all_class');
    Route::get('/add-class', [StudentClass::class, 'add_class'])->name('add_class');
    Route::get('/class-routine', [StudentClass::class, 'class_routine'])->name('class_routine');
    Route::get('/transport', [StudentClass::class, 'transport'])->name('transport');
    
    
    Route::get('/class-list', [Master::class, 'class_list'])->name('class_list');
    Route::post('/get_class', [Master::class, 'get_class'])->name('get_class');
    Route::post('/save-class', [Master::class, 'save_class'])->name('save_class');
    Route::post('/delete_class', [Master::class, 'delete_class'])->name('delete_class');
    
    Route::get('/school-section', [Master::class, 'school_section'])->name('school_section');
    Route::post('/get_section', [Master::class, 'get_section'])->name('get_section');
    Route::post('/save-section', [Master::class, 'save_section'])->name('save_section');
    Route::post('/delete_section', [Master::class, 'delete_section'])->name('delete_section');
    
    
    Route::get('/fees-type', [FeeController::class, 'fees_type'])->name('fees_type');
    Route::post('/get_fees_type', [FeeController::class, 'get_fees_type'])->name('get_fees_type');
    Route::post('/save_fee_type', [FeeController::class, 'save_fee_type'])->name('save_fee_type');
    Route::post('/delete_fee_type', [FeeController::class, 'delete_fee_type'])->name('delete_fee_type');
    
    Route::get('/fee-setting', [FeeController::class, 'fee_setting'])->name('fee_setting');
    Route::post('/get_fee_setting', [FeeController::class, 'get_fee_setting'])->name('get_fee_setting');
    Route::post('/save_fee_setting', [FeeController::class, 'save_fee_setting'])->name('save_fee_setting');
    Route::post('/delete_fee_setting', [FeeController::class, 'delete_fee_setting'])->name('delete_fee_setting');
    
    Route::get('/family-fee-collection', [FeeController::class, 'family_fee_collection'])->name('family_fee_collection');
    Route::post('/search-parent-due', [FeeController::class, 'search_parent_due'])->name('search_parent_due');
    Route::post('/family-fee-payment', [FeeController::class, 'family_fee_payment'])->name('family_fee_payment');
    
    Route::get('/student-fees', [FeeController::class, 'student_fees'])->name('student_fees');
    Route::post('/add_student_fee', [FeeController::class, 'add_student_fee'])->name('add_student_fee');
    Route::post('/get_student_fee_list', [FeeController::class, 'get_student_fee_list'])->name('get_student_fee_list');
    Route::post('/delete_student_fee', [FeeController::class, 'delete_student_fee'])->name('delete_student_fee');
    Route::post('/get_fee_type_data', [FeeController::class, 'get_fee_type_data'])->name('get_fee_type_data');
    
    Route::get('/all-fees', [FeeController::class, 'all_fees'])->name('all_fees');
    Route::post('/get_student_payment_list', [FeeController::class, 'get_student_payment_list'])->name('get_student_payment_list');
    Route::post('/get_student_due_amount', [FeeController::class, 'get_student_due_amount'])->name('get_student_due_amount');
    Route::post('/get_student_fee_data', [FeeController::class, 'get_student_fee_data'])->name('get_student_fee_data');
    Route::post('/add_student_payment', [FeeController::class, 'add_student_payment'])->name('add_student_payment');
    
    Route::post('/get_student_fee_month', [FeeController::class, 'get_student_fee_month'])->name('get_student_fee_month');
    
    Route::post('/save_parent', [ParentController::class, 'save_parent'])->name('save_parent');
    Route::post('/get_parent_list', [ParentController::class, 'get_parent_list'])->name('get_parent_list');
    
    Route::get('/print-receipt/{id}', [FeeController::class, 'generateReceipt'])->name('print_receipt');
    
    Route::get('/print-family-receipt/{id}', [FeeController::class, 'print_family_receipt'])->name('print_family_receipt');
    
     });
});

// Normal user login route (agar zarurat ho)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');