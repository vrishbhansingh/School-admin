<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Student Pays Fees - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('public/admin/img/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/fonts/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8fafc; }
        .breadcrumbs-area { padding: 25px 0; margin-bottom: 25px; border-bottom: 2px solid #e3e6f0; }
        .breadcrumbs-area h3 { font-weight: 600; color: #343a40; }
        .card { background: #fff; border: none; border-radius: 10px; padding: 25px; box-shadow: 0 2px 15px rgba(0,0,0,0.05); }
        table.dataTable thead th { background-color: #1a5697; font-weight: 600; color: #fff !important; text-align: center; }
        table.dataTable tbody td { text-align: center; }
        .modal-footer .btn { font-size: 16px; padding: 10px 20px; border-radius: 8px; }
        .modal-title { color: #ffffff; }
        .modal-header.bg-primary { background-color: #1d6198 !important; }
        button.modal-trigger { background-color: #1a5697; color: white; font-weight: 500; padding: 10px 16px; border-radius: 6px; border: none; }
        button.modal-trigger:hover { background-color: #154c86; }
        #preloader { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: #fff; z-index: 9999; }
        #preloader::after {
            content: ""; display: block; width: 50px; height: 50px;
            margin: 20% auto; border: 5px solid #f3f3f3;
            border-top: 5px solid #1a5697; border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        @media (max-width: 767px) {
            .card { padding: 15px; }
            .dataTables_wrapper .dataTables_filter { text-align: left; margin-bottom: 15px; }
        }
        
        .btn-warning {
    color: #ffffff !important;
    background-color: #06950c !important;
    border-color: #0b610e !important;
}
        
        
        .badge-status {
            padding: 2px 11px;
            border-radius: 2px;
            font-weight: 500;
            font-size: 13px;
        }
        .badge-active { background-color: #28a745; color: white; }
        .badge-inactive { background-color: #dc3545; color: white; }

        .btn-icon-sm {
            padding: 0px 18px;
            font-size: 14px;
            border-radius: 4px;
            margin: 0 2px;
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
                    <h3>Student Pays Fees</h3>
                    <ul class="breadcrumb mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li>Student Pays Fees</li>
                    </ul>
                </div>
                <div class="mt-2 mt-md-0">
                    <button type="button" class="modal-trigger" data-toggle="modal" data-target="#sign-up">
                        <i class="fas fa-plus-circle mr-2"></i> Add Student Pays Fees
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table display data-table text-nowrap" id="student_addmission_list">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Receipt No</th>
                                    <th>Student Name</th>
                                    <th>Class / Section</th>
                                    <th>Payment Mode</th>
                                    <th>Paid Amount</th>
                                    <th>Fee Amount</th>
                                    <th>Action</th>
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

<!-- Fee Setting Modal -->
<!-- Modal -->
<div class="modal fade" id="sign-up" tabindex="-1" role="dialog" aria-labelledby="feeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <form id="add_student_payment" method="POST">
        @csrf
        <div class="modal-header" style="background-color: #f8f9fa;">
          <h5 class="modal-title fw-bold" style="font-size: 20px; color: #333;">
            Add Student Pays Fees
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span style="font-size: 24px;">&times;</span>
          </button>
        </div>



        <div class="modal-body">
            
            <div class="form-group">
            <label for="student_id">Select Class</label>
            <select class="form-control select2" name="class_id" id="class_id" required>
              <option value="">Select Class</option>
              @foreach($fees as $cl)
                <option value="{{ $cl->class_id }}">{{ $cl->class_name }}</option>
              @endforeach
            </select>
          </div>
            
          <div class="form-group">
            <label for="student_id">Select Student</label>
            <select class="form-control select2" name="student_id" id="student_id" required>
              <option value="">Select Student</option>
            </select>
          </div>

          <div class="form-group">
            <label for="amount">Due Amount (₹)</label>
              <input type="number" class="form-control" name="due_amount"  id="due_amount" required min="0" step="0.01" readonly placeholder="Due amount">
          </div>
          
             <div class="form-group ">
              <label for="amount">Pay Amount (₹)</label>
              <input type="number" class="form-control" name="amount" id="pay_amount" required min="0" step="0.01"  placeholder="Enter amount">
            </div>

          <div class="form-group ">
            <select class="form-control select2" name="payment_mode" id="payment_mode" required>
              <option value="">Select Payment Mode</option>
              <option value="Cash">Cash</option>
              <option value="Cheque">Cheque</option>
              <option value="UPI">UPI</option>
              <option value="Net Banking">Net Banking</option>
              <option value="Card">Card</option>
              
            </select>
          </div>
          
          <div class="form-group ">
              <label for="amount">Payment Date</label>
              <input type="date" class="form-control" name="date" id="pay_date" value="{{ date('Y-m-d') }}" required   placeholder="DD-MM-YYYY">
            </div>

         
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
                <p class="mb-0">Are you sure you want to delete this Fee Setting?</p>
                <input type="hidden" id="delete-fee-type-id">
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger" id="confirm-delete-btn"><i class="fas fa-trash-alt mr-1"></i> Yes, Delete</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-1"></i> Cancel</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('public/admin/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('public/admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/admin/js/select2.min.js') }}"></script>
<script src="{{ asset('public/admin/js/main.js') }}"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    window.addEventListener('load', () => document.getElementById('preloader').style.display = 'none');
    
    $('#sign-up').on('shown.bs.modal', function () {
    $('#student_id').select2({
        dropdownParent: $('#sign-up'),
        width: '100%',
        placeholder: "Select Student",
        allowClear: true
    });
    
     $('#fees_type').select2({
        dropdownParent: $('#sign-up'),
        width: '100%',
        placeholder: "Select Fees Code",
        allowClear: true
    });
    
});

    

    $(document).ready(function () {
        
        
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        let table = $('#student_addmission_list').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.get_student_payment_list') }}",
                type: "POST",
                dataFilter: function (data) {
                    let json = jQuery.parseJSON(data);
                    
                    
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
        
        
        
        

        $('#add_student_payment').on('submit', function (e) {
    e.preventDefault();

    let due_amount = parseFloat($('#due_amount').val()) || 0;
    let pay_amount = parseFloat($('#pay_amount').val()) || 0;

    if (pay_amount > due_amount) {
        toastr.error('Please enter correct total pay amount!');
        return;
    }

    let fd = new FormData(this);

    $('#submit-button').prop('disabled', true);
    $('#btn-text').text('Saving...');
    $('#btn-spinner').removeClass('d-none');

    $.ajax({
        url: "{{ route('admin.add_student_payment') }}",
        type: "POST",
        data: fd,
        dataType: 'json',
        processData: false,
        contentType: false,

        success: function (result) {
            if (result.status) {
                toastr.success(result.msg);
                $('#sign-up').modal('hide');
                $('#add_student_payment')[0].reset();

                // Wait for modal to hide before reloading DataTable
                setTimeout(function () {
                    $('#student_addmission_list').DataTable().ajax.reload(null, false);
                }, 500);
            } else {
                toastr.error(result.msg);
            }
        },
        complete: function () {
            $('#btn-text').text('Save Fee Setting');
            $('#btn-spinner').addClass('d-none');
            $('#submit-button').prop('disabled', false);
        },
        error: function () {
            toastr.error("Something went wrong. Please try again.");
        }
    });
});


        // Handle Edit
        $(document).on('click', '.edit-btn', function () {
            let id = $(this).data('id');
            // Load and open modal here
            alert("Edit ID: " + id); // placeholder
        });
        
        // Show Delete Modal
        $(document).on('click', '.delete-btn', function () {
            let id = $(this).data('id');
            $('#delete-fee-type-id').val(id);
            $('#deleteConfirmModal').modal('show');
        });
        
        $('#confirm-delete-btn').on('click', function () {
            let id = $('#delete-fee-type-id').val();

          
            $.ajax({
                url: "{{ route('admin.delete_student_fee') }}",
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
        
        
        $('#class_id').on('change', function () {
        var class_id = $(this).val();

        var form = new FormData();
        form.append("class_id", class_id);

        $.ajax({
            url: "{{ route('admin.get_student_fee_data') }}",
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
                    $.each(result.data, function (index, student) {
                        $sectionDropdown.append('<option value="' + student.id + '">' + student.name + ' (' + student.father_name + ')</option>');
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
        
        
        $('#student_id').on('change', function () {
            let id = $('#student_id').val();

           
            $.ajax({
                url: "{{ route('admin.get_student_due_amount') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function (response) {
                    if (response.status) {
                        
                        $('#due_amount').val(response.balance_amt);
                    } else {
                        toastr.error(response.msg);
                    }
                },
                error: function () {
                    toastr.error('Something went wrong!');
                }
            });
        });

        
    });
</script>
</body>
</html>
