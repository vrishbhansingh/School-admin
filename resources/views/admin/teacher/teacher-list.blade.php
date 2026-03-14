<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Teacher List - Tech Web Mantra</title>
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
    <link rel="stylesheet" href="{{ asset('public/admin/css/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/animate.min.css') }}">
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

        .teacher-search-box {
            max-width: 400px;
        }

        .search-wrapper {
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            border-radius: 6px;
            overflow: hidden;
        }

        #teacher_search {
            height: 45px;
            font-size: 14px;
        }

        .expand-btn {
            width: 28px;
            height: 28px;
            padding: 0;
            font-weight: bold;
        }

        .btn-warning {
            background: linear-gradient(45deg, #ff9d01, #ffb300);
            border: none;
            color: #fff;
            font-weight: 500;
        }

        .btn-warning:hover {
            background: linear-gradient(45deg, #ff8c00, #ffa000);
        }

        .teacher-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ddd;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 45px;
            height: 22px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #28a745;
        }

        input:checked+.slider:before {
            transform: translateX(22px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
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
                        <li>All Teachers</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Teacher Table Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1 d-flex align-items-center justify-content-between mb-4">

                            <div class="item-title">
                                <h3 class="mb-0">All Teachers Data</h3>
                            </div>

                            <a href="{{ route('admin.add_teacher') }}" class="btn btn-warning btn-lg d-flex align-items-center gap-2">

                                <i class="fas fa-plus"></i>
                                Add Teacher

                            </a>

                        </div>
                        <form class="mg-b-20">
                            <!-- Search Area -->
                            <div class="row mb-4 d-flex align-items-center justify-content-end">

                                <div class="col-md-4 ms-auto">

                                    <div class="input-group shadow-sm">

                                        <span class="input-group-text bg-white">
                                            <i class="fas fa-search text-muted"></i>
                                        </span>

                                        <input
                                            type="text"
                                            id="teacher_search"
                                            class="form-control"
                                            placeholder="Search teachers...">

                                    </div>

                                </div>

                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:40px;"></th>
                                        <th class="text-center">Image</th>
                                        <th class="text-center">ID No</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Phone</th>
                                        <th class="text-center">Gender</th>
                                        <th class="text-center">Qualification</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="teacher_table_body">

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <!-- Teacher Table Area End Here -->
                @include('admin.include.footer')
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>

    <div class="modal fade" id="statusModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Change Status</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                </div>

                <div class="modal-body">
                    <p>Are you sure you want to change this teacher status?</p>

                    <input type="hidden" id="status_teacher_id">
                    <input type="hidden" id="status_value">
                </div>

                <div class="modal-footer">

                    <button class="btn btn-secondary" data-dismiss="modal">
                        Cancel
                    </button>

                    <button class="btn btn-success" id="confirm_status">
                        <span class="btn-text">Submit</span>
                        <span class="btn-loader" style="display:none;">
                            <i class="fas fa-spinner fa-spin"></i> Updating...
                        </span>
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- jquery-->
    <script src="{{ asset('public/admin/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/plugins.js') }}"></script>
    <script src="{{ asset('public/admin/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <!-- Preloader Hide Script -->
    <script>
        let teachersData = [];
        const teacherImageBase = "{{ asset('public/uploads/teachers') }}/";
        const defaultTeacherImage = "{{ asset('public/admin/img/default-user.png') }}";
        $(document).ready(function() {

            loadTeacherData();

        });

        function loadTeacherData() {

            $("#loader").show();

            $.ajax({

                url: "{{ url('admin/get-teachers-data') }}",
                type: "GET",
                dataType: "json",

                success: function(response) {
                    teachersData = response;

                    renderTeachers(teachersData);
                    $("#loader").hide();

                    let html = '';

                    $.each(response, function(index, teacher) {

                        html += `
                        <tr class="main-row">
                            <td class="text-center">
                                <button class="expand-btn btn btn-sm btn-primary">+</button>
                            </td>
                           <td class="text-center">
                                <img 
                                    src="${teacher.profile_image ? teacherImageBase + teacher.profile_image : defaultTeacherImage}"
                                    class="teacher-img">
                            </td>
                            <td class="text-center">${teacher.id_no}</td>

                            <td class="text-center">${teacher.teacher_name}</td>
                            <td class="text-center">${teacher.email}</td>
                            <td class="text-center">${teacher.phone}</td>
                            <td class="text-center">${teacher.gender}</td>
                            <td class="text-center">${teacher.qualification}</td>
                            <td class="text-center">
                                <label class="switch">
                                <input type="checkbox" 
                                    class="status-toggle" 
                                    data-id="${teacher.id}"
                                    ${teacher.status == 'Active' ? 'checked' : ''}>
                                <span class="slider round"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <a href="{{ url('admin/edit-teacher') }}/${teacher.id}" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>

                        <tr class="detail-row" style="display:none;">
                            <td colspan="7">
                                <div style="padding:15px;background:#f8f9fa;border-radius:6px">

                                <div class="row">

                                <div class="col-md-4">
                                <strong>Experience:</strong> ${teacher.experience}
                                </div>

                                <div class="col-md-4">
                                <strong>Joining Date:</strong> ${teacher.joining_date}
                                </div>

                                <div class="col-md-4">
                                <strong>Blood Group:</strong> ${teacher.blood_group}
                                </div>

                                <div class="col-md-4 mt-2">
                                <strong>DOB:</strong> ${teacher.dob}
                                </div>

                                <div class="col-md-8 mt-2">
                                   <strong>Address:</strong> ${teacher.address}
                                </div>

                                </div>
                                </div>
                            </td>
                        </tr>
                        `;

                    });

                    $("#teacher_table_body").html(html);

                },

                error: function(xhr) {
                    $("#loader").hide();
                    toastr.error(xhr.responseText);

                }

            });

        }

        $(document).on("click", ".expand-btn", function() {

            let button = $(this);

            let mainRow = button.closest("tr");

            let detailRow = mainRow.next(".detail-row");

            detailRow.toggle();

            if (button.text() === "+") {
                button.text("-");
            } else {
                button.text("+");
            }

        });



        function renderTeachers(data) {

            let html = '';

            $.each(data, function(index, teacher) {

                html += `
                <tr class="main-row">

                <td class="text-center">
                <button class="expand-btn btn btn-sm btn-primary">+</button>
                </td>

                <td class="text-center">
                    <img 
                        src="${teacher.profile_image ? teacherImageBase + teacher.profile_image : defaultTeacherImage}"
                        class="teacher-img">
                </td>       

                <td class="text-center">${teacher.id_no}</td>
                <td class="text-center">${teacher.teacher_name}</td>
                <td class="text-center">${teacher.email}</td>
                <td class="text-center">${teacher.phone}</td>
                <td class="text-center">${teacher.gender}</td>
                <td class="text-center">${teacher.qualification}</td>
                <td class="text-center">
                    <label class="switch">
                    <input type="checkbox" 
                        class="status-toggle" 
                        data-id="${teacher.id}"
                        ${teacher.status == 'Active' ? 'checked' : ''}>
                    <span class="slider round"></span>
                    </label>
                    </td>
                <td class="text-center">
                                <a href="{{ url('admin/edit-teacher') }}/${teacher.id}" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                </tr>

                <tr class="detail-row" style="display:none;">
                <td colspan="7">

                <div style="padding:15px;background:#f8f9fa;border-radius:6px">

                <div class="row">

                <div class="col-md-4">
                <strong>Experience:</strong> ${teacher.experience}
                </div>

                <div class="col-md-4">
                <strong>Joining Date:</strong> ${teacher.joining_date}
                </div>

                <div class="col-md-4">
                <strong>Blood Group:</strong> ${teacher.blood_group}
                </div>

                <div class="col-md-4 mt-2">
                <strong>DOB:</strong> ${teacher.dob}
                </div>

                <div class="col-md-8 mt-2">
                <strong>Address:</strong> ${teacher.address}
                </div>

                </div>

                </div>

                </td>
                </tr>
                `;

            });

            $("#teacher_table_body").html(html);

        }


        $("#teacher_search").on("keyup", function() {

            let value = $(this).val().toLowerCase();

            let filtered = teachersData.filter(function(teacher) {

                return (
                    teacher.id_no.toLowerCase().includes(value) ||
                    teacher.teacher_name.toLowerCase().includes(value) ||
                    teacher.email.toLowerCase().includes(value) ||
                    teacher.phone.toLowerCase().includes(value)
                );

            });

            renderTeachers(filtered);

        });

        $('#statusModal').on('hidden.bs.modal', function() {

            if (currentToggle) {

                currentToggle.prop("checked", previousState);

                currentToggle = null;
                previousState = null;

            }

        });

        let currentToggle = null;
        let previousState = null;

        $(document).on("change", ".status-toggle", function() {

            currentToggle = $(this);

            // save old value
            previousState = !currentToggle.prop("checked");

            let id = currentToggle.data("id");
            let status = currentToggle.prop("checked") ? 1 : 0;

            $("#status_teacher_id").val(id);
            $("#status_value").val(status);

            $("#statusModal").modal("show");

        });


        $("#confirm_status").click(function() {

            let id = $("#status_teacher_id").val();
            let status = $("#status_value").val();

            // loader show
            $("#confirm_status").prop("disabled", true);
            $("#confirm_status .btn-text").hide();
            $("#confirm_status .btn-loader").show();
            $.ajax({

                url: "{{ url('admin/update-teacher-status') }}",

                type: "POST",

                data: {
                    id: id,
                    status: status,
                    _token: "{{ csrf_token() }}"
                },

                success: function(response) {

                    $("#statusModal").modal("hide");

                    
                    $("#confirm_status").prop("disabled", false);
                    $("#confirm_status .btn-text").show();
                    $("#confirm_status .btn-loader").hide();
                    toastr.success("Status updated successfully");

                    currentToggle = null;
                    previousState = null;

                    setTimeout(function() {
                        loadTeacherData();
                    }, 500);

                },

                error: function() {

                    toastr.error("Status update failed");
                    $("#confirm_status").prop("disabled", false);
                    $("#confirm_status .btn-text").show();
                    $("#confirm_status .btn-loader").hide();

                }

            });

        });
    </script>



</body>

</html>