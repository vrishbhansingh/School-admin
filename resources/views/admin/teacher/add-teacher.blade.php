<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Add Teacher - Tech Web Mantra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
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
                    <h3>Teacher</h3>
                    <ul>
                        <li>
                            <a href="{{ route('admin.dashboard') }}">Home</a>
                        </li>
                        <li>Add New Teacher</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Add New Teacher Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Add New Teacher</h3>
                            </div>
                            <div>
                                <a href="{{ route('admin.teacher_list') }}" class="btn-fill-lg bg-blue-dark btn-hover-yellow">
                                    Back
                                </a>
                            </div>
                        </div>
                        <form class="new-added-form" method="POST" enctype="multipart/form-data" id="add_teacher_data">
                            @csrf

                            <input type="hidden" name="school_id" value="{{ Auth::guard('admin')->user()->school_id }}">

                            <div class="row">

                                <!-- Teacher Name -->
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Teacher Name *</label>
                                    <input type="text" name="teacher_name" class="form-control" placeholder="Enter Teacher Name">
                                </div>

                                <!-- Email -->
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Email *</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter Email">
                                </div>

                                <!-- Phone -->
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Phone *</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number">
                                </div>

                                <!-- Gender -->
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Gender *</label>
                                    <select name="gender" class="select2 form-control">
                                        <option value="">Select Gender</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                        <option value="O">Other</option>
                                    </select>
                                </div>

                                <!-- DOB -->
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Date Of Birth *</label>
                                    <input type="text" name="dob" class="form-control air-datepicker" placeholder="YYYY-MM-DD">
                                </div>

                                <!-- Blood Group -->
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Blood Group</label>
                                    <select name="blood_group" class="select2 form-control">
                                        <option value="">Select Blood Group</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="B+">B+</option>
                                        <option value="B-">B-</option>
                                        <option value="O+">O+</option>
                                        <option value="O-">O-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="AB-">AB-</option>
                                    </select>
                                </div>

                                <!-- Qualification -->
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Qualification</label>
                                    <input type="text" name="qualification" class="form-control" placeholder="Enter Qualification">
                                </div>

                                <!-- Experience -->
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Experience</label>
                                    <input type="text" name="experience" class="form-control" placeholder="Example: 5 Years">
                                </div>

                                <!-- Joining Date -->
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Joining Date</label>
                                    <input type="text" name="joining_date" class="form-control air-datepicker" placeholder="YYYY-MM-DD">
                                </div>

                                <!-- Address -->
                                <div class="col-xl-6 col-lg-12 col-12 form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="Enter Address">
                                </div>

                                <!-- Profile Image -->
                                <div class="col-xl-6 col-lg-12 col-12 form-group">
                                    <label>Teacher Photo</label>

                                    <input type="file"
                                        name="profile_image"
                                        id="profile_image"
                                        class="form-control-file"
                                        accept="image/*">

                                    <img id="preview_image"
                                        src="{{ asset('public/admin/img/default-user.png') }}"
                                        width="120"
                                        style="margin-top:10px;border-radius:5px; display:none;">
                                </div>

                                <!-- Buttons -->
                                <div class="col-12 form-group mg-t-8">

                                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">
                                        Save Teacher
                                    </button>

                                    <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">
                                        Reset
                                    </button>

                                </div>

                            </div>

                        </form>
                    </div>
                </div>
                <!-- Add New Teacher Area End Here -->
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
        window.addEventListener('load', function() {
            document.getElementById('preloader').style.display = 'none';
        });

        $(document).on('submit', '#add_teacher_data', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('admin.add_teacher_data') }}",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    toastr.success(response.message);
                    window.location.href = "{{ route('admin.teacher_list') }}";
                    $('#add_teacher_data')[0].reset();
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.message || 'An error occurred while adding the teacher.');
                }
            });
        });

        document.getElementById("profile_image").addEventListener("change", function(e) {

            const file = e.target.files[0];

            if (file) {

                const reader = new FileReader();

                reader.onload = function(event) {

                    const preview = document.getElementById("preview_image");

                    preview.src = event.target.result;
                    preview.style.display = "block";

                }

                reader.readAsDataURL(file);

            }

        });
    </script>

</body>

</html>