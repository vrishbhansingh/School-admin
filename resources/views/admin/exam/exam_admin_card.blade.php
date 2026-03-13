<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Admin Card - Tech Web Mantra</title>
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
            
            /* Admit Card Button */
/* Universal Button Style */
.btn-action {
    padding: 6px 14px;
    font-size: 13px;
    font-weight: 500;
    border-radius: 6px;
    display: flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
    color: #fff;
    transition: all 0.3s ease;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

/* Edit Button */
.btn-action.edit {
    background: #28a745;
}
.btn-action.edit:hover {
    background: #1e7e34;
}

/* ID Card Button */
.btn-action.id-card {
    background: #5a4db2;
}
.btn-action.id-card:hover {
    background: #402ea0;
}

/* Admit Card Button */
.btn-action.admit-card {
    background: #ff5722;
}
.btn-action.admit-card:hover {
    background: #e64a19;
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
                    <h3>Exam Subjects</h3>
                    <ul class="breadcrumb mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li>Exam Subjects</li>
                    </ul>
                </div>
                <div class="mt-2 mt-md-0">
                    <button type="button" class="modal-trigger" data-toggle="modal" data-target="#addClassModal">
                        <i class="fas fa-plus-circle mr-2"></i> Create Admin Card
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
                                    <th>Exam Name</th>
                                    <th>Class Name</th>
                                    <th>Student Name</th>
                                    <th>Father Name</th>
                                    <th>Phone</th>
                                    <th>Roll No</th>
                                    <th>Issue Date</th>
                                    <th>Action</th>
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
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="generate_admit_card" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-plus-circle mr-2"></i> Create Admin Card</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    
                    
                    <div class="form-group">
                        <label for="class_name">Select Exam</label>
                        <select class="form-control exam_ids" name="exam_id" id="exam_id" >
                            <option value=''>Select Exam</option>
                            @foreach($exam as $ex)
                            <option value='{{ $ex->id }}'>{{ $ex->exam_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="class_name">Select Class</label>
                        <select class="form-control class_ids" name="class_id" id="class_id" >
                            <option value=''>Select Exam Class</option>
                            
                        </select>
                    </div>
                    
                    
                    
                    
                <div class="modal-footer justify-content-center">
                    <button type="submit" id="submit_button" class="btn btn-primary btn-lg px-4">
                        <span id="btn_text">Generate Now</span>
                        <span id="btn_spinner" class="spinner-border spinner-border-sm d-none"></span>
                    </button>
                    <button type="button" class="btn btn-light btn-lg px-4 mr-3" data-dismiss="modal" style="border: 1px solid #ccc;">
                        <i class="fas fa-times mr-1"></i> Cancel
                    </button>
                </div>
            
        </div>
        </form>
    </div>
</div>
</div>



    <!-- jquery-->
    
   <script src="{{ asset('public/admin/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('public/admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/admin/js/main.js') }}"></script>
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
                url: "{{ route('admin.get_exam_admin_card') }}",
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
                { data: 8, orderable: false, searchable: false }
            ]
        });
        
        
        $('#generate_admit_card').on('submit', function (e) {
            e.preventDefault();
            let fd = new FormData(this);

            $('#submit_button').prop('disabled', true);
            $('#btn_text').text('Saving...');
            $('#btn_spinner').removeClass('d-none');

            $.ajax({
                url: "{{ route('admin.generate_admit_card') }}",
                type: "POST",
                data: fd,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (result) {
                    if (result.status) {
                        toastr.success(result.msg);
                        $('#addClassModal').modal('hide');
                        $('#generate_admit_card')[0].reset();
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
        
        
        
        $('#update_exam_subject_data').on('submit', function (e) {
            e.preventDefault();
            let fd = new FormData(this);

            $('#submit_button').prop('disabled', true);
            $('#btn_text').text('Saving...');
            $('#btn_spinner').removeClass('d-none');

            $.ajax({
                url: "{{ route('admin.update_exam_subject') }}",
                type: "POST",
                data: fd,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (result) {
                    if (result.status) {
                        toastr.success(result.msg);
                        $('#EditExamModal').modal('hide');
                        $('#update_exam_subject_data')[0].reset();
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
       $('#exam_ids').on('change', function () {
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
                    var $sectionDropdown = $('#class_ids');
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

        
    });
</script>


</body>

</html>