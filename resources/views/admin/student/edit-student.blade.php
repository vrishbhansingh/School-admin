<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Update Student - Tech Web Mantra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/twm_fav.png') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('public/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/fonts/flaticon.css') }}">
    
    <link rel="stylesheet" href="{{ asset('public/admin/css/animate.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('public/admin/css/select2.min.css') }}">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="{{ asset('public/admin/css/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <!-- Preloader CSS -->
    <style>
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: #fff;
        }

        #preloader::after {
            content: "";
            display: block;
            width: 60px;
            height: 60px;
            margin: 20% auto;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #f44336;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>

    <script src="{{ asset('public/admin/js/modernizr-3.6.0.min.js') }}"></script>
</head>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
        <!-- Header Menu Area Start Here -->
        @include('admin.include.header')
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            @include('admin.include.sidebar')
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Update Student</h3>
                    <ul>
                        <li>
                            <a href="{{ route('admin.dashboard') }}">Home</a>
                        </li>
                        <li>Update Student Admit Form</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Admit Form Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            
                            
                        </div>
                        <form class="new-added-form" method="POST" id="update_student_addmission" enctype="multipart/form-data">
                            @csrf
          <div class="row">
              <input type="hidden" name="id" value="{{ $student->id }}">
        <!-- Personal Information -->
        <div class="col-12">
            <h5 class="mb-3 mt-4">Personal Information</h5>
        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>Name *</label>
            <input type="text" name="name" placeholder="Enter Name" class="form-control" value="{{ $student->name }}">
        </div>

        

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>Admission ID</label>
            <input type="text" name="addmission_no" placeholder="Admission ID" value="{{ $student->addmission_no }}" class="form-control" readonly>
            <input type="hidden" name="s_no" placeholder="SN" value="{{ $student->sn }}" class="form-control" readonly>
        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>Roll No</label>
            <input type="text" name="roll_no" placeholder="Roll No." value="{{ $student->roll_no }}" class="form-control">
        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>Gender *</label>
            <select class="select2" name="gender">
            <option value="" @if($student->gender == '') selected @endif>Please Select Gender *</option>
            <option value="Male" @if($student->gender == 'Male') selected @endif>Male</option>
            <option value="Female" @if($student->gender == 'Female') selected @endif>Female</option>
            <option value="Others" @if($student->gender == 'Others') selected @endif>Others</option>
        </select>

        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>Date Of Birth *</label>
            <input type="text" name="dob" placeholder="dd/mm/yyyy" class="form-control air-datepicker" value="{{ $student->dob }}" data-position='bottom right'>
            <i class="far fa-calendar-alt"></i>
        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>Nationality</label>
            <input type="text" placeholder="Nationality" name="nationality" value="{{ $student->nationality }}" class="form-control">
        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>Blood Group *</label>
            <select class="select2" name="blood_group">
            <option value="" @if($student->blood_group == '') selected @endif>Please Select Group *</option>
            <option value="A+" @if($student->blood_group == 'A+') selected @endif>A+</option>
            <option value="A-" @if($student->blood_group == 'A-') selected @endif>A-</option>
            <option value="B+" @if($student->blood_group == 'B+') selected @endif>B+</option>
            <option value="B-" @if($student->blood_group == 'B-') selected @endif>B-</option>
            <option value="O+" @if($student->blood_group == 'O+') selected @endif>O+</option>
            <option value="O-" @if($student->blood_group == 'O-') selected @endif>O-</option>
            <option value="AB+" @if($student->blood_group == 'AB+') selected @endif>AB+</option>
            <option value="AB-" @if($student->blood_group == 'AB-') selected @endif>AB-</option>
        </select>

        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>Religion *</label>
            <select class="select2" name="religion">
            <option value="" @if($student->religion == '') selected @endif>Please Select Religion *</option>
            <option value="Islam" @if($student->religion == 'Islam') selected @endif>Islam</option>
            <option value="Hindu" @if($student->religion == 'Hindu') selected @endif>Hindu</option>
            <option value="Christian" @if($student->religion == 'Christian') selected @endif>Christian</option>
            <option value="Buddhist" @if($student->religion == 'Buddhist') selected @endif>Buddhist</option>
            <option value="Others" @if($student->religion == 'Others') selected @endif>Others</option>
        </select>

        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>Category</label>
            <select class="select2" name="category">
            <option value="" @if($student->category == '') selected @endif>Select Category</option>
            <option value="General" @if($student->category == 'General') selected @endif>General</option>
            <option value="OBC" @if($student->category == 'OBC') selected @endif>OBC</option>
            <option value="SC" @if($student->category == 'SC') selected @endif>SC</option>
            <option value="ST" @if($student->category == 'ST') selected @endif>ST</option>
            <option value="Others" @if($student->category == 'Others') selected @endif>Others</option>
        </select>

        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>Aadhar Number</label>
            <input type="text" name="aadhar_number" placeholder="Aadhar Number" value="{{ $student->aadhar_number }}" class="form-control">
        </div>

        <!-- Contact & Address -->
        <div class="col-12">
            <h5 class="mb-3 mt-4">Contact & Address</h5>
        </div>

        <div class="col-xl-6 col-12 form-group">
            <label>Current Address</label>
            <textarea class="form-control" name="address" rows="2" placeholder="Enter Current Address">{{ $student->address }}</textarea>
        </div>

        <div class="col-xl-6 col-12 form-group">
            <label>Permanent Address</label>
            <textarea class="form-control" name="permanent_address" rows="2" placeholder="Enter Permanent Address">{{ $student->permanent_address }}</textarea>
        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>City</label>
            <input type="text" name="city" class="form-control" placeholder="City" value="{{ $student->city }}">
        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>State</label>
            <input type="text" name="state" class="form-control" placeholder="State" value="{{ $student->state }}">
        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>PIN Code</label>
            <input type="text" name="pincode" class="form-control" placeholder="PIN/ZIP Code" value="{{ $student->pincode }}">
        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>Phone</label>
            <input type="text" name="phone" placeholder="Phone" class="form-control" value="{{ $student->phone }}">
        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>E-Mail</label>
            <input type="email" name="email" placeholder="E-Mail" class="form-control" value="{{ $student->email }}">
        </div>

        <!-- Parent / Guardian Information -->
        <div class="col-12">
            <h5 class="mb-3 mt-4">Parent / Guardian Details</h5>
        </div>

          <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>Select Parent Mobile</label>
            <select name="parent_id" class="select2" required>
                <option>Select Parent Mobile</option>
                @foreach($parent as $pr)
                <option value="{{ $pr->id }}" @if($student->parent_id==$pr->id) selected @endif>{{ $pr->phone }}-({{ $pr->name }})</option>
                @endforeach
            </select>
        </div>
        
        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>Father's Name</label>
            <input type="text" name="father_name" class="form-control" placeholder="Father's Name" value="{{ $student->father_name }}">
        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>Father's Phone</label>
            <input type="text" name="father_phone" class="form-control" placeholder="Father's Phone" value="{{ $student->father_phone }}">
        </div>

        

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>Mother's Name</label>
            <input type="text" name="mother_name" class="form-control" placeholder="Mother's Name" value="{{ $student->mother_name }}">
        </div>

       

        <!-- Academic Info -->
        <div class="col-12">
            <h5 class="mb-3 mt-4">Academic Information</h5>
        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>Class *</label>
            <select class="select2" name="class_id" id="class_id">
                <option value="">Please Select Class *</option>
                @foreach($Sclass as $scl)
                <option value="{{ $scl->id }}" @if($student->class_id== $scl->id) selected @endif>{{ $scl->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>Section *</label>
            <select class="select2" name="section_id" id="section_id">
                <option value="">Please Select Section *</option>
                @foreach($Ssection as $sec)
                <option value="{{ $sec->id }}" @if($student->section_id== $sec->id) selected @endif>{{ $sec->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>Previous School Name</label>
            <input type="text" name="previous_school" class="form-control" value="{{ $student->previous_school }}" placeholder="Previous School Name">
        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>Last Class Attended</label>
            <input type="text" name="last_class_attended" class="form-control" value="{{ $student->last_class_attended }}" placeholder="Last Class Attended">
        </div>

        <!-- Medical Info -->
        <div class="col-12">
            <h5 class="mb-3 mt-4">Emergency Info</h5>
        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>Emergency Contact Name</label>
            <input type="text" name="emergency_contact_name" class="form-control" value="{{ $student->emergency_contact_name }}" placeholder="Contact Name">
        </div>

        <div class="col-xl-3 col-lg-6 col-12 form-group">
            <label>Emergency Contact Number</label>
            <input type="text" name="emergency_contact_number" class="form-control" value="{{ $student->emergency_contact_number }}" placeholder="Contact Number">
        </div>

        <!-- Uploads -->
        <div class="col-lg-6 col-12 form-group mg-t-30">
            <label class="text-dark-medium">Upload Student Photo (150px X 150px)</label>
            <input type="file" name="photo" class="form-control-file">
        </div>

        <div class="col-lg-6 col-12 form-group mg-t-30">
            <label class="text-dark-medium">Upload Transfer Certificate</label>
            <input type="file" name="transfer_certificate" class="form-control-file">
        </div>

        <!-- Buttons -->
        <div class="col-12 form-group mg-t-8">
                              <button type="submit" id="submit-button" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">
                                        <span id="btn-text">Update Student</span>
                                        <span id="btn-spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    </button>

            
        </div>
    </div>
</form>

                    </div>
                </div>
                <!-- Admit Form Area End Here -->
                @include('admin.include.footer')
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
    <!-- jquery-->
    <script src="{{ asset('public/admin/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/plugins.js') }}"></script>
    <script src="{{ asset('public/admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Preloader Hide Script -->
    <script>
        window.addEventListener('load', function () {
            document.getElementById('preloader').style.display = 'none';
        });
    </script>
    
    <script>
        $(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#update_student_addmission').on('submit', function (e) {
        e.preventDefault();

        let fd = new FormData(this);

        $.ajax({
            url: "{{ route('admin.update_student_addmission') }}",
            type: "POST",
            data: fd,
            dataType: 'json',
            processData: false,
            contentType: false,

            beforeSend: function () {
                // Hide button and show spinner
                 $('#submit-button').prop('disabled', true);
            $('#btn-text').text('Saving...');
            $('#btn-spinner').removeClass('d-none');
            },

            success: function (result) {
                if (result.status) {
                    toastr.success(result.msg);
                    setTimeout(() => {
                        window.location.href = result.location;
                    }, 800);
                } else {
                    toastr.error(result.msg);
                }
            },

            complete: function () {
                // Reset button state
                $('#btn-text').text('Save');
            $('#btn-spinner').addClass('d-none');
            $('#submit-button').prop('disabled', false);
            },

            error: function (xhr) {
                console.log(xhr.responseText);
            toastr.error("Something went wrong. Please try again.");
            $('#btn-text').text('Save');
            $('#btn-spinner').addClass('d-none');
            $('#submit-button').prop('disabled', false);
            }
        });
    });

    // Section fetch based on class selection
    $('#class_id').on('change', function () {
        var class_id = $(this).val();

        var form = new FormData();
        form.append("class_id", class_id);

        $.ajax({
            url: "{{ route('admin.get_section_data') }}",
            type: "POST",
            data: form,
            dataType: 'json',
            processData: false,
            contentType: false,

            beforeSend: function () {
                $('#load').show();
                $('#spin-request-add').show();
            },

            success: function (result) {
                if (result.status) {
                    var $sectionDropdown = $('#section_id');
                    $sectionDropdown.empty();
                    $sectionDropdown.append('<option value="">Please Select Section *</option>');
                    $.each(result.data, function (index, section) {
                        $sectionDropdown.append('<option value="' + section.id + '">' + section.name + '</option>');
                    });
                    $sectionDropdown.trigger('change.select2');
                } else {
                    toastr.error(result.msg);
                }
            },

            complete: function () {
                $('#load').hide();
                $('#spin-request-add').hide();
            },

            error: function (jqXHR) {
                console.log(jqXHR.responseText);
                $('#load').hide();
            }
        });
    });
});

    </script>

</body>

</html>
