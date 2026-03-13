<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Students Registration List - Tech Web Mantra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

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

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            color: #333;
        }

        .breadcrumbs-area {
            padding: 25px 0;
            margin-bottom: 25px;
            border-bottom: 2px solid #e3e6f0;
        }

        .breadcrumbs-area h3 {
            font-weight: 600;
            color: #343a40;
        }

        .card {
            background: #fff;
            border: none;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
        }

        table.dataTable thead th {
            background-color: #1a5697;
            font-weight: 600;
            color: #fff !important;
            text-align: center;
        }

        table.dataTable tbody td {
            text-align: center;
        }

        .dataTables_wrapper .dataTables_filter input {
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .dataTables_wrapper .dataTables_filter input:focus,
        .dataTables_wrapper .dataTables_filter input:hover {
            outline: none !important;
            box-shadow: none !important;
            border-color: #ccc !important;
        }

        .dataTables_wrapper .dataTables_length select {
            border-radius: 6px;
            padding: 6px;
        }

        table.dataTable tbody tr:hover {
            background-color: #f9fbfd;
            transition: background-color 0.3s;
        }

        th, td {
            vertical-align: middle !important;
            font-size: 14px;
        }

        .print-icon {
            color: #007bff;
            font-size: 18px;
            cursor: pointer;
        }

        .print-icon:hover {
            color: #0056b3;
        }

        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fff;
            z-index: 9999;
        }

        #preloader::after {
            content: "";
            display: block;
            width: 50px;
            height: 50px;
            margin: 20% auto;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #007bff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @media (max-width: 767px) {
            .card {
                padding: 15px;
            }

            .dataTables_wrapper .dataTables_filter {
                text-align: left;
                margin-bottom: 15px;
            }
        }
        
        .card-body {
    padding: 0px 0px 0px;
    background-color: #ffffff;
    border-radius: 4px;
    -webkit-box-shadow: 0px 10px 20px 0px rgba(229, 229, 229, 0.75);
    box-shadow: 0px 10px 20px 0px rgba(229, 229, 229, 0.75);
   }
   
   
   @media (max-width: 767px) {
    .action-btns .btn {
        font-size: 12px;
        padding: 5px 10px;
    }
    }
    
    @media (max-width: 767px) {
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    table.dataTable {
        width: 100% !important;
    }

    table.dataTable td,
    table.dataTable th {
        white-space: nowrap;
    }
}


    </style>
</head>

<body>
<div id="preloader"></div>

<div id="wrapper" class="wrapper bg-ash">
    @include('admin.include.header')
    <div class="dashboard-page-one">
        @include('admin.include.sidebar')
        <div class="dashboard-content-one container-fluid py-4">

            <!-- Breadcrumb + Button -->
            <div class="breadcrumbs-area d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h3>Students Registration List</h3>
                    <ul class="breadcrumb mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li>Students Registration List</li>
                    </ul>
                </div>
                <div class="mt-2 mt-md-0">
                    <a href="{{ route('admin.student_registration') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus-circle mr-2"></i> Add Student Registration
                    </a>
                </div>
            </div>

            <!-- Table -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="student_registration_list" class="table display data-table text-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Reg. Date</th>
                                    <th>Registration No.</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>DOB</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Pincode</th>
                                    <th>Aadhar No.</th>
                                    <th>Reg. Amount</th>

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

<!-- Scripts -->
<script src="{{ asset('public/admin/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/main.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

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

        $('#student_registration_list').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            ajax: {
                url: "{{ route('admin.get_student_registration_list') }}",
                type: "POST",
                dataFilter: function (data) {
                    let json = jQuery.parseJSON(data);
                    json.recordsTotal = json.recordsTotal;
                    json.recordsFiltered = json.recordsFiltered;
                    json.data = json.data.map(function (row, index) {
                        // Add print button column
                        row[14] = `<a href="/admin/print-registration/${row[2]}" target="_blank" class="print-icon" title="Print">
                                    <i class="fas fa-print"></i>
                                   </a>`;
                        return row;
                    });
                    return JSON.stringify(json);
                }
            },
            order: [[0, 'desc']],
            columns: [
                    { data: 0, name: 'id' },
                    { data: 1, name: 'reg_date' },
                    { data: 2, name: 'reg_no' },
                    { data: 3, name: 'first_name' },
                    { data: 4, name: 'phone' },
                    { data: 5, name: 'email' },
                    { data: 6, name: 'gender' },
                    { data: 7, name: 'dob' },
                    { data: 8, name: 'address' },
                    { data: 9, name: 'city' },
                    { data: 10, name: 'state' },
                    { data: 11, name: 'pincode' },
                    { data: 12, name: 'aadhar_number' },
                    { data: 13, name: 'reg_amount' }
                ]
            });
        });
    </script>
</body>
</html>
