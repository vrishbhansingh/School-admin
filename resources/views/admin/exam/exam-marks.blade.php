<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Exam Marks - Tech Web Mantra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/admin/img/favicon.png') }}" />

    

    <link rel="shortcut icon" href="{{ asset('public/admin/img/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/fonts/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8fafc; }
        .breadcrumbs-area { padding: 25px 0; margin-bottom: 25px; border-bottom: 2px solid #e3e6f0; }
        .breadcrumbs-area h3 { font-weight: 600; color: #343a40; }
        .card { background: #fff; border: none; border-radius: 10px; padding: 25px; box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05); }
        table.dataTable thead th { background-color: #1a5697; font-weight: 600; color: #fff !important; text-align: center; }
        table.dataTable tbody td { text-align: center; }
        .modal-footer .btn { font-size: 16px; padding: 10px 20px; border-radius: 8px; }
        .modal-title { color: #ffffff; }
        .modal-header.bg-primary { background-color: #1d6198 !important; }
        button.modal-trigger { background-color: #1a5697; color: white; font-weight: 500; padding: 10px 16px; border-radius: 6px; border: none; }
        button.modal-trigger:hover { background-color: #154c86; }
        #preloader { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: #fff; z-index: 9999; }
        #preloader::after { content: ""; display: block; width: 50px; height: 50px; margin: 20% auto; border: 5px solid #f3f3f3; border-top: 5px solid #1a5697; border-radius: 50%; animation: spin 1s linear infinite; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        @media (max-width: 767px) { .card { padding: 15px; } .dataTables_wrapper .dataTables_filter { text-align: left; margin-bottom: 15px; }}
        .btn-warning { color: #ffffff !important; background-color: #06950c !important; border-color: #0b610e !important; }
        .badge-status { padding: 2px 11px; border-radius: 2px; font-weight: 500; font-size: 13px; }
        .badge-active { background-color: #28a745; color: white; }
        .badge-inactive { background-color: #dc3545; color: white; }
        .btn-icon-sm { padding: 0px 18px; font-size: 14px; border-radius: 4px; margin: 0 2px; }
        
        /* Container styling */
#student_id.select2-container {
    width: 100% !important;
}

/* Select2 selection box */
.select2-container--default .select2-selection--single {
    height: 45px;
    padding: 8px 12px;
    border: 1px solid #ced4da;
    border-radius: 5px;
    background-color: #fff;
    font-size: 16px;
    color: #495057;
    box-shadow: none;
    transition: border-color 0.3s ease;
}

/* Focus state */
.select2-container--default.select2-container--focus .select2-selection--single {
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 5px rgba(0,123,255,.5);
}

/* Placeholder text color */
.select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: #6c757d;
}

/* Dropdown arrow color */
.select2-container--default .select2-selection--single .select2-selection__arrow b {
    border-color: #495057 transparent transparent transparent;
}

/* Dropdown list styling */
.select2-dropdown {
    border-radius: 5px !important;
    font-size: 16px;
}

/* Items in dropdown */
.select2-results__option {
    padding: 8px 12px;
}

/* Hover/focus on options */
.select2-results__option--highlighted[aria-selected] {
    background-color: #007bff;
    color: white;
}

/* Scrollbar styling (optional) */
.select2-results__options {
    max-height: 200px;
    overflow-y: auto;
}


/* Wrapper and heading */
#subject_marks_wrapper {
    background: #f9f9f9;
    padding: 15px 20px;
    border-radius: 8px;
    box-shadow: 0 0 8px rgba(0,0,0,0.05);
}

#subject_marks_wrapper h5 {
    font-weight: 600;
    color: #343a40;
    margin-bottom: 20px;
    border-bottom: 2px solid #007bff;
    padding-bottom: 6px;
}

/* Table styles */
#subject_marks_wrapper table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 10px; /* vertical spacing between rows */
}

/* Table header */
#subject_marks_wrapper thead th {
    background-color: #007bff;
    color: white;
    font-weight: 600;
    padding: 0px 17px;
    border-radius: 5px 5px 0 0;
    text-align: left;
}

/* Table body rows */
#subject_marks_wrapper tbody tr {
    background: white;
    box-shadow: 0 2px 5px rgb(0 0 0 / 0.07);
    border-radius: 6px;
}

/* Table cells */
#subject_marks_wrapper tbody td {
    padding: 6px 15px;
    vertical-align: middle;
    font-size: 15px;
    color: #495057;
}

/* Input boxes inside table */
#subject_marks_wrapper tbody input[type="number"] {
    width: 100%;
    padding: 8px 10px;
    font-size: 14px;
    border: 1px solid #ced4da;
    border-radius: 5px;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
}

/* Input focus */
#subject_marks_wrapper tbody input[type="number"]:focus {
    border-color: #80bdff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

/* Responsive fix for small screens */
@media (max-width: 575px) {
    #subject_marks_wrapper thead {
        display: none;
    }

    #subject_marks_wrapper tbody tr {
        display: block;
        margin-bottom: 15px;
        box-shadow: none;
        border-radius: 8px;
        background: #f1f3f5;
        padding: 15px;
    }

    #subject_marks_wrapper tbody td {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        font-size: 14px;
    }

    #subject_marks_wrapper tbody td::before {
        content: attr(data-label);
        font-weight: 600;
        color: #212529;
        flex-basis: 50%;
    }

    #subject_marks_wrapper tbody td input[type="number"] {
        max-width: 120px;
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
            <div class="breadcrumbs-area d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h3>Exam Marks</h3>
                    <ul class="breadcrumb mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li>Exam Marks</li>
                    </ul>
                </div>
                <div class="mt-2 mt-md-0">
                    <button type="button" class="modal-trigger" data-toggle="modal" data-target="#addClassModal">
                        <i class="fas fa-plus-circle mr-2"></i> Create Exam Marks
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table display data-table text-nowrap" id="get_exam">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>Exam</th>
                                <th>Class</th>
                                <th>Student Name</th>
                                <th>Father's Name</th>
                                <th>Subject</th>
                                <th>Total Marks</th>
                                <th>Marks Scored</th>
                                <th>Remarks</th>
                                <th>Actions</th>
                            </tr>

                            </thead>
                            <tbody>
                                <!-- Filled via AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @include('admin.include.footer')
        </div>
        </div>
        <!-- Page Area End Here -->
    </div>
    
    
    <div class="modal fade" id="addClassModal" tabindex="-1" role="dialog" aria-labelledby="addClassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="add_exam_marks" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-plus-circle mr-2"></i> Add Exam Marks</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Select Exam</label>
                        <select class="form-control exam_ids" name="exam_id" id="exam_id">
                            <option value=''>Select Exam</option>
                            @foreach($exam as $ex)
                            <option value='{{ $ex->id }}'>{{ $ex->exam_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Select Class</label>
                        <select class="form-control class_ids" name="class_id" id="class_id">
                            <option value=''>Select Exam Class</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Select Student</label>
                        <select class="form-control select2 student_id" name="student_id" id="student_id">
                            <option value=''>Select Student</option>
                        </select>
                    </div>

                    <div id="subject_marks_wrapper" class="mt-4" >
                        <h5 class="mb-3">Enter Marks</h5>
                        <table class="table table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th>Subject Name</th>
                                    <th>Total Marks</th>
                                    <th>Marks Scored</th>
                                </tr>
                            </thead>
                            <tbody id="subject_marks_body">
                                <!-- Dynamically filled -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="submit" id="submit_button" class="btn btn-primary btn-lg px-4">
                        <span id="btn_text">Save</span>
                        <span id="btn_spinner" class="spinner-border spinner-border-sm d-none"></span>
                    </button>
                    <button type="button" class="btn btn-light btn-lg px-4 mr-3" data-dismiss="modal" style="border: 1px solid #ccc;">
                        <i class="fas fa-times mr-1"></i> Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>






<!-- Add Class Modal -->
<div class="modal fade" id="EditExamModal" tabindex="-1" role="dialog" aria-labelledby="addClassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="update_exam_form" method="POST">
                @csrf
                <input type="hidden" name="id" id="exam_class_id" value="0">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-plus-circle mr-2"></i> Update Exam Marks</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    
                     <div class="form-group">
                        <label for="class_name">Select Exam Class</label>
                        <select class="form-control" name="class_id" id="class_id" >
                            <option value=''>Select Exam Class</option>
                            @foreach($class as $cl)
                            <option value='{{ $cl->id }}'>{{ $cl->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="class_name">Select Exam</label>
                        <select class="form-control" name="exam_id" id="exam_id" >
                            <option value=''>Select Exam</option>
                            @foreach($exam as $ex)
                            <option value='{{ $ex->id }}'>{{ $ex->exam_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                
                
                
                <div class="modal-footer justify-content-center">
                    <button type="submit" id="submit_button" class="btn btn-primary btn-lg px-4">
                        <span id="btn_text">Update</span>
                        <span id="btn_spinner" class="spinner-border spinner-border-sm d-none"></span>
                    </button>
                    <button type="button" class="btn btn-light btn-lg px-4 mr-3" data-dismiss="modal" style="border: 1px solid #ccc;">
                        <i class="fas fa-times mr-1"></i> Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel"><i class="fas fa-exclamation-triangle mr-2"></i> Confirm Deletion</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body text-center">
                <p class="mb-0">Are you sure you want to delete this Exam Class?</p>
                <input type="hidden" id="delete-exam-type-id">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger" id="confirm-delete-btn"><i class="fas fa-trash-alt mr-1"></i> Yes, Delete</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-1"></i> Cancel</button>
            </div>
        </div>
    </div>
</div>



    <!-- jquery-->
    
   <script src="{{ asset('public/admin/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('public/admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/admin/js/main.js') }}"></script>
<script src="{{ asset('public/admin/js/select2.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
    window.addEventListener('load', () => document.getElementById('preloader').style.display = 'none');

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let table = $('#get_exam').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            responsive: true,
            ajax: {
                url: "{{ route('admin.get_exam_marks') }}",
                type: "POST",
                dataFilter: function (data) {
                    let json = jQuery.parseJSON(data);
                    json.recordsTotal = json.recordsTotal;
                    json.recordsFiltered = json.recordsFiltered;
                    return JSON.stringify(json);
                }
            },
            order: [[0, 'desc']],
            columns: [
                { data: 0 },
                { data: 1 },
                { data: 2 },
                { data: 3 },
                { data: 4 },
                { data: 5 },
                { data: 6 },
                { data: 7 },
                { data: 8 },
                { data: 9, orderable: false, searchable: false }
            ]
        });
        
        
        $('#add_exam_marks').on('submit', function (e) {
            e.preventDefault();
            let fd = new FormData(this);

            $('#submit_button').prop('disabled', true);
            $('#btn_text').text('Saving...');
            $('#btn_spinner').removeClass('d-none');

            $.ajax({
                url: "{{ route('admin.save_exam_marks') }}",
                type: "POST",
                data: fd,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (result) {
                    if (result.status) {
                        toastr.success(result.msg);
                        $('#addClassModal').modal('hide');
                        $('#add_exam_marks')[0].reset();
                        table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                },
                complete: function () {
                    $('#btn_text').text('Save Exam');
                    $('#btn_spinner').addClass('d-none');
                    $('#submit_button').prop('disabled', false);
                },
                error: function () {
                    toastr.error("Something went wrong. Please try again.");
                }
            });
        });
        
        
        
        $('#update_exam_form').on('submit', function (e) {
            e.preventDefault();
            let fd = new FormData(this);

            $('#submit_button').prop('disabled', true);
            $('#btn_text').text('Saving...');
            $('#btn_spinner').removeClass('d-none');

            $.ajax({
                url: "{{ route('admin.update_exam_class') }}",
                type: "POST",
                data: fd,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (result) {
                    if (result.status) {
                        toastr.success(result.msg);
                        $('#EditExamModal').modal('hide');
                        $('#update_exam_form')[0].reset();
                        table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                },
                complete: function () {
                    $('#btn_text').text('Update Exam');
                    $('#btn_spinner').addClass('d-none');
                    $('#submit_button').prop('disabled', false);
                },
                error: function () {
                    toastr.error("Something went wrong. Please try again.");
                }
            });
        });
        
        
        
         // Show Delete Modal
        $(document).on('click', '.delete-btn', function () {
            let id = $(this).data('id');
            $('#delete-exam-type-id').val(id);
            $('#deleteConfirmModal').modal('show');
        });
        
        
        // Show Delete Modal
        $(document).on('click', '#update_exam_class', function () {
            let id = $(this).data('id');
            let class_id = $(this).data('class_id');
            let exam_id = $(this).data('exam_id');
            
            
            $('#exam_class_id').val(id);
            $('#class_id').val(class_id);
            $('#exam_id').val(exam_id);
            
            $('#EditExamModal').modal('show');
        });

        // Confirm Delete
        $('#confirm-delete-btn').on('click', function () {
            let id = $('#delete-exam-type-id').val();
            
            $.ajax({
                url: "{{ route('admin.delete_exam_classes') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function (response) {
                    if (response.status) {
                        toastr.success(response.msg);
                        $('#deleteConfirmModal').modal('hide');
                        table.ajax.reload();
                    } else {
                        toastr.error(response.msg);
                    }
                },
                error: function () {
                    toastr.error('Something went wrong!');
                }
            });
        });
        
        
        // Section fetch based on class selection
       $('#exam_id').on('change', function () {
        var exam_id = $(this).val();

        var form = new FormData();
        form.append("exam_id", exam_id);

        $.ajax({
            url: "{{ route('admin.get_classe_data') }}",
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
                    var $sectionDropdown = $('#class_id');
                    $sectionDropdown.empty();
                    $sectionDropdown.append('<option value="">Please Select Class *</option>');
                    $.each(result.data, function (index, section) {
                        $sectionDropdown.append('<option value="' + section.class_id + '">' + section.className + '</option>');
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
    
    
    
    // Section fetch based on class selection
       $('#class_id').on('change', function () {
        var class_id = $(this).val();

        var form = new FormData();
        form.append("class_id", class_id);

        $.ajax({
            url: "{{ route('admin.get_student_data') }}",
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
                    var $sectionDropdown = $('#student_id');
                    $sectionDropdown.empty();
                    $sectionDropdown.append('<option value="">Please Select Student *</option>');
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
    
    
    
    
$(document).ready(function() {
    $('#student_id').select2({
        dropdownParent: $('#addClassModal'), // ✅ Correct modal
        width: '100%',
        placeholder: "Select Student",
        allowClear: true
    });
});




$('#student_id').on('change', function () {
    let student_id = $(this).val();
    let class_id = $('#class_id').val();

    if (!student_id || !class_id) {
        toastr.error("Please select both class and student.");
        return;
    }

    $.ajax({
        url: "{{ route('admin.get_student_subjects') }}", // You need to create this route
        type: "POST",
        data: {
            _token: '{{ csrf_token() }}',
            student_id: student_id,
            class_id: class_id
        },
        success: function (response) {
            if (response.status) {
                let tbody = '';
                $.each(response.data, function (index, subject) {
                    tbody += `
                        <tr>
                            <td>
                                ${subject.subjectName}
                                <input type="hidden" name="subjects_id[]" value="${subject.id}">
                            </td>
                            <td>
                            ${subject.max_marks}
                                <input type="hidden" name="max_marks[]" value="${subject.max_marks || 100}" required>
                            </td>
                            <td>
                                <input type="number" class="form-control" name="marks_scored[]" required>
                            </td>
                        </tr>
                    `;
                });

                $('#subject_marks_body').html(tbody);
                $('#subject_marks_wrapper').show();
            } else {
                toastr.error(response.msg);
                $('#subject_marks_wrapper').hide();
                $('#subject_marks_body').html('');
            }
        },
        error: function () {
            toastr.error("Something went wrong.");
        }
    });
});



        
    });
</script>


</body>

</html>