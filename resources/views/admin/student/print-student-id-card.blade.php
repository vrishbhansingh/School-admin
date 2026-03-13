<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student ID Card</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: #f0f0f0;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 40px;
    }

    .id-card {
      width: 333px;
      background: #fefefc;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
      text-align: center;
      border: 2px solid #166534; /* permanent border */
    }

    /* Header */
    .id-header {
      background-color: #166534;
      padding: 6px 10px;
      color: white;
      display: flex;
      align-items: center;
      border-bottom: 4px solid #134e32;
      position: relative;
      height: 110px;
    }

    @if(Auth::guard('admin')->user()->school_id == 1)
      .id-header img {
        width: 71px;
        height: 71px;
        position: absolute;
        left: 0px;
        top: 19px;
      }

      .header-text h1 {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 2px;
        letter-spacing: 0.4px;
        line-height: 1.2;
      }
    @else
      .id-header img {
        width: 145px;
        height: 141px;
        position: absolute;
        left: -25px;
        top: -15px;
      }

      .header-text h1 {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 2px;
        letter-spacing: 0.4px;
        line-height: 1.2;
      }
    @endif

    .header-text {
      flex: 1;
      text-align: right;
      margin-left: auto;
      padding-left: 10px;
    }

    .header-text p {
      font-size: 9px;
      opacity: 0.9;
    }

    /* Profile Photo */
    .photo {
      margin-top: 12px;
      border: 3px solid #166534;
      border-radius: 50%;
      width: 90px;
      height: 90px;
      object-fit: cover;
    }

    /* Name */
    .student-name {
      margin-top: 10px;
      font-weight: 700;
      font-size: 16px;
    }

    .student-parent {
      font-size: 12px;
      color: #444;
      margin-bottom: 10px;
    }

    /* Info */
    .info-table {
      width: 100%;
      padding: 0 20px;
      text-align: left;
      font-size: 12px;
    }

    .info-table td {
      padding: 4px 0;
    }

    .info-table td:first-child {
      font-weight: 600;
      width: 100px;
    }

    /* Footer */
    .footer {
      margin-top: 10px;
      border-top: 1px solid #ccc;
      padding: 10px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .signature {
      font-size: 12px;
      text-align: left;
    }

    .barcode {
      width: 100px;
      height: 40px;
      background: url('https://barcode.tec-it.com/barcode.ashx?data=1234567890&code=Code128&translate-esc=false') no-repeat right center;
      background-size: contain;
    }

    /* === PRINT SETTINGS === */
    @page {
      margin: 0 !important;
    }

    @media print {
      body {
        background: #fff;
        padding: 0;
        margin: 0;
      }

      .id-card {
        box-shadow: none;
        border: 2px solid #166534 !important; /* border stays visible */
        border-radius: 20px !important;
        position: absolute;
        top: 5mm; /* ✅ little top gap for printing */
        left: 50%;
        transform: translateX(-50%);
      }

      button {
        display: none;
      }
    }

    /* Print Button */
    button {
      margin-top: 20px;
      padding: 7px 20px;
      background-color: #166534;
      color: #fff;
      border: none;
      border-radius: 6px;
      font-size: 14px;
      cursor: pointer;
      transition: 0.2s;
    }

    button:hover {
      background-color: #134e32;
    }
  </style>
</head>
<body>

  <div class="id-card">
    <!-- Header -->
    <div class="id-header">
      <img src="{{ asset('public/'.Auth::guard('admin')->user()->logo.'') }}" alt="Logo">
      <div class="header-text">
        <h1>{{ $school->name }}</h1>
        <p>OFFICIAL STUDENT IDENTITY CARD</p>
      </div>
    </div>

    <!-- Photo -->
    <img class="photo" src="{{ asset('public/admin/student/' . $student->photo) }}" alt="{{ $student->name }}">

    <!-- Name -->
    <div class="student-name">{{ $student->name }}</div>
    <div class="student-parent">S/O: {{ $student->father_name }}</div>

    <!-- Info Table -->
    <table class="info-table">
      <tr><td>Roll No.</td><td>{{ $student->roll_no }}</td></tr>
      <tr><td>Admission No.</td><td>{{ $student->addmission_no }}</td></tr>
      <tr><td>Class</td><td>{{ $class->name }}</td></tr>
      <tr><td>Section</td><td>{{ $section->name }}</td></tr>
      <tr><td>Phone</td><td>+91-{{ $student->phone }}</td></tr>
      <tr><td>Address</td><td>{{ $student->address }}</td></tr>
    </table>

    <!-- Footer -->
    <div class="footer">
      <div class="signature">Signature</div>
      <div class="barcode"></div>
    </div>
  </div>

  <!-- Print Button -->
  <button onclick="window.print()">Print ID Card</button>

  <script>
    window.onafterprint = () => window.history.back();
    document.addEventListener("keydown", e => {
      if (e.key === "Escape") window.history.back();
    });
  </script>

</body>
</html>
