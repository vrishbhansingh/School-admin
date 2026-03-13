<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Student Registration Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            background: #e9f1fb;
            font-family: 'Poppins', sans-serif;
            color: #2c3e50;
        }
        .invoice-wrapper {
            max-width: 820px;
            margin: 40px auto;
            background: #fff;
            padding: 30px 40px;
            box-shadow: 0 6px 24px rgba(0,0,0,0.08);
            border-radius: 12px;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .invoice-header img {
            max-width: 215px;
            margin-bottom: -51px;
        }
        .invoice-header h1 {
            margin: 0;
            font-size: 26px;
            color: #1a3c67;
        }
        .invoice-header p {
            margin: 4px 0 0;
            font-size: 14px;
            color: #777;
        }
        .invoice-body .row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .invoice-body .col {
            flex: 1 1 50%;
            margin-bottom: 20px;
        }
        .invoice-body .label {
            font-weight: 600;
            font-size: 14px;
            color: #555;
        }
        .invoice-body .value {
            font-size: 16px;
            margin-top: 4px;
            color: #1a1a1a;
        }
        .invoice-footer {
            text-align: center;
            margin-top: 30px;
        }
        .btn-print {
            display: inline-block;
            padding: 10px 24px;
            background: #1a5697;
            color: #fff;
            font-size: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .btn-print:hover {
            background: #154779;
        }

        @media print {
            .btn-print { display: none; }
            body { background: #fff; }
            .invoice-wrapper {
                box-shadow: none;
                margin: 0;
                border-radius: 0;
            }
        }
    </style>
</head>
<body>

    <div class="invoice-wrapper">
        <div class="invoice-header">
            <img src="{{ asset('public/'.Auth::guard('admin')->user()->logo.'') }}" alt="School Logo">
            <h1>{{ $school->name }}</h1>
            <p>Student Registration Invoice</p>
        </div>

        <div class="invoice-body">
            <div class="row">
                <div class="col">
                    <div class="label">Registration No.</div>
                    <div class="value">{{ 'STRG' . str_pad($student->reg_no, 3, '0', STR_PAD_LEFT) }}</div>
                </div>
                <div class="col">
                    <div class="label">Registration Date</div>
                    <div class="value">{{ \Carbon\Carbon::parse($student->reg_date)->format('d-M-Y') }}</div>
                </div>
                <div class="col">
                    <div class="label">Student Name</div>
                    <div class="value">{{ $student->first_name }} {{ $student->last_name }}</div>
                </div>
                <div class="col">
                    <div class="label">Gender / DOB</div>
                    <div class="value">{{ ucfirst($student->gender) }} / {{ \Carbon\Carbon::parse($student->dob)->format('d-M-Y') }}</div>
                </div>
                <div class="col">
                    <div class="label">Class & Section</div>
                    <div class="value">{{ $Cclass->name }} – {{ $Ssec->name }}</div>
                </div>
                <div class="col">
                    <div class="label">Aadhar Number</div>
                    <div class="value">{{ $student->aadhar_number ?: '-' }}</div>
                </div>
                <div class="col">
                    <div class="label">Phone / Email</div>
                    <div class="value">{{ $student->phone }} / {{ $student->email }}</div>
                </div>
                <div class="col">
                    <div class="label">Address</div>
                    <div class="value">{{ $student->address }}, {{ $student->city }}, {{ $student->state }} – {{ $student->pincode }}</div>
                </div>
                <div class="col">
                    <div class="label">Registration Amount</div>
                    <div class="value">₹ {{ number_format($student->reg_amount, 2) }}</div>
                </div>
                <div class="col">
                    <div class="label">Reference</div>
                    <div class="value">{{ $student->reference }}</div>
                </div>
            </div>
        </div>

        <div class="invoice-footer">
            <button onclick="window.print()" class="btn-print">Print Invoice</button>
        </div>
    </div>

    <script>
        // Auto print after short delay
        /*window.onload = function () {
            setTimeout(() => {
                window.print();
            }, 800);
        };*/

        // Go back on cancel (ESC key or after print dialog is closed)
        window.onafterprint = function () {
            window.history.back();
        };

        // Backup: Go back if user presses Escape
        document.addEventListener("keydown", function(e) {
            if (e.key === "Escape") {
                window.history.back();
            }
        });
    </script>
</body>
</html>
