<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Fee Receipt</title>
<style>
    /* Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        font-family: 'Segoe UI', Tahoma, sans-serif;
        background: #fff;
        padding: 20px;
        color: #333;
    }
    .receipt-container {
        width: 850px;
        margin: auto;
        border: 1px solid #444;
        padding: 20px 25px;
        background: #fff;
    }
    /* Header */
    .header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 2px solid #333;
    padding-bottom: 10px;
    gap: 15px;  /* Extra space */
}
    .header .logo img {
    width: 130px;       /* Increased size */
    height: auto;
    border-radius: 6px; /* Slight rounded corners */
  /*  box-shadow: 0 3px 6px rgba(0,0,0,0.2);  Adds depth */
}

    .header .school-info {
        text-align: center;
        flex: 1;
    }
    .header .school-info h2 {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 5px;
    }
    .header .school-info p {
        font-size: 14px;
        line-height: 1.4;
    }
    /* Section Title */
    .section-title {
        text-align: center;
        font-size: 16px;
        font-weight: bold;
        margin: 10px 0;
        padding: 6px 0;
        background: #f1f1f1;
        border: 1px solid #ddd;
    }
    /* Details */
    .details {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
        font-size: 14px;
    }
    .details div p {
        margin-bottom: 5px;
    }
    /* Student Info with Photo */
    .student-info {
        display: flex;
        align-items: center;
        margin: 15px 0;
    }
    .student-info img {
        width: 60px;
        height: 60px;
        border: 1px solid #ccc;
        margin-right: 15px;
        border-radius: 10%;
    }
    .student-info div p {
        font-size: 14px;
        margin-bottom: 4px;
    }
    /* Fee Table */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        font-size: 14px;
    }
    table th, table td {
        border: 1px solid #333;
        padding: 8px;
        text-align: center;
    }
    table th {
        background: #f7f7f7;
        font-weight: bold;
    }
    .total-row td {
        font-weight: bold;
    }
    /* Footer */
    .footer {
        margin-top: 15px;
        font-size: 14px;
    }
    .footer p {
        margin-bottom: 4px;
    }
    .qr-section {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-top: 10px;
    }
    .qr-section img {
        width: 90px;
        height: 90px;
    }
    /* Signature */
    .signature {
        margin-top: 25px;
        text-align: right;
        font-size: 14px;
    }
    .signature-line {
        width: 200px;
        border-top: 1px solid #000;
        margin-left: auto;
        margin-top: 5px;
    }
    /* Parent Copy */
    .parent-copy {
        text-align: center;
        font-size: 12px;
        margin-top: 15px;
        color: #555;
    }
    /* Print Button */
    .print-btn {
        display: block;
        margin: 15px auto;
        padding: 8px 20px;
        background: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
    }
    .print-btn:hover {
        background: #0056b3;
    }
    @media print {
        .print-btn { display: none; }
    }
</style>
</head>
<body>

<div class="receipt-container">

    <!-- Header -->
    <div class="header">
        <div class="logo">
            <img src="https://techwebmantra.com/school/public/{{ Auth::guard('admin')->user()->logo }}" alt="School Logo">
        </div>
        <div class="school-info">
            <h2>{{ $school->name }}</h2>
            <p>{{ $school->address }}</p>
            <p><strong>Phone:</strong> {{ $school->phone }} | <strong>School Code:</strong> {{ $school->center_code }}</p>
        </div>
    </div>

    <!-- Section Title -->
    <div class="section-title">FEE RECEIPT</div>

    <!-- Details -->
    <div class="details">
        <div>
            <p><strong>Receipt No:</strong> {{ $payment->receipt_no }}</p>
            <p><strong>Admission No:</strong> {{ $student->admission_no }}</p>
            <p><strong>Name:</strong> {{ $student->name }}</p>
            <p><strong>Father's Name:</strong> {{ $student->father_name }}</p>
        </div>
        <div>
            <p><strong>Date:</strong> {{ date('d/m/Y', strtotime($payment->date)) }}</p>
            <p><strong>Session:</strong> {{ $session->name }}</p>
            <p><strong>Class:</strong> {{ $Cclass->name }} - {{ $Ssec->name }}</p>
            <p><strong>Installment:</strong> {{ date('M, Y', strtotime($payment->date)) }}</p>
        </div>
    </div>

    <!-- Student Info -->
    <div class="student-info">
        <img src="{{ asset('public/admin/student/'.$student->photo) }}" alt="Student Photo">
        <div>
            <p><strong>Phone:</strong> {{ $student->phone }}</p>
            <p><strong>Email:</strong> {{ $student->email }}</p>
        </div>
    </div>

    <!-- Fee Table -->
    <table>
        <thead>
            <tr>
                <th>Sl.No</th>
                <th>Description</th>
                <th>Month</th>
                <th>Due</th>
                <th>Con</th>
                <th>Paid</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; $total = 0; @endphp
            @foreach($fee as $fees)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $fees->fee_name }}</td>
                <td>{{ $fees->month_name ?? date('M', strtotime($fees->created_at)) }}</td>
                <td>{{ number_format($fees->amount_paid, 2) }}</td>
                <td>0</td>
                <td>{{ number_format($fees->amount_paid, 2) }}</td>
            </tr>
            @php $total += $fees->amount_paid; @endphp
            @endforeach
            <!-- Late Payment Fee -->
            <tr>
                <td colspan="5" style="text-align:right;">Late Payment Fee</td>
                <td>{{ number_format($payment->late_fee, 2) }}</td>
            </tr>
            <!-- Total -->
            <tr class="total-row">
                <td colspan="5" style="text-align:right;">Total</td>
                <td>{{ number_format($total + $payment->late_fee, 2) }}</td>
            </tr>
            <!-- Total Balance -->
            <tr class="total-row">
                <td colspan="5" style="text-align:right;">Total Balance Amount</td>
                <td>{{ number_format($payment->balance_amount, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p><strong>Rupees:</strong> {{ ucfirst(strtolower($amountInWords)) }} Only</p>
        <p>Received By: {{ $school->code }}</p>
        <p>For {{ $school->name }}</p>
    </div>

    <!-- QR & Payment Info -->
    <div class="qr-section">
        <div>
            <p><strong>Pay Mode:</strong> {{ $payment->payment_mode }}</p>
        </div>
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=90x90&data={{ $payment->receipt_no }}" alt="QR Code">
    </div>

    <!-- Signature -->
    <div class="signature">
        <p>Authorized Signatory</p>
        <div class="signature-line"></div>
    </div>

    <!-- Parent Copy -->
    <div class="parent-copy">
        This is a computer-generated receipt. Does not require signature. <br>
        <strong>PARENT COPY</strong>
    </div>
</div>

<!-- Print Button -->
<button class="print-btn" onclick="window.print()">Print Receipt</button>

</body>
</html>
