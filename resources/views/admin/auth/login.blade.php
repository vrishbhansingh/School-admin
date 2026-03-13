<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>School ERP | Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('public/admin/twm_logo.png') }}" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('public/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <style>
        .login-page-wrap {
            background: url("{{ asset('public/admin/login-bg.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="login-page-wrap">
        <div class="login-page-content">
            <div class="login-box">
                <div class="item-logo text-center mb-3">
                    <!--<img src="{{ asset('public/admin/twm_logo.png') }}" style="height: 110px;" alt="logo">-->
                    <h3>Head Office Login</h3>
                </div>

                <!-- Login Form -->
                <form id="loginSubmit" method="POST" class="login-form">
                    @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Enter email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter password" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Select Role</label>
                        <select name="role" class="form-control" required>
                            <option value="super_admin">Super Admin</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" id="login-button" class="login-btn btn btn-primary btn-block">
                            <span id="btn-text">Login</span>
                            <span id="btn-spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('public/admin/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            
            
            $('#loginSubmit').on('submit', function (e) {
                e.preventDefault();

                let fd = new FormData(this);
                

                $.ajax({
                    url: "{{ route('admin.go_login') }}", // make sure this route exists
                    type: "POST",
                    data: fd,
                    dataType: 'json',
                    processData: false,
                    contentType: false,

                    beforeSend: function () {
                        $('#login-button').prop('disabled', true);
                        $('#btn-text').text('Logging in...');
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
                        $('#btn-text').text('Login');
                        $('#btn-spinner').addClass('d-none');
                        $('#login-button').prop('disabled', false);
                    },

                    error: function (xhr) {
                        console.log(xhr.responseText);
                        toastr.error("Something went wrong. Please try again.");
                        $('#btn-text').text('Login');
                        $('#btn-spinner').addClass('d-none');
                        $('#login-button').prop('disabled', false);
                    }
                });
            });
        });
    </script>
</body>
</html>
