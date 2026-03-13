<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Parents List - Tech Web Mantra</title>
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
                        <h3>Parents List</h3>
                        <ul class="breadcrumb mb-0">
                            <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li>All Parents</li>
                        </ul>
                    </div>

                    <!-- Buttons container with flexbox -->
                    <div class="button-container mt-2 mt-md-0">
                        <a href="{{ route('admin.add_parent') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus-circle mr-2"></i> Add Parents
                        </a>
                        
                        
                    </div>
                </div>

                <!-- Student Table Card -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table display data-table text-nowrap" id="parent_list">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Gender</th>
                                        <th>Address</th>
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

            $('#parent_list').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 10,
                ajax: {
                    url: "{{ route('admin.get_parent_list') }}",
                    type: "POST",
                    dataFilter: function (data) {
                        let json = jQuery.parseJSON(data);
                        json.recordsTotal = json.recordsTotal;
                        json.recordsFiltered = json.recordsFiltered;
                        json.data = json.data.map(function (row, index) {
                            
                            return row;
                        });
                        return JSON.stringify(json);
                    }
                },
                order: [[0, 'desc']],
                columns: [
                    { data: 0, name: 'id' },
                    { data: 1, name: 'photo' },
                    { data: 2, name: 'name' },
                    { data: 3, name: 'email' },
                    { data: 4, name: 'phone' },
                    { data: 5, name: 'gender' },
                    { data: 6, name: 'address' },
                    
                ]
            });
        });
        
        
        
    </script>
    
    
    
</body>

</html>
