<div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
    <div class="mobile-sidebar-header d-md-none center-logo-mobile">
        <div class="header-logo">
            <a href="{{ route('admin.dashboard') }}">
                <!--<img src="{{ asset('public/admin/twm_school_logo.png') }}" alt="logo">-->
                {{ Auth::guard('admin')->user()->name }}
            </a>
        </div>
    </div>
    <div class="sidebar-menu-content">
        <ul class="nav nav-sidebar-menu sidebar-toggle-view">

            <!-- Dashboard -->
            <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
                </a>
            </li>

            <!-- Students -->
            <li class="nav-item sidebar-nav-item {{ request()->routeIs('admin.student_list', 'admin.add_student', 'admin.student_promotion','admin.student_registration_list') ? 'active' : '' }}">
                <a href="#" class="nav-link">
                    <i class="fas fa-user-graduate"></i><span>Students</span>
                </a>
                <ul class="nav sub-group-menu">
                    <li class="nav-item">
                        <a href="{{ route('admin.student_registration_list') }}" class="nav-link {{ request()->routeIs('admin.student_registration_list') ? 'active' : '' }}">
                            <i class="fas fa-user-plus"></i>Students Registration List
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.student_list') }}" class="nav-link {{ request()->routeIs('admin.student_list') ? 'active' : '' }}">
                            <i class="fas fa-users"></i>All Students
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.add_student') }}" class="nav-link {{ request()->routeIs('admin.add_student') ? 'active' : '' }}">
                            <i class="fas fa-user-edit"></i>Admission Form
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.student_promotion') }}" class="nav-link {{ request()->routeIs('admin.student_promotion') ? 'active' : '' }}">
                            <i class="fas fa-arrow-up"></i>Student Promotion
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Teachers -->
            <li class="nav-item sidebar-nav-item {{ request()->routeIs('admin.teacher_list', 'admin.add_teacher') ? 'active' : '' }}">
                <a href="#" class="nav-link"><i class="fas fa-chalkboard-teacher"></i><span>Teachers</span></a>
                <ul class="nav sub-group-menu">
                    <li class="nav-item">
                        <a href="{{ route('admin.teacher_list') }}" class="nav-link {{ request()->routeIs('admin.teacher_list') ? 'active' : '' }}">
                            <i class="fas fa-users"></i>All Teachers
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="{{ route('admin.add_teacher') }}" class="nav-link {{ request()->routeIs('admin.add_teacher') ? 'active' : '' }}">
                            <i class="fas fa-user-plus"></i>Add Teacher
                        </a>
                    </li> -->
                </ul>
            </li>

            <!-- Parents -->
            <li class="nav-item sidebar-nav-item {{ request()->routeIs('admin.parent_list', 'admin.add_parent') ? 'active' : '' }}">
                <a href="#" class="nav-link"><i class="fas fa-user-friends"></i><span>Parents</span></a>
                <ul class="nav sub-group-menu">
                    <li class="nav-item">
                        <a href="{{ route('admin.parent_list') }}" class="nav-link {{ request()->routeIs('admin.parent_list') ? 'active' : '' }}">
                            <i class="fas fa-users"></i>All Parents
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.add_parent') }}" class="nav-link {{ request()->routeIs('admin.add_parent') ? 'active' : '' }}">
                            <i class="fas fa-user-plus"></i>Add Parent
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Fees Collection -->
            <li class="nav-item sidebar-nav-item {{ request()->routeIs('admin.fee_setting','admin.fees_type','admin.student_fees','admin.all_fees','admin.family_fee_collection') ? 'active' : '' }}">
                <a href="#" class="nav-link"><i class="fas fa-wallet"></i><span>Fees Collection</span></a>
                <ul class="nav sub-group-menu">
                    <li class="nav-item">
                        <a href="{{ route('admin.fees_type') }}" class="nav-link"><i class="fas fa-file-invoice-dollar"></i>Fees Type</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.fee_setting') }}" class="nav-link {{ request()->routeIs('admin.fee_setting') ? 'active' : '' }}">
                            <i class="fas fa-cogs"></i>Fee Setting
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.student_fees') }}" class="nav-link {{ request()->routeIs('admin.student_fees') ? 'active' : '' }}">
                            <i class="fas fa-cogs"></i>Student Fees
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.all_fees') }}" class="nav-link {{ request()->routeIs('admin.all_fees') ? 'active' : '' }}"><i class="fas fa-rupee-sign"></i>All Fees Collection</a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.family_fee_collection') }}" class="nav-link {{ request()->routeIs('admin.family_fee_collection') ? 'active' : '' }}"><i class="fas fa-rupee-sign"></i>Family Fee Collection</a>
                    </li>
                </ul>
            </li>
            
            
             <!-- Exam -->
