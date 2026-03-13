<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Account Settings - Tech Web Mantra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/admin/img/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('public/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/fonts/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <style>
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
        input[type="password"],
        input[type="file"] {
            border: 1px solid #ccc;
            border-radius: 5px;
            height: 40px;
            padding: 8px 12px;
            font-size: 14px;
            width: 100%;
            transition: 0.3s ease;
        }

        input:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 3px #cce5ff;
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

        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
            border: 2px solid #007bff;
        }
    </style>
</head>

<body>
    <div id="wrapper" class="wrapper bg-ash">
        @include('admin.include.header')

        <div class="dashboard-page-one">
            @include('admin.include.sidebar')

            <div class="dashboard-content-one">
                <div class="breadcrumbs-area">
                    <h3>Account Settings</h3>
                    <ul>
                        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li>Update Profile</li>
                    </ul>
                </div>

                <div class="card height-auto">
                    <div class="card-body">
                        <form id="account_settings_form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                
                                <div class="col-md-6 form-group">
                                    <label>Full Name *</label>
                                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" readonly>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Email *</label>
                                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" readonly>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Old Password</label>
                                    <input type="password" name="old_password" placeholder="Old Password">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>New Password</label>
                                    <input type="password" name="new_password" placeholder="New Password">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirm_password" placeholder="Confirm Password">
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

                @include('admin.include.footer')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('public/admin/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('public/admin/js/popper.min.js') }}"></script>
<script src="{{ asset('public/admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/admin/js/plugins.js') }}"></script>
<script src="{{ asset('public/admin/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('public/admin/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/admin/js/main.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <script>
        function loadPreview(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#previewImg').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        
    </script>
    
    
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            
            
            $('#account_settings_form').on('submit', function (e) {
    e.preventDefault();

    let fd = new FormData(this);

    $.ajax({
        url: "{{ route('admin.change_account_security') }}",
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
