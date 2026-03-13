<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Student Registration - Tech Web Mantra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/admin/img/favicon.png') }}">

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
        
        
        body {
    background-color: #f4f7fa;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    color: #333;
}

.card {
    background-color: #fff;
    border-radius: 8px;
    padding: 30px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.card h3 {
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 25px;
    color: #2c3e50;
}

label {
    font-weight: 500;
    margin-bottom: 6px;
    display: block;
}

input[type="text"],
input[type="email"],
input[type="date"],
select,
textarea {
    border: 1px solid #ccc;
    border-radius: 5px;
    height: 40px;
    padding: 8px 12px;
    font-size: 14px;
    width: 100%;
    transition: 0.3s ease;
}

input:focus,
select:focus,
textarea:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 3px #cce5ff;
}

textarea {
    height: auto;
    resize: vertical;
    padding: 10px;
}

.btn-fill-lg {
    padding: 10px 25px;
    font-size: 14px;
    font-weight: 600;
    border-radius: 4px;
    text-transform: uppercase;
}

.btn-gradient-yellow {
    background: linear-gradient(to right, #fdd835, #fbc02d);
    border: none;
    color: #333;
}

.bg-blue-dark {
    background-color: #2c3e50;
    border: none;
    color: #fff;
}

.btn-hover-bluedark:hover {
    background-color: #34495e !important;
    color: #fff;
}

.btn-hover-yellow:hover {
    background-color: #f1c40f !important;
    color: #fff;
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
                    <h3>Student Registration</h3>
                    <ul>
                        <li>
                            <a href="{{ route('admin.dashboard') }}">Home</a>
                        </li>
                        <li>Student Registration Form</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Admit Form Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        
                        <form class="new-added-form" id="student_registration">
                            @csrf
                            <div class="row">
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>First Name *</label>
                                    <input type="text" name="first_name" placeholder="Enter First Name" class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Last Name *</label>
                                    <input type="text" name="last_name" placeholder="Enter Last Name" class="form-control">
                                </div>
                                
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Phone *</label>
                                    <input type="text" name="phone" placeholder="Enter Phone" class="form-control">
                                </div>
                                
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Email *</label>
                                    <input type="email" name="email"  placeholder="Enter Email" class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Gender *</label>
                                    <select class="select2" name="gender">
                                        <option value="">Please Select Gender *</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Date Of Birth *</label>
                                    <input type="text" placeholder="dd/mm/yyyy" name="dob" class="form-control air-datepicker"
                                        data-position='bottom right'>
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Address</label>
                                    <input type="text" name='address' placeholder="Address" class="form-control">
                                </div>
                                
                                
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Reg. Date</label></label>
                                    <input type="text" name='reg_date' placeholder="Reg. Date" class="form-control air-datepicker">
                                     <i class="far fa-calendar-alt"></i>
                                </div>
                                
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Reference *</label>
                                    <select class="select2" name='reference'>
                                        <option value="">Please Select Reference *</option>
                                        <option value="Self">Self</option>
                                        <option value="Staff">Staff</option>
                                        <option value="Parent">Parent</option>
                                        <option value="Student">Student</option>
                                        <option value="Lower Wing">Lower Wing</option>
                                        <option value="Partner School">Partner School</option>
                                        
                                    </select>
                                </div>
                                
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Class *</label>
                                    
                                        <select class="select2" name='class_id'>
                                        <option value="">Please Select Class *</option>
                                        @foreach($Sclass as $sc)
                                        <option value="{{ $sc->id }}">{{ $sc->name }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Section *</label>
                                    <select class="select2" name='section_id'>
                                        <option value="">Please Select Section *</option>
                                        @foreach($Ssection as $ss)
                                        <option value="{{ $ss->id }}">{{ $ss->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Aadhar Number</label></label>
                                    <input type="text" name='aadhar_number' placeholder="Aadhar Number" class="form-control">
                                </div>
                                
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>City</label></label>
                                    <input type="text" name='city' placeholder="City" class="form-control">
                                </div>
                                
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>State</label></label>
                                    <select name="state" class="select2" id="state" >
                                  <option value="">-- Select State/UT --</option>
                                  <option value="Andhra Pradesh">Andhra Pradesh</option>
                                  <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                  <option value="Assam">Assam</option>
                                  <option value="Bihar">Bihar</option>
                                  <option value="Chhattisgarh">Chhattisgarh</option>
                                  <option value="Goa">Goa</option>
                                  <option value="Gujarat">Gujarat</option>
                                  <option value="Haryana">Haryana</option>
                                  <option value="Himachal Pradesh">Himachal Pradesh</option>
                                  <option value="Jharkhand">Jharkhand</option>
                                  <option value="Karnataka">Karnataka</option>
                                  <option value="Kerala">Kerala</option>
                                  <option value="Madhya Pradesh">Madhya Pradesh</option>
                                  <option value="Maharashtra">Maharashtra</option>
                                  <option value="Manipur">Manipur</option>
                                  <option value="Meghalaya">Meghalaya</option>
                                  <option value="Mizoram">Mizoram</option>
                                  <option value="Nagaland">Nagaland</option>
                                  <option value="Odisha">Odisha</option>
                                  <option value="Punjab">Punjab</option>
                                  <option value="Rajasthan">Rajasthan</option>
                                  <option value="Sikkim">Sikkim</option>
                                  <option value="Tamil Nadu">Tamil Nadu</option>
                                  <option value="Telangana">Telangana</option>
                                  <option value="Tripura">Tripura</option>
                                  <option value="Uttar Pradesh">Uttar Pradesh</option>
                                  <option value="Uttarakhand">Uttarakhand</option>
                                  <option value="West Bengal">West Bengal</option>
                                  <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                  <option value="Chandigarh">Chandigarh</option>
                                  <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
                                  <option value="Delhi">Delhi</option>
                                  <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                  <option value="Ladakh">Ladakh</option>
                                  <option value="Lakshadweep">Lakshadweep</option>
                                  <option value="Puducherry">Puducherry</option>
                                </select>

                                </div>
                                
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Pincode</label></label>
                                    <input type="text" name='pincode' placeholder="Pincode" class="form-control">
                                </div>
                                
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Reg. Amount</label></label>
                                    <input type="text" name='reg_amount' placeholder="Reg. Amount" class="form-control">
                                </div>
                                
                                
                                <div class="col-12 form-group mg-t-8">
                                   <button type="submit" id="submit-button" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">
                                        <span id="btn-text">Save</span>
                                        <span id="btn-spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    </button>
                                    <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
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
            
            
            $('#student_registration').on('submit', function (e) {
    e.preventDefault();

    let fd = new FormData(this);

    $.ajax({
        url: "{{ route('admin.register_student') }}",
        type: "POST",
        data: fd,
        dataType: 'json',
        processData: false,
        contentType: false,

        beforeSend: function () {
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

        });
    </script>

</body>

</html>
