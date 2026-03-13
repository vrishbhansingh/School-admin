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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function index()
    {
        // Example: You can pass data to the view if needed
        $totalStudents = 1200;
        $totalTeachers = 50;
        if (view()->exists('admin.dashboard')) {
            return view('admin.dashboard', compact('totalStudents', 'totalTeachers'));
        }
            return redirect('/admin/login');
            }
        
        

            

                    public function get_student_dashboard_data(Request $request)
                    {
                        date_default_timezone_set('Asia/Kolkata');
                        $schoolId = Auth::guard('admin')->user()->school_id;
                    
                        $totReg = StudentRegistration::where('school_id', $schoolId)->whereRaw("DATE(reg_date) = ?", [date('Y-m-d')])->count();
                        $totStudents = StudentAddmission::where('school_id', $schoolId)->count();
                    
                        $todayAddmission = StudentAddmission::where('school_id', $schoolId)
                            ->whereRaw("DATE(addmission_date) = ?", [date('Y-m-d')])
                            ->count();
                          
                    
                        return response()->json([
                            'total_reg' => $totReg,
                            'total_students' => $totStudents,
                            'today_addmission' => $todayAddmission,
                        ]);
                    }



         
        }