<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Edit Teacher - Tech Web Mantra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset('public/admin/img/favicon.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('public/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />


    <style>
        .form-section-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            padding-bottom: 6px;
            border-bottom: 2px solid #eee;
        }

        .form-card {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

        .teacher-image-box {
            border: 1px dashed #ddd;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            background: #fafafa;
        }

        .teacher-image-box img {
            border-radius: 6px;
            margin-bottom: 10px;
        }
    </style>

</head>

<body>

    <div id="wrapper" class="wrapper bg-ash">

        @include('admin.include.header')

        <div class="dashboard-page-one">

            @include('admin.include.sidebar')

            <div class="dashboard-content-one">

                <div class="breadcrumbs-area d-flex justify-content-between align-items-center">
                    <div>
                        <h3>Teacher</h3>
                        <ul>
                            <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li>Edit Teacher</li>
                        </ul>
                    </div>
                    <div>
                        <a href="{{ route('admin.teacher_list') }}" class="btn-fill-lg bg-blue-dark btn-hover-yellow">
                            Back
                        </a>
                    </div>
                </div>

                <div class="card height-auto">
                    <div class="card-body">

                        <h4 class="mb-4">Edit Teacher</h4>

                        <form method="POST" enctype="multipart/form-data" id="edit_teacher_details">
                            @csrf

                            <div class="row">

                                <!-- LEFT SIDE FORM -->

                                <div class="col-md-8">

                                    <div class="form-card mb-4">

                                        <div class="form-section-title">Basic Information</div>

                                        <div class="row">
                                            <input type="text" name="teacher_id" value="{{ $teacher->id }}" hidden>
                                            <div class="col-md-6 form-group">
                                                <label>Teacher Name</label>
                                                <input type="text" name="teacher_name" class="form-control" value="{{ $teacher->teacher_name }}">
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control" value="{{ $teacher->email }}">
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label>Phone</label>
                                                <input type="text" name="phone" class="form-control" value="{{ $teacher->phone }}">
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label>Gender</label>
                                                <select name="gender" class="form-control select2">
                                                    <option value="M" {{ $teacher->gender=='M'?'selected':'' }}>Male</option>
                                                    <option value="F" {{ $teacher->gender=='F'?'selected':'' }}>Female</option>
                                                    <option value="O" {{ $teacher->gender=='O'?'selected':'' }}>Other</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label>Date Of Birth</label>
                                                <input type="text" name="dob" class="form-control air-datepicker" value="{{ $teacher->dob }}">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-card">

                                        <div class="form-section-title">Professional Information</div>

                                        <div class="row">

                                            <div class="col-md-6 form-group">
                                                <label>Qualification</label>
                                                <input type="text" name="qualification" class="form-control" value="{{ $teacher->qualification }}">
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label>Experience</label>
                                                <input type="text" name="experience" class="form-control" value="{{ $teacher->experience }}">
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label>Joining Date</label>
                                                <input type="text" name="joining_date" class="form-control air-datepicker" value="{{ $teacher->joining_date }}">
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label>Blood Group</label>
                                                <select name="blood_group" class="form-control select2">
                                                    <option value="A+" {{ $teacher->blood_group=='A+'?'selected':'' }}>A+</option>
                                                    <option value="A-" {{ $teacher->blood_group=='A-'?'selected':'' }}>A-</option>
                                                    <option value="B+" {{ $teacher->blood_group=='B+'?'selected':'' }}>B+</option>
                                                    <option value="B-" {{ $teacher->blood_group=='B-'?'selected':'' }}>B-</option>
                                                    <option value="O+" {{ $teacher->blood_group=='O+'?'selected':'' }}>O+</option>
                                                    <option value="O-" {{ $teacher->blood_group=='O-'?'selected':'' }}>O-</option>
                                                </select>
                                            </div>

                                            <div class="col-md-12 form-group">
                                                <label>Address</label>
                                                <input type="text" name="address" class="form-control" value="{{ $teacher->address }}">
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <!-- RIGHT SIDE IMAGE -->

                                <div class="col-md-4">

                                    <div class="form-card">

                                        <div class="form-section-title">Teacher Photo</div>

                                        <div class="teacher-image-box text-center">

                                            <!-- Image Preview -->


                                            <input
                                                type="file"
                                                name="profile_image"
                                                id="profile_image"
                                                class="form-control mt-2"
                                                accept="image/*">

                                            <img
                                                id="teacher_preview"
                                                src="{{ $teacher->profile_image ? asset('public/uploads/teachers/'.$teacher->profile_image) : asset('public/admin/img/default-user.png') }}"
                                                width="140"
                                                style="border-radius:5px;margin-top:10px;">

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="mt-4">

                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save"></i> Update Teacher
                                </button>

                                <a href="{{ route('admin.teacher_list') }}" class="btn btn-secondary">
                                    Cancel
                                </a>

                            </div>

                        </form>

                    </div>
                </div>

                @include('admin.include.footer')

            </div>
        </div>
    </div>

    <script src="{{ asset('public/admin/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/datepicker.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <script>
        $('.select2').select2();

        $('.air-datepicker').datepicker({
            dateFormat: 'yyyy-mm-dd'
        });


        document.getElementById("profile_image").addEventListener("change", function(e) {

            const file = e.target.files[0];

            if (file) {

                const reader = new FileReader();

                reader.onload = function(event) {
                    document.getElementById("teacher_preview").src = event.target.result;
                }

                reader.readAsDataURL(file);

            }

        });

        $(document).on('submit', '#edit_teacher_details', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                url: "{{ route('admin.update_teacher') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    toastr.success(response.message);
                    setTimeout(() => {
                        window.location.href = "{{ route('admin.teacher_list') }}";
                    }, 1500);
                },
                error: function(xhr) {
                    toastr.error('An error occurred while updating the teacher.');
                }
            });
        })
    </script>

</body>

</html>