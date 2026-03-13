<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>School Software | Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="{{ asset('public/admin/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/fonts/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/style.css') }}">
    <script src="{{ asset('public/admin/js/modernizr-3.6.0.min.js') }}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        
        .dashboard-summery-one {
    padding: 20px 15px;
    border-radius: 12px;
    color: #fff;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease-in-out;
    background: linear-gradient(193deg, #08243a 0%, #104e76 80%) !important;
}
    </style>
</head>

<body>
<div id="preloader"></div>
<div id="wrapper" class="wrapper bg-ash">
    @include('admin.include.header')
    <div class="dashboard-page-one">
        @include('admin.include.sidebar');
        <div class="dashboard-content-one">
            <div class="breadcrumbs-area shadow-sm rounded p-4 mb-4"
                 style="background: linear-gradient(120deg, #2196F3, #005c85, #125370); color: #fff;">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <!-- Right Side: Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 bg-transparent" style="--bs-breadcrumb-divider: '>';">
                            <li class="breadcrumb-item"><a href="/admin/dashboard" class="text-white-50">Home</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">Admin</li>
                            @if(Auth::guard('admin')->user()->school_id==1)
                            &nbsp;&nbsp;<a href="{{ route('admin.plan_list') }}"  class="btn btn-primary btn-lg" style="font-size: 1.65rem;color: #000000;background-color: #ffffff;border-color: #007bff;">Plan Calculator</a>
                            @endif
                        </ol>
                        
                    </nav>
                    <!-- Left Side: Icon + Title -->
                    <div class="d-flex align-items-center">
                        
                        <div class="icon-circle bg-white text-primary d-flex align-items-center justify-content-center"
                             style="width: 50px; height: 50px; border-radius: 50%;">
                            <i class="fas fa-chart-line fa-lg"></i>
                        </div>
                        <div style="margin-left: 15px;">
                            
                            <h2 class="mb-1" style="font-weight: 600; font-size: 24px; color: #ffffff;">Admin Dashboard</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row gutters-20">
                
                         <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20 p-3 shadow rounded bg-white hover-shadow">
                <div class="row align-items-center">
                    <div class="col-4">
                        <div class="item-icon d-flex align-items-center justify-content-center"
                             style="background-color: rgba(0,0,0,0.05); height: 60px; width: 60px; border-radius: 50%;">
                                                            <i class="fas fa-user-plus text-green" style="font-size: 28px;"></i>
                                                    </div>
                    </div>
                    <div class="col-8">
                        <div class="item-content">
                            <div class="item-title text-dark" style="font-size: 15px; font-weight: 600;color: #ffffff !important;">
                                Today Admission
                            </div>
                            <div class="item-number" style="font-size: 25px; font-weight: 700;">
                                <span id="today_addmission" >0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20 p-3 shadow rounded bg-white hover-shadow">
                <div class="row align-items-center">
                    <div class="col-4">
                        <div class="item-icon d-flex align-items-center justify-content-center"
                             style="background-color: rgba(0,0,0,0.05); height: 60px; width: 60px; border-radius: 50%;">
                                                            <i class="fas fa-user-edit text-yellow" style="font-size: 28px;"></i>
                                                    </div>
                    </div>
                    <div class="col-8">
                        <div class="item-content">
                            <div class="item-title text-dark" style="font-size: 15px; font-weight: 600;color: #ffffff !important;">
                                Today Registration
                            </div>
                            <div class="item-number" style="font-size: 25px; font-weight: 700;">
                                <span  id="total_registration">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20 p-3 shadow rounded bg-white hover-shadow">
                <div class="row align-items-center">
                    <div class="col-4">
                        <div class="item-icon d-flex align-items-center justify-content-center"
                             style="background-color: rgba(0,0,0,0.05); height: 60px; width: 60px; border-radius: 50%;">
                                                            <i class="fas fa-wallet text-blue" style="font-size: 28px;"></i>
                                                    </div>
                    </div>
                    <div class="col-8">
                        <div class="item-content">
                            <div class="item-title text-dark" style="font-size: 15px; font-weight: 600;color: #ffffff !important;">
                                Today Fee Collection
                            </div>
                            <div class="item-number" style="font-size: 25px; font-weight: 700;">
                                <span id="total_fee_collection">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20 p-3 shadow rounded bg-white hover-shadow">
                <div class="row align-items-center">
                    <div class="col-4">
                        <div class="item-icon d-flex align-items-center justify-content-center"
                             style="background-color: rgba(0,0,0,0.05); height: 60px; width: 60px; border-radius: 50%;">
                                                            <i class="fas fa-clipboard-check text-green" style="font-size: 28px;"></i>
                                                    </div>
                    </div>
                    <div class="col-8">
                        <div class="item-content">
                            <div class="item-title text-dark" style="font-size: 15px; font-weight: 600;color: #ffffff !important;">
                                Today&#039;s Attendance
                            </div>
                            <div class="item-number" style="font-size: 25px; font-weight: 700;">
                                <span id="today_attendence">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20 p-3 shadow rounded bg-white hover-shadow">
                <div class="row align-items-center">
                    <div class="col-4">
                        <div class="item-icon d-flex align-items-center justify-content-center"
                             style="background-color: rgba(0,0,0,0.05); height: 60px; width: 60px; border-radius: 50%;">
                                                            <i class="fas fa-user-times text-red" style="font-size: 28px;"></i>
                                                    </div>
                    </div>
                    <div class="col-8">
                        <div class="item-content">
                            <div class="item-title text-dark" style="font-size: 15px; font-weight: 600;color: #ffffff !important;">
                                Today Absent
                            </div>
                            <div class="item-number" style="font-size: 25px; font-weight: 700;">
                                <span id="today_absent">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20 p-3 shadow rounded bg-white hover-shadow">
                <div class="row align-items-center">
                    <div class="col-4">
                        <div class="item-icon d-flex align-items-center justify-content-center"
                             style="background-color: rgba(0,0,0,0.05); height: 60px; width: 60px; border-radius: 50%;">
                                                            <i class="flaticon-classmates text-green" style="font-size: 28px;"></i>
                                                    </div>
                    </div>
                    <div class="col-8">
                        <div class="item-content">
                            <div class="item-title text-dark" style="font-size: 15px; font-weight: 600;color: #ffffff !important;">
                               Total Students
                            </div>
                            <div class="item-number" style="font-size: 25px; font-weight: 700;">
                                <span id="total_students">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20 p-3 shadow rounded bg-white hover-shadow">
                <div class="row align-items-center">
                    <div class="col-4">
                        <div class="item-icon d-flex align-items-center justify-content-center"
                             style="background-color: rgba(0,0,0,0.05); height: 60px; width: 60px; border-radius: 50%;">
                                                            <i class="flaticon-multiple-users-silhouette text-blue" style="font-size: 28px;"></i>
                                                    </div>
                    </div>
                    <div class="col-8">
                        <div class="item-content">
                            <div class="item-title text-dark" style="font-size: 15px; font-weight: 600;color: #ffffff !important;">
                                Teachers
                            </div>
                            <div class="item-number" style="font-size: 25px; font-weight: 700;">
                                <span id="teachers">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20 p-3 shadow rounded bg-white hover-shadow">
                <div class="row align-items-center">
                    <div class="col-4">
                        <div class="item-icon d-flex align-items-center justify-content-center"
                             style="background-color: rgba(0,0,0,0.05); height: 60px; width: 60px; border-radius: 50%;">
                                                            <i class="flaticon-couple text-orange" style="font-size: 28px;"></i>
                                                    </div>
                    </div>
                    <div class="col-8">
                        <div class="item-content">
                            <div class="item-title text-dark" style="font-size: 15px; font-weight: 600;color: #ffffff !important;">
                                Parents
                            </div>
                            <div class="item-number" style="font-size: 25px; font-weight: 700;">
                                <span id="parents">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20 p-3 shadow rounded bg-white hover-shadow">
                <div class="row align-items-center">
                    <div class="col-4">
                        <div class="item-icon d-flex align-items-center justify-content-center"
                             style="background-color: rgba(0,0,0,0.05); height: 60px; width: 60px; border-radius: 50%;">
                                                            <i class="flaticon-open-book text-purple" style="font-size: 28px;"></i>
                                                    </div>
                    </div>
                    <div class="col-8">
                        <div class="item-content">
                            <div class="item-title text-dark" style="font-size: 15px; font-weight: 600;color: #ffffff !important;">
                                Total Classes
                            </div>
                            <div class="item-number" style="font-size: 25px; font-weight: 700;">
                                <span id="total_classes"></span>0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20 p-3 shadow rounded bg-white hover-shadow">
                <div class="row align-items-center">
                    <div class="col-4">
                        <div class="item-icon d-flex align-items-center justify-content-center"
                             style="background-color: rgba(0,0,0,0.05); height: 60px; width: 60px; border-radius: 50%;">
                                                            <i class="fas fa-book-open text-cyan" style="font-size: 28px;"></i>
                                                    </div>
                    </div>
                    <div class="col-8">
                        <div class="item-content">
                            <div class="item-title text-dark" style="font-size: 15px; font-weight: 600;color: #ffffff !important;">
                                Total Subjects
                            </div>
                            <div class="item-number" style="font-size: 25px; font-weight: 700;">
                                <span id="total_subjects"></span>0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20 p-3 shadow rounded bg-white hover-shadow">
                <div class="row align-items-center">
                    <div class="col-4">
                        <div class="item-icon d-flex align-items-center justify-content-center"
                             style="background-color: rgba(0,0,0,0.05); height: 60px; width: 60px; border-radius: 50%;">
                                                            <i class="fas fa-book text-purple" style="font-size: 28px;"></i>
                                                    </div>
                    </div>
                    <div class="col-8">
                        <div class="item-content">
                            <div class="item-title text-dark" style="font-size: 15px; font-weight: 600;color: #ffffff !important;">
                                Books Issued Today
                            </div>
                            <div class="item-number" style="font-size: 25px; font-weight: 700;">
                                <span id="book_issue">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20 p-3 shadow rounded bg-white hover-shadow">
                <div class="row align-items-center">
                    <div class="col-4">
                        <div class="item-icon d-flex align-items-center justify-content-center"
                             style="background-color: rgba(0,0,0,0.05); height: 60px; width: 60px; border-radius: 50%;">
                                                            <i class="fas fa-file-alt text-blue" style="font-size: 28px;"></i>
                                                    </div>
                    </div>
                    <div class="col-8">
                        <div class="item-content">
                            <div class="item-title text-dark" style="font-size: 15px; font-weight: 600;color: #ffffff !important;">
                                Upcoming Exams
                            </div>
                            <div class="item-number" style="font-size: 25px; font-weight: 700;">
                                <span id="upcoming_exam">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                </div>

            @include('admin.include.footer');
        </div>
    </div>
</div>

<style>
        
        .text-purple{
            color: #ffffff !important;
        }
    </style>

<script src="{{ asset('public/admin/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('public/admin/js/plugins.js') }}"></script>
<script src="{{ asset('public/admin/js/popper.min.js') }}"></script>
<script src="{{ asset('public/admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/admin/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('public/admin/js/moment.min.js') }}"></script>
<script src="{{ asset('public/admin/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('public/admin/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('public/admin/js/fullcalendar.min.js') }}"></script>
<script src="{{ asset('public/admin/js/Chart.min.js') }}"></script>
<script src="{{ asset('public/admin/js/main.js') }}"></script>
<script>
    $(function () {
        getStudentDashboardData();
    });

    function getStudentDashboardData() {
        $.ajax({
            url: "{{ route('admin.get_student_dashboard_data') }}",
            type: "GET",
            processData: false,
            contentType: false,
            beforeSend: function () {
                $('#load').show();
            },
            success: function (result) {
                // 👇 FIXED: result used instead of undefined response
                $('#today_addmission').html(result.today_addmission);
                $('#total_students').html(result.total_students);
                $('#total_registration').html(result.total_reg);
            },
            complete: function () {
                $("#load").hide();
            },
            error: function (jqXHR, exception) {
                console.log(jqXHR.responseText);
            }
        });
    }
</script>

</body>
</html>