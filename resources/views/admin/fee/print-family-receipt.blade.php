<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Family Fee Receipt</title>
<style>
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
    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 2px solid #333;
        padding-bottom: 10px;
    }
    .logo img {
        width: 100px;
        height: auto;
    }
    .school-info {
        text-align: center;
        flex: 1;
    }
    .school-info h2 {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 4px;
    }
    .school-info p {
        font-size: 13px;
    }
    .section-title {
        text-align: center;
        background: #f1f1f1;
        padding: 6px;
        border: 1px solid #ccc;
        font-weight: bold;
        margin-top: 15px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        font-size: 14px;
    }
    table th, table td {
        border: 1px solid #444;
        padding: 8px;
        text-align: center;
    }
    table th {
        background: #f9f9f9;
    }
    .total-row td {
        font-weight: bold;
    }
    .footer {
        margin-top: 15px;
        font-size: 14px;
    }
    .signature {
        margin-top: 25px;
        text-align: right;
    }
    .signature-line {
        width: 200px;
        border-top: 1px solid #000;
        margin-left: auto;
        margin-top: 5px;
    }
    .parent-copy {
        text-align: center;
        font-size: 12px;
        margin-top: 15px;
        color: #555;
    }
    .month-paid {
        color: green;
        font-weight: bold;
    }
    .month-due {
        color: red;
        font-weight: bold;
    }
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
    @media print { .print-btn { display: none; } }
</style>
</head>
<body>

<div class="receipt-container">

    <!-- Header -->
    <div class="header">
        <div class="logo">
            <img src="{{ asset('public/' . (Auth::guard('admin')->user()->logo ?? 'default.png')) }}" alt="School Logo">
        </div>
        <div class="school-info">
            <h2>{{ $school->name }}</h2>
            <p>{{ $school->address }}</p>
            <p><strong>Phone:</strong> {{ $school->phone }}</p>
        </div>
    </div>

    <!-- Title -->
    <div class="section-title">FAMILY FEE RECEIPT</div>

    <!-- Family Info -->
    <table style="margin-top:10px;">
        <tr>
            <td><strong>Parent Name:</strong> {{ $parent->name }}</td>
            <td><strong>Mobile:</strong> {{ $parent->phone }}</td>
            <td><strong>Date:</strong> {{ date('d M, Y', strtotime($familyPayment->date)) }}</td>
        </tr>
        <tr>
            <td><strong>Receipt No:</strong> FAM-{{ $familyPayment->id }}</td>
            <td><strong>Payment Mode:</strong> {{ $familyPayment->payment_mode }}</td>
            <td><strong>Session:</strong> {{ date('Y', strtotime($familyPayment->date)) }}</td>
        </tr>
    </table>

    <!-- Fee Table -->
    <table>
        <thead>
            <tr>
                <th>Sl.No</th>
                <th>Student Name</th>
                <th>Class</th>
                <th>Month(s) Paid</th>
                <th>Pending Month(s)</th>
                <th>Paid Amount (₹)</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1; $grandTotal=0; @endphp
            @foreach($students as $stu)
                @php
                    // Paid months for this student
                    $paidMonths = DB::table('student_fee_payment_details')
                        ->join('student_fee_payments', 'student_fee_payment_details.payment_id', '=', 'student_fee_payments.id')
                        ->where('student_fee_payments.student_id', $stu->student_id)
                        ->where('student_fee_payments.family_plan', $familyPayment->id)
                        ->pluck('student_fee_payment_details.month')
                        ->toArray();

                    $paidMonthNames = collect($paidMonths)->map(fn($m) => date('M', mktime(0,0,0,$m,1)))->implode(', ');

                    // Due months
                    $dueMonths = DB::table('student_fees')
                        ->where('student_id', $stu->student_id)
                        ->where('status', '!=', 'paid')
                        ->pluck('month')
                        ->toArray();

                    $dueMonthNames = collect($dueMonths)->map(fn($m) => date('M', mktime(0,0,0,$m,1)))->implode(', ');
                @endphp
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $stu->student_name }}</td>
                    <td>{{ $stu->class_name }}</td>
                    <td class="month-paid">{{ $paidMonthNames ?: '-' }}</td>
                    <td class="month-due">{{ $dueMonthNames ?: '-' }}</td>
                    <td>₹ {{ number_format($stu->fee_amount, 2) }}</td>
                </tr>
                @php $grandTotal += $stu->fee_amount; @endphp
            @endforeach

            <tr class="total-row">
                <td colspan="5" style="text-align:right;">Total Due</td>
                <td>₹ {{ number_format($totalDue, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td colspan="5" style="text-align:right;">Discount</td>
                <td>₹ {{ number_format($discount, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td colspan="5" style="text-align:right;">Final Payable Amount</td>
                <td>₹ {{ number_format($paidAmount, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p><strong>Rupees:</strong> {{ ucfirst(strtolower($amountInWords)) }} only</p>
        <p>Receipt generated by {{ $school->name }}.</p>
    </div>

    <!-- QR + Signature -->
    <div style="display:flex; justify-content:space-between; margin-top:20px;">
        <div>
            <p><strong>Receipt QR:</strong></p>
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=90x90&data=FAM-{{ $familyPayment->id }}" alt="QR Code">
        </div>
        <div class="signature">
            <p>Authorized Signatory</p>
            <div class="signature-line"></div>
        </div>
    </div>

    <div class="parent-copy">
        <p>This is a computer-generated receipt. No signature required.</p>
        <p><strong>Parent Copy</strong></p>
    </div>
</div>

<!-- Print Button -->
<button class="print-btn" onclick="window.print()">🖨️ Print Receipt</button>

</body>
</html>
