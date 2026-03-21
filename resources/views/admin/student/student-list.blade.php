<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Students List - Tech Web Mantra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/admin/img/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('public/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/fonts/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />


    <style>
        .modal-dialog {
            max-width: 500px;
        }

        .modal-content {
            padding: 20px;
        }

        .btn-upload {
            background: #007bff;
            color: #fff;
        }

        .btn-upload:hover {
            background: #0056b3;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .button-container .btn {
            margin-right: 15px;
        }

        td.details-control {
            cursor: pointer;
            font-weight: bold;
            text-align: center;
            font-size: 18px;
            color: #007bff;
        }

        .child-row {
            background: #f8f9fa;
            padding: 15px;
        }

        #student_addmission_list thead th {
            position: sticky;
            top: 0;
            background: #fff;
            z-index: 10;
            border-bottom: 2px solid #ddd;
        }

        .dataTables_wrapper {
            overflow-x: hidden;
        }

        /* Proper Status Button */
        .status-btn {
            min-width: 110px;
            padding: 7px 16px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            border: none;
            outline: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .status-btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
    </style>

    <script src="{{ asset('public/admin/js/modernizr-3.6.0.min.js') }}"></script>
</head>

<body>

    <div id="preloader"></div>

    <div id="wrapper" class="wrapper bg-ash">

        @include('admin.include.header')

        <div class="dashboard-page-one">

            @include('admin.include.sidebar')

            <div class="dashboard-content-one">

                <div class="breadcrumbs-area d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <h3>Students List</h3>
                        <ul class="breadcrumb mb-0">
                            <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li>All Students</li>
                        </ul>
                    </div>

                    <div class="button-container mt-2 mt-md-0">
                        <a href="{{ route('admin.add_student') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus-circle mr-2"></i> Add Student
                        </a>

                        <button class="btn btn-upload btn-lg" data-toggle="modal" data-target="#uploadModal">
                            <i class="fas fa-upload mr-2"></i> Upload Bulk Student
                        </button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table display data-table text-nowrap" id="student_addmission_list">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th  class="text-center">#</th>
                                        <th  class="text-center">Photo</th>
                                        <th  class="text-center">Roll</th>
                                        <th  class="text-center">Admission No</th>
                                        <th  class="text-center">Name</th>
                                        <th  class="text-center">Gender</th>
                                        <th  class="text-center">Class</th>
                                        <th  class="text-center">Section</th>
                                        <th  class="text-center">Father Name</th>
                                        <th  class="text-center">Address</th>
                                        <th  class="text-center">DOB</th>
                                        <th  class="text-center">Phone</th>
                                        <th  class="text-center">Email</th>
                                        <th  class="text-center">Status</th>
                                        <th  class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @include('admin.include.footer')

            </div>
        </div>
    </div>

    <!-- Upload Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Upload Bulk Student Data</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form id="bulkUploadForm" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">

                        <div class="text-right mb-3">
                            <a href="https://techwebmantra.com/school/public/student_data.csv" class="btn btn-info btn-lg">
                                <i class="fas fa-download mr-2"></i> Download Format
                            </a>
                        </div>

                        <div class="form-group">
                            <label>Select Class</label>
                            <select class="form-control" name="class_id" id="class_id">
                                <option value="">Select Class</option>
                                @foreach($Sclass as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Select Section</label>
                            <select class="form-control" name="section_id" id="section_id">
                                <option value="">Please Select Section *</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Choose File</label>
                            <input type="file" class="form-control" name="file" id="file">
                        </div>

                        <div class="progress mt-3" style="display:none;height:20px">
                            <div class="progress-bar bg-success" style="width:0%">0%</div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-lg">Upload & Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Status Change Modal -->
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Confirm Status Change</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="statusModalMessage">
                    Are you sure you want to change the status?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmStatusChange">Yes, Change</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('public/admin/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/main.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        window.addEventListener('load', function() {
            document.getElementById('preloader').style.display = 'none';
        });

        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let selectedStudentId = '';
            let selectedNewStatus = '';
            let selectedButton = null;

            function format(row) {
                let html = '';
                html += '<div class="child-row">';
                html += '<div><b>Section:</b> ' + (row.section_name || '') + '</div>';
                html += '<div><b>Father Name:</b> ' + (row.father_name || '') + '</div>';
                html += '<div><b>Address:</b> ' + (row.address || '') + '</div>';
                html += '<div><b>DOB:</b> ' + (row.dob || '') + '</div>';
                html += '<div><b>Phone:</b> ' + (row.phone || '') + '</div>';
                html += '<div><b>Email:</b> ' + (row.email || '') + '</div>';
                html += '</div>';
                return html;
            }

            var table = $('#student_addmission_list').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                scrollX: false,
                ajax: {
                    url: "{{ route('admin.get_student_addmission_list') }}",
                    type: "POST"
                },
                columns: [{
                        data: null,
                        orderable: false,
                        searchable: false,
                        className: 'details-control',
                        render: function() {
                            return '<span style="cursor:pointer;font-weight:bold;">+</span>';
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'photo',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return '<img src="{{ url("public/admin/student") }}/' + data + '" style="width:60px;height:60px;object-fit:cover;border-radius:6px;">';
                        }
                    },
                    {
                        data: 'roll_no'
                    },
                    {
                        data: 'addmission_no'
                    },
                    {
                        data: 'name',
                        render: function(data, type, row) {
                            return '<div style="width:140px;"><a href="{{ url("/admin/student-details") }}/' + btoa(row.id) + '">' + data + '</a></div>';
                        }
                    },
                    {
                        data: 'gender'
                    },
                    {
                        data: 'class_name'
                    },
                    {
                        data: 'section_name'
                    },
                    {
                        data: 'father_name',
                        visible: false
                    },
                    {
                        data: 'address',
                        visible: false
                    },
                    {
                        data: 'dob',
                        visible: false
                    },
                    {
                        data: 'phone',
                        visible: false
                    },
                    {
                        data: 'email',
                        visible: false
                    },
                    {
                        data: 'status',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return '<button type="button" class="status-btn btn ' +
                                (data === 'ACTIVE' ? 'btn-success' : 'btn-danger') +
                                ' toggle-status" data-id="' + row.id + '" data-status="' + data + '">' +
                                data +
                                '</button>';
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return '<a href="{{ url("/admin/edit-student") }}/' + row.id + '" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>';
                        }
                    }
                ]
            });

            $('#student_addmission_list tbody').on('click', 'td.details-control', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var icon = $(this).find('span');

                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('shown');
                    icon.html('+');
                } else {
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                    icon.html('-');
                }
            });

            $('#student_addmission_list tbody').on('click', '.toggle-status', function(e) {
                e.preventDefault();

                selectedStudentId = $(this).attr('data-id');
                let currentStatus = $(this).attr('data-status');

                selectedNewStatus = currentStatus === 'ACTIVE' ? 'INACTIVE' : 'ACTIVE';
                selectedButton = $(this);

                $('#statusModalMessage').html(
                    'Are you sure you want to change status to <b>' + selectedNewStatus + '</b>?'
                );

                $('#statusModal').modal('show');
            });

            $('#confirmStatusChange').on('click', function() {
                if (!selectedStudentId || !selectedNewStatus || !selectedButton) {
                    return;
                }

                $.ajax({
                    url: '{{ route("admin.change_student_status") }}',
                    type: 'POST',
                    data: {
                        student_id: selectedStudentId,
                        status: selectedNewStatus
                    },
                    success: function(response) {
                        if (response.status) {
                            selectedButton
                                .attr('data-status', response.new_status)
                                .removeClass('btn-success btn-danger')
                                .addClass(response.new_status === 'ACTIVE' ? 'btn-success' : 'btn-danger')
                                .text(response.new_status);
                            toastr.success(response.msg);
                            $('#statusModal').modal('hide');
                        } else {
                            toastr.error(response.msg);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        toastr.error('Error updating status');
                    }
                });
            });

        });
    </script>



</body>

</html>