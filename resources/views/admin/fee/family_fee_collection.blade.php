<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Family Fee Collection - Tech Web Mantra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/twm_fav.png') }}">

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

    <style>
        body { font-family: 'Poppins', sans-serif; background: #f5f5f5; }
        .card { box-shadow: 0 3px 10px rgba(0,0,0,0.1); border-radius: 10px; }
        .btn-fill-lg { border-radius: 6px; }
    </style>
</head>

<body>
<div id="wrapper" class="wrapper bg-ash">
    @include('admin.include.header')
    <div class="dashboard-page-one">
        @include('admin.include.sidebar')

        <div class="dashboard-content-one">
            <div class="breadcrumbs-area">
                <h3>Family Fee Collection</h3>
                <ul>
                    <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li>Family Fee Collection</li>
                </ul>
            </div>

            <!-- SEARCH SECTION -->
            <div class="card height-auto mb-4">
                <div class="card-body">
                    <h4 class="mb-3">🔍 Search Family Due Fees by Parent Mobile</h4>
                    <div class="row align-items-end">
                        <div class="col-xl-4 col-lg-6 col-12 form-group">
                            <label>Parent Mobile Number *</label>
                            <input type="text" id="search_mobile" placeholder="Enter Parent Mobile" class="form-control">
                        </div>
                        <div class="col-xl-2 col-lg-3 col-12 form-group">
                            <button id="search_btn" type="button" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">
                                Search
                            </button>
                        </div>
                    </div>

                    <div id="search_result" class="mt-4" style="display:none;">
                        <h5>Family Students & Due Fees</h5>
                        <table class="table table-bordered mt-3">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Student Name</th>
                                    <th>Class</th>
                                    <th>Total Fees</th>
                                    <th>Paid</th>
                                    <th>Due</th>
                                </tr>
                            </thead>
                            <tbody id="result_body"></tbody>
                        </table>

                        <div class="mt-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <label><strong>Total Family Due</strong></label>
                                    <input type="text" id="total_due" class="form-control" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label><strong>Discount</strong></label>
                                    <input type="number" id="discount" value="0" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label><strong>Final Payable Amount</strong></label>
                                    <input type="text" id="final_amount" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button id="make_payment" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark mt-2">
                                    💰 Make Payment
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.include.footer')
        </div>
    </div>
</div>

<!-- JS FILES -->
<script src="{{ asset('public/admin/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/plugins.js') }}"></script>
    <script src="{{ asset('public/admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
        window.addEventListener('load', function () {
            document.getElementById('preloader').style.display = 'none';
        });
    </script>

    <script>
    function printProfileCard() {
        window.print();
    }
</script>


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



$(document).ready(function() {
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    // 🔍 Search Parent by Mobile
    $('#search_btn').click(function() {
        let mobile = $('#search_mobile').val().trim();
        if (mobile === '') return toastr.warning('Please enter mobile number');

        $('#search_btn').prop('disabled', true).text('Searching...');

        $.ajax({
            url: "{{ route('admin.search_parent_due') }}",
            type: "POST",
            data: { mobile },
            dataType: 'json',
            success: function(res) {
                if (res.status) {
                    let html = '', total = 0;
                    res.data.forEach((st, i) => {
                        html += `<tr>
                            <td>${i+1}</td>
                            <td>${st.student_name}</td>
                            <td>${st.class_name}</td>
                            <td>${st.total_fee}</td>
                            <td>${st.paid_fee}</td>
                            <td><strong>${st.due_fee}</strong></td>
                        </tr>`;
                        total += parseFloat(st.due_fee);
                    });
                    $('#result_body').html(html);
                    $('#total_due').val(total);
                    $('#final_amount').val(total.toFixed(2));
                    $('#discount').val(0);
                    $('#search_result').show();
                    toastr.success('Family dues loaded successfully');
                } else {
                    toastr.error(res.msg);
                    $('#search_result').hide();
                }
            },
            complete: function() {
                $('#search_btn').prop('disabled', false).text('Search');
            },
            error: function() { toastr.error("Server error"); }
        });
    });

    // 🎯 Discount Update Live
    $('#discount').on('input', function() {
        let total = parseFloat($('#total_due').val()) || 0;
        let discount = parseFloat($(this).val()) || 0;
        if (discount > total) {
            toastr.warning("Discount cannot exceed total due");
            $(this).val(total);
            discount = total;
        }
        $('#final_amount').val((total - discount).toFixed(2));
    });

    // 💰 Make Payment
    $('#make_payment').click(function() {
        let data = {
            mobile: $('#search_mobile').val(),
            total_due: $('#total_due').val(),
            discount: $('#discount').val(),
            payable: $('#final_amount').val()
        };

        if (data.mobile === '' || data.payable <= 0)
            return toastr.error('Search parent first');

        $('#make_payment').prop('disabled', true).text('Processing...');

        $.ajax({
            url: "{{ route('admin.family_fee_payment') }}",
            type: "POST",
            data: data,
            dataType: 'json',
            success: function(res) {
                if (res.status) {
                    toastr.success(res.msg);
                    $('#search_result').hide();
                    $('#search_mobile').val('');
                } else toastr.error(res.msg);
            },
            complete: function() {
                $('#make_payment').prop('disabled', false).text('💰 Make Payment');
            },
            error: function() { toastr.error('Something went wrong'); }
        });
    });
});
</script>
</body>
</html>




