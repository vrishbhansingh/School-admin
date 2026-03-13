<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Students Details - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/twm_fav.png') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('public/admin/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/css/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/fonts/flaticon.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/css/fullcalendar.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/css/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/css/print.css') }}" media="print">

    <style>
        .status-toggle {
            background-color: #ffffff;
            color: #333;
            border: 2px solid #5a4db2;
            padding: 7px 12px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            appearance: none;
        }

        .status-toggle:hover {
            background-color: #f7f7f7;
            border-color: #402ea0;
        }

        .self_data {
            color: #ffffff;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f0f0f0;
        }

        #profile-card {
            display: flex;
            flex-wrap: wrap;
            max-width: 1000px;
            margin: 0 auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        #print-btn {
            background-color: #5a4db2;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        #print-btn:hover {
            background-color: #402ea0;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        }

        #print-btn i {
            font-size: 16px;
        }

        .left-section {
            flex: 0 0 260px;
            background: linear-gradient(160deg, #FF9800, #00BCD4);
            color: #fff;
            padding: 35px 20px;
            text-align: center;
        }

        .profile-photo {
            width: 140px;
            height: 140px;
            margin: 0 auto 15px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid #fff;
        }

        .profile-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .left-section h2 {
            font-size: 24px;
            margin: 10px 0 5px;
        }

        .left-section p {
            margin: 4px 0;
            font-size: 13px;
        }

        .right-section {
            flex: 1;
            padding: 35px 40px;
        }

        .section {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            border-left: 4px solid #5a4db2;
            padding-left: 10px;
            margin-bottom: 15px;
        }

        .row-line {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .row-item {
            flex: 1;
            min-width: 160px;
            background: #f9f9f9;
            padding: 6px 23px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .row-item strong {
            display: block;
            font-size: 13px;
            color: #5a4db2;
            margin-bottom: 4px;
        }

        .row-item span {
            font-size: 14px;
            color: #222;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #print-area, #print-area * {
                visibility: visible !important;
            }

            #print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 0;
                box-shadow: none !important;
            }

            #print-btn {
                display: none !important;
            }

            .row-item {
                page-break-inside: avoid;
            }
        }
        
        
        /* ==== Action Bar ==== */
.action-bar {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin: 0 auto 20px auto;
    max-width: 1000px;
    padding: 10px 15px;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 14px rgba(0,0,0,0.05);
    flex-wrap: wrap;
}

