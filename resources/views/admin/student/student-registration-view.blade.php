<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Student Details - Tech Web Mantra</title>
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
    

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f7fc;
            color: #333;
        }

        .container {
            max-width: 1080px;
            margin-top: 40px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
            padding: 25px;
            height: 90%;
        }

        h2 {
            font-weight: 600;
            color: #1a3c67;
        }

        .detail-row {
            margin-bottom: 16px;
        }

        .label {
            font-weight: 500;
            color: #555;
            font-size: 13px;
        }

        .value {
            font-size: 15px;
            font-weight: 600;
            color: #111;
        }

        .btn-custom {
            font-size: 13px;
            padding: 6px 14px;
            border-radius: 5px;
            font-weight: 500;
        }

        .btn-primary {
            background-color: #1a5697;
            border: none;
        }

        .btn-primary:hover {
            background-color: #17487f;
        }

        .btn-info {
            background-color: #17a2b8;
            border: none;
        }

        .btn-info:hover {
            background-color: #138a9c;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #565e64;
        }

        .top-bar {
            margin-bottom: 0px;
        }

        @media (max-width: 768px) {
            .detail-row {
                margin-bottom: 12px;
            }

            .top-bar {
                flex-direction: column;
                align-items: flex-start;
            }

            .top-bar a {
                margin-top: 12px;
            }
        }
    </style>
</head>

<body>
    @include('admin.include.header')
    <div class="dashboard-page-one">
        @include('admin.include.sidebar')

        <div class="container">
            <div class="top-bar d-flex justify-content-between align-items-center flex-wrap px-2 py-3 rounded shadow-sm bg-white mb-4">
    <a href="{{ route('admin.student_registration_list') }}" class="btn btn-secondary btn-custom d-flex align-items-center" >
        <i class="fas fa-arrow-left mr-2"></i> Back to List
    </a>

    <h2 class="text-center mb-0 text-primary font-weight-bold flex-grow-1" style="font-size: 22px;">Student Registration Details</h2>

    <a href="{{ route('admin.print_student_registration', [base64_encode($student->id)]) }}" class="btn btn-primary btn-custom d-flex align-items-center">
        <i class="fas fa-print mr-2"></i> Print
    </a>
</div>



            <div class="card">
                <div class="row">
                    @php
                        $fields = [
                            'Registration No.' => 'STRG' . str_pad($student->reg_no, 3, '0', STR_PAD_LEFT),
                            'Registration Date' => \Carbon\Carbon::parse($student->reg_date)->format('d-M-Y'),
                            'First Name' => $student->first_name,
                            'Last Name' => $student->last_name,
                            'Gender' => ucfirst($student->gender),
                            'Date of Birth' => \Carbon\Carbon::parse($student->dob)->format('d-M-Y'),
                            'Phone' => $student->phone,
                            'Email' => $student->email,
                            'Aadhar Number' => $student->aadhar_number,
                            'Address' => $student->address,
                            'City' => $student->city,
                            'State' => $student->state,
                            'Pincode' => $student->pincode,
                            'Reference' => $student->reference,
                            'Class' => $Cclass->name,
                            'Section' => $Ssec->name,
                            
                            'Registration Amount' => '₹ ' . number_format($student->reg_amount, 2),
                        ];
                    @endphp

                    @foreach($fields as $label => $value)
                        <div class="col-md-6 detail-row">
                            <div class="label">{{ $label }}</div>
                            <div class="value">{{ $value ?: '-' }}</div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4 text-center">
                    <a href="{{ route('admin.print_student_registration', [base64_encode($student->id)]) }}" class="btn btn-primary btn-custom">
                        <i class="fas fa-print mr-1"></i> Print
                    </a>
                    
                </div>
            </div>
        </div>
    </div>

    @include('admin.include.footer')

    <!-- Scripts -->
    <script src="{{ asset('public/admin/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('public/admin/js/popper.min.js') }}"></script>
<script src="{{ asset('public/admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/admin/js/plugins.js') }}"></script>
<script src="{{ asset('public/admin/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('public/admin/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/admin/js/main.js') }}"></script>
</body>
</html>