<li class="nav-item sidebar-nav-item {{ request()->routeIs('admin.exam_schedule', 'admin.exam_classes','admin.exam_subjects','admin.exam_admin_card','admin.exam_marks', 'admin.exam_grade') ? 'active' : '' }}">
    <a href="#" class="nav-link"><i class="fas fa-file-alt"></i><span>Exam</span></a>
    <ul class="nav sub-group-menu">
        <li class="nav-item">
            <a href="{{ route('admin.exam_schedule') }}" class="nav-link {{ request()->routeIs('admin.exam_schedule') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i> Exam Schedule
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{ route('admin.exam_classes') }}" class="nav-link {{ request()->routeIs('admin.exam_classes') ? 'active' : '' }}">
                <i class="fas fa-chalkboard-teacher"></i> Exam Classes
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{ route('admin.exam_subjects') }}" class="nav-link {{ request()->routeIs('admin.exam_subjects') ? 'active' : '' }}">
                <i class="fas fa-book-open"></i> Exam Subjects
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{ route('admin.exam_admin_card') }}" class="nav-link {{ request()->routeIs('admin.exam_admin_card') ? 'active' : '' }}">
                <i class="fas fa-id-card"></i> Admit Card
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{ route('admin.exam_marks') }}" class="nav-link {{ request()->routeIs('admin.exam_marks') ? 'active' : '' }}">
                <i class="fas fa-pen"></i> Exam Marks
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{ route('admin.exam_grade') }}" class="nav-link {{ request()->routeIs('admin.exam_grade') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i> Exam Grades
            </a>
        </li>
    </ul>
</li>


            <!-- Library -->
            <li class="nav-item sidebar-nav-item {{ request()->routeIs('admin.library_book_list') ? 'active' : '' }}">
                <a href="#" class="nav-link"><i class="fas fa-book-reader"></i><span>Library</span></a>
                <ul class="nav sub-group-menu">
                    <li class="nav-item">
                        <a href="{{ route('admin.library_book_list') }}" class="nav-link {{ request()->routeIs('admin.library_book_list') ? 'active' : '' }}">
                            <i class="fas fa-book"></i>All Books
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fas fa-plus-circle"></i>Add New Book</a>
                    </li>
                </ul>
            </li>

            <!-- Account -->
            <li class="nav-item sidebar-nav-item {{ request()->routeIs('admin.all_expense') ? 'active' : '' }}">
                <a href="#" class="nav-link"><i class="fas fa-file-invoice"></i><span>Account</span></a>
                <ul class="nav sub-group-menu">
                    
                    <li class="nav-item">
                        <a href="{{ route('admin.all_expense') }}" class="nav-link {{ request()->routeIs('admin.all_expense') ? 'active' : '' }}"><i class="fas fa-coins"></i>Expenses</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="fas fa-plus"></i>Add Expenses</a>
                    </li>
                </ul>
            </li>

            <!-- Class -->
            <!--<li class="nav-item sidebar-nav-item {{ request()->routeIs('admin.all_class') ? 'active' : '' }}">-->
            <!--    <a href="#" class="nav-link"><i class="fas fa-school"></i><span>Class</span></a>-->
            <!--    <ul class="nav sub-group-menu">-->
            <!--        <li class="nav-item">-->
            <!--            <a href="{{ route('admin.all_class') }}" class="nav-link {{ request()->routeIs('admin.all_class') ? 'active' : '' }}"><i class="fas fa-list-ul"></i>All Classes</a>-->
            <!--        </li>-->
            <!--        <li class="nav-item">-->
            <!--            <a href="#" class="nav-link"><i class="fas fa-plus"></i>Add New Class</a>-->
            <!--        </li>-->
            <!--    </ul>-->
            <!--</li>-->

            <!-- Attendance -->
            <li class="nav-item {{ request()->routeIs('admin.attendence_list') ? 'active' : '' }}">
                <a href="{{ route('admin.attendence_list') }}" class="nav-link">
                    <i class="fas fa-clipboard-check"></i><span>Attendance</span>
                </a>
            </li>

           

            <!-- Master -->
            <li class="nav-item sidebar-nav-item {{ request()->routeIs('admin.class_list','admin.school_section','admin.all_subject','admin.notice_board') ? 'active' : '' }}">
                <a href="#" class="nav-link"><i class="fas fa-cogs"></i><span>Master</span></a>
                <ul class="nav sub-group-menu">
                    <li class="nav-item">
                        <a href="{{ route('admin.class_list') }}" class="nav-link {{ request()->routeIs('admin.class_list') ? 'active' : '' }}"><i class="fas fa-chalkboard"></i>Classes</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.school_section') }}" class="nav-link {{ request()->routeIs('admin.school_section') ? 'active' : '' }}"><i class="fas fa-layer-group"></i>Sections</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.all_subject') }}" class="nav-link {{ request()->routeIs('admin.all_subject') ? 'active' : '' }}"><i class="fas fa-book-open"></i>Subjects</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.notice_board') }}" class="nav-link {{ request()->routeIs('admin.notice_board') ? 'active' : '' }}"><i class="fas fa-bullhorn"></i>Notice Board</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.account_setting') }}" class="nav-link {{ request()->routeIs('admin.account_setting') ? 'active' : '' }}"><i class="fas fa-user-cog"></i>Create User</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>