/* Universal Button Style */
.btn-action {
    padding: 6px 14px;
    font-size: 13px;
    font-weight: 500;
    border-radius: 6px;
    display: flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
    color: #fff;
    transition: all 0.3s ease;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

/* Edit Button */
.btn-action.edit {
    background: #28a745;
}
.btn-action.edit:hover {
    background: #1e7e34;
}

/* ID Card Button */
.btn-action.id-card {
    background: #5a4db2;
}
.btn-action.id-card:hover {
    background: #402ea0;
}

/* Admit Card Button */
.btn-action.admit-card {
    background: #ff5722;
}
.btn-action.admit-card:hover {
    background: #e64a19;
}

/* Status Dropdown */
.status-toggle {
    padding: 6px 10px;
    font-size: 13px;
    border-radius: 6px;
    border: 2px solid #5a4db2;
    background: #fff;
    color: #333;
    cursor: pointer;
    transition: all 0.3s;
}
.status-toggle:hover {
    background: #f7f7f7;
    border-color: #402ea0;
}

    </style>
</head>

<body>
    <div id="preloader"></div>

    <div id="wrapper" class="wrapper bg-ash">
        @include('admin.include.header')

        <div class="dashboard-page-one">
            @include('admin.include.sidebar')

            <div class="dashboard-content-one">
                <div class="breadcrumbs-area">
                    <h3>Students</h3>
                    <ul>
                        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li>Student Details</li>
                    </ul>
                </div>

                <!-- Success Message -->
                @if(session('success'))
                <div style="margin: 20px auto; max-width: 1000px; padding: 10px 20px; background-color: #d4edda; color: #155724; border-radius: 8px;">
                    {{ session('success') }}
                </div>
                @endif

                <!-- Profile Card -->
                <div id="print-area">
                    
                    
                                    <!-- ==== Action Bar ==== -->
                <div class="action-bar">
                    <a href="{{ route('admin.edit_student_details', base64_encode($student->id)) }}" class="btn-action edit">
                        <i class="fas fa-edit"></i> Edit Record
                    </a>
                    <select id="change_status" data-id="{{ $student->id }}" class="status-toggle">
                        <option value="ACTIVE" {{ $student->status == 'ACTIVE' ? 'selected' : '' }}>🟢 Enabled</option>
                        <option value="INACTIVE" {{ $student->status == 'INACTIVE' ? 'selected' : '' }}>🔴 Disabled</option>
                    </select>
                    <a href="{{ route('admin.print_student_id_card',[base64_encode($student->id)]) }}" class="btn-action id-card">
                        <i class="fas fa-id-card"></i> ID Card
                    </a>
                    @if($exam > 0)
                    <a href="{{ route('admin.print_admit_card',[base64_encode($student->id)]) }}" class="btn-action admit-card">
                        <i class="fas fa-user-shield"></i> Admit Card
                    </a>
                    @endif
                </div>
                    
                    
                    <div id="profile-card">

                        <div class="left-section">
                            <div class="profile-photo">
                                <img src="{{ asset('public/admin/student/' . $student->photo) }}" alt="{{ $student->name }}">
                            </div>

                            <h2 class="self_data">{{ $student->name }}</h2>
                            <p class="self_data">{{ $student->email }}</p>
                            <p class="self_data">+91-{{ $student->phone }}</p>
                            <p class="self_data">Roll No: <strong>{{ $student->roll_no }}</strong></p>
                            <p class="self_data">Admission No: <strong>{{ $student->addmission_no }}</strong></p>
                        </div>

                        <div class="right-section">
                            <div class="section">
                                <div class="section-title">Personal Information</div>
                                <div class="row-line">
                                    <div class="row-item"><strong>Gender</strong><span>{{ $student->gender }}</span></div>
                                    <div class="row-item"><strong>DOB</strong><span>{{ date('d M, Y', strtotime($student->dob)) }}</span></div>
                                    <div class="row-item"><strong>Religion</strong><span>{{ $student->religion }}</span></div>
                                    <div class="row-item"><strong>Blood Group</strong><span>{{ $student->blood_group }}</span></div>
                                </div>
                            </div>

                            <div class="section">
                                <div class="section-title">Guardian Details</div>
                                <div class="row-line">
                                    <div class="row-item"><strong>Father's Name</strong><span>{{ $student->father_name }}</span></div>
                                    <div class="row-item"><strong>Mother's Name</strong><span>{{ $student->mother_name }}</span></div>
                                    <div class="row-item"><strong>Father's Phone</strong><span>{{ $student->father_phone }}</span></div>
                                </div>
                            </div>

                            <div class="section">
                                <div class="section-title">Contact Information</div>
                                <div class="row-line">
                                    <div class="row-item"><strong>Email</strong><span>{{ $student->email }}</span></div>
                                    <div class="row-item"><strong>Phone</strong><span>+91-{{ $student->phone }}</span></div>
                                    <div class="row-item"><strong>Address</strong><span>{{ $student->address }}</span></div>
                                </div>
                            </div>

                            <div class="section">
                                <div class="section-title">Academic Information</div>
                                <div class="row-line">
                                    <div class="row-item"><strong>Admission Date</strong><span>{{ date('d M, Y', strtotime($student->addmission_date)) }}</span></div>
                                    <div class="row-item"><strong>Session</strong><span>{{ $session->session }}</span></div>
                                    <div class="row-item"><strong>Class</strong><span>{{ $class->name }}</span></div>
                                    <div class="row-item"><strong>Section</strong><span>{{ $section->name }}</span></div>
                                    <div class="row-item"><strong>Aadhar No</strong><span>{{ $student->aadhar_number }}</span></div>
                                    <div class="row-item"><strong>Religion</strong><span>{{ $student->religion }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('admin.include.footer')
            </div>
        </div>
    </div>

    <script src="{{ asset('public/admin/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('public/admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/admin/js/select2.min.js') }}"></script>
<script src="{{ asset('public/admin/js/main.js') }}"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        window.addEventListener('load', function () {
            document.getElementById('preloader').style.display = 'none';
        });
        
        
        $('#change_status').on('change', function(){
            
            var student_id = $(this).data('id');
            var status = $(this).val();
            
            $.ajax({
                url: "{{ route('admin.change_student_status') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    student_id: student_id,
                    status: status
                },
                success: function (response) {
                    if (response.status) {
                        toastr.success(response.msg);
                        
                        window.location.href="https://techwebmantra.com/school/admin/student-list";
                    } else {
                        toastr.error(response.msg);
                    }
                },
                error: function () {
                    toastr.error('Something went wrong!');
                }
            });
        });
    </script>
</body>

</html>
