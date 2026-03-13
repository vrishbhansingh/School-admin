<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Students List - Tech Web Mantra</title>
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
    <link rel="stylesheet" href="{{ asset('public/admin/css/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- Preloader CSS -->
    <style>
        /* Add your pre-existing styles here */
        /* Additional styles for the modal */
        .modal-dialog {
            max-width: 500px;
        }
        .modal-content {
            padding: 20px;
        }
        .btn-upload {
            background-color: #007bff;
            color: white;
        }
        .btn-upload:hover {
            background-color: #0056b3;
        }

        /* Style for the buttons container */
        .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .button-container .btn {
            margin-right: 15px;
        }

        .btn-upload {
            margin-left: 15px;
        }
    </style>

    <script src="{{ asset('public/admin/js/modernizr-3.6.0.min.js') }}"></script>
</head>

<body>
    <!-- Preloader -->
    <div id="preloader"></div>

    <div id="wrapper" class="wrapper bg-ash">
        @include('admin.include.header')

        <div class="dashboard-page-one">
            @include('admin.include.sidebar')

            <div class="dashboard-content-one">
                <!-- Breadcrumb + Button -->
                <div class="breadcrumbs-area d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <h3>Students List</h3>
                        <ul class="breadcrumb mb-0">
                            <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li>All Students</li>
                        </ul>
                    </div>

                    <!-- Buttons container with flexbox -->
                    <div class="button-container mt-2 mt-md-0">
                        <a href="{{ route('admin.add_student') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus-circle mr-2"></i> Add Student
                        </a>
                        
                        <!-- Button to trigger the modal -->
                        <button class="btn btn-upload btn-lg" data-toggle="modal" data-target="#uploadModal">
                            <i class="fas fa-upload mr-2"></i> Upload Bulk Student
                        </button>
                    </div>
                </div>

                <!-- Student Table Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table display data-table text-nowrap" id="student_addmission_list">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Photo</th>
                                        <th>Roll</th>
                                        <th>Admission No</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Class</th>
                                        <th>Section</th>
                                        <th>Father Name</th>
                                        <th>Address</th>
                                        <th>DOB</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Data will be populated by DataTables --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @include('admin.include.footer')
            </div>
        </div>
    </div>

    <!-- Modal for Uploading Bulk Students -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h5 class="modal-title" id="uploadModalLabel">Upload Bulk Student Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form id="bulkUploadForm" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <!-- Download Button -->
        <div class="text-right mb-3">
            <a href="https://techwebmantra.com/school/public/student_data.csv" class="btn btn-info btn-lg">
                <i class="fas fa-download mr-2"></i> Download Format
            </a>
        </div>

        <!-- Class -->
        <div class="form-group">
            <label for="class">Select Class</label>
            <select class="form-control" name="class_id" id="class_id" required>
                <option value="">Select Class</option>
                @foreach($Sclass as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Section -->
        <div class="form-group">
            <label for="section">Select Section</label>
            <select class="form-control" name="section_id" id="section_id" required>
                <option value="">Please Select Section *</option>
            </select>
        </div>

        <!-- File -->
        <div class="form-group">
            <label for="file">Choose File (CSV/Excel)</label>
            <input type="file" class="form-control" name="file" id="file" accept=".csv,.xls,.xlsx" required>
        </div>

        <!-- Progress Bar -->
        <div class="progress mt-3" style="height: 20px; display:none;">
            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 0%;">
                0%
            </div>
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



    <!-- Scripts -->
    <script src="{{ asset('public/admin/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/main.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Preloader Hide Script -->
    <script>
        window.addEventListener('load', function () {
            document.getElementById('preloader').style.display = 'none';
        });

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#student_addmission_list').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                ajax: {
                    url: "{{ route('admin.get_student_addmission_list') }}",
                    type: "POST",
                    dataFilter: function (data) {
                        let json = jQuery.parseJSON(data);
                        json.recordsTotal = json.recordsTotal;
                        json.recordsFiltered = json.recordsFiltered;
                        json.data = json.data.map(function (row, index) {
                            // Add print button
                            row[13] = `<a href="/admin/print-registration/${row[2]}" target="_blank" title="Print">
                                            <i class="fas fa-print text-primary"></i>
                                        </a>`;
                            return row;
                        });
                        return JSON.stringify(json);
                    }
                },
                order: [[0, 'desc']],
                columns: [
                    { data: 0, name: 'id' },
                    { data: 1, name: 'photo' },
                    { data: 2, name: 'roll_no' },
                    { data: 3, name: 'admission_no' },
                    { data: 4, name: 'name' },
                    { data: 5, name: 'gender' },
                    { data: 6, name: 'class' },
                    { data: 7, name: 'section' },
                    { data: 8, name: 'parents' },
                    { data: 9, name: 'address' },
                    { data: 10, name: 'dob' },
                    { data: 11, name: 'phone' },
                    { data: 12, name: 'email' },
                ]
            });
        });
        
        
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
    </script>
    
    <script>
$(document).ready(function () {

    // ✅ File validation before upload
    $('#file').on('change', function () {
        let fileName = $(this).val().split('\\').pop();
        let allowedExtensions = /(\.csv|\.xlsx|\.xls)$/i;
        if (!allowedExtensions.exec(fileName)) {
            alert('Invalid file type. Only CSV, XLS, XLSX allowed.');
            $(this).val('');
            return false;
        }
    });

    // ✅ Handle form submit with AJAX
    $('#bulkUploadForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        // Show progress bar
        $('.progress').show();
        $('.progress-bar').css('width', '0%').text('0%');

        $.ajax({
            xhr: function () {
                let xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        let percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        $('.progress-bar')
                            .css('width', percentComplete + '%')
                            .text(percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            url: "{{ route('admin.bulk_upload_students') }}", // Laravel route
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function (response) {
    if (response.status) {
        toastr.success(response.message);

        if ($.fn.DataTable.isDataTable('#student_addmission_list')) {
            $('#student_addmission_list').DataTable().ajax.reload(null, false);
        }

        $('.progress').hide();
        $('#bulkUploadForm')[0].reset();
        $('.progress-bar').css('width', '0%').text('0%');
        $('#uploadModal').modal('hide');
    } else {
        toastr.error(response.message);
    }
},

            error: function (xhr) {
                // ✅ Error handling
                let msg = "Upload failed! Please check file format.";
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                toastr.error(msg);

                // Reset progress
                $('.progress').hide();
                $('.progress-bar').css('width', '0%').text('0%');
            }
        });
    });
});
</script>


    
</body>

</html>
