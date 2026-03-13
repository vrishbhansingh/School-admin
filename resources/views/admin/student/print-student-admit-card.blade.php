
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admit Card - {{ $school->name }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Merriweather+Sans:wght@700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f0f3f9;
      margin: 0;
      padding: 20px;
      color: #222;
    }

    .admit-card {
      max-width: 850px;
      margin: auto;
      background: #fff;
      border: 1.5px solid #0b63b8;
      border-radius: 12px;
      padding: 25px 30px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      page-break-inside: avoid;
    }

    /* Header */
    .header {
      text-align: center;
      border-bottom: 2px solid #0b63b8;
      padding-bottom: 12px;
      margin-bottom: 20px;
    }

    .header img {
      height: 70px;
      margin-bottom: 8px;
    }

    .header h1 {
      margin: 5px 0;
      font-size: 24px;
      color: #0b63b8;
      font-family: 'Merriweather Sans', sans-serif;
      letter-spacing: 1px;
    }

    .header p {
      margin: 2px 0;
      font-size: 14px;
      color: #444;
    }

    .header strong {
      font-size: 15px;
      color: #d32f2f;
    }

    /* Student Info */
    .student-info {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
      gap: 20px;
    }

    .student-details {
      flex: 1;
      font-size: 14px;
      line-height: 1.6;
    }

    .student-details p {
      margin: 4px 0;
    }

    .student-photo {
      width: 110px;
      height: 130px;
      border: 2px solid #ccc;
      border-radius: 8px;
      overflow: hidden;
      flex-shrink: 0;
    }

    .student-photo img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* Exam Table */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    table th, table td {
      border: 1px solid #ccc;
      padding: 10px;
      font-size: 13px;
      text-align: center;
    }

    table th {
      background: #0b63b8;
      color: #fff;
      text-transform: uppercase;
      font-weight: 600;
    }

    table tr:nth-child(even) {
      background: #f9f9f9;
    }

    /* Signatures */
    .signatures {
      display: flex;
      justify-content: space-between;
      margin-top: 30px;
    }

    .sign-box {
      text-align: center;
      font-size: 13px;
      color: #333;
    }

    /* Instructions */
    .instructions {
      font-size: 13px;
      margin-top: 25px;
      padding: 12px 15px;
      border: 1px dashed #0b63b8;
      border-radius: 8px;
      background: #f5faff;
    }

    .instructions h3 {
      font-size: 14px;
      margin-bottom: 8px;
      color: #0b63b8;
      font-weight: 600;
    }

    .instructions ul {
      margin: 0;
      padding-left: 18px;
    }

    .instructions ul li {
      margin-bottom: 5px;
    }

    /* Print Styles */
    @media print {
      body {
        background: #fff;
        margin: 0;
        padding: 0;
      }
      @page {
        size: A4 portrait;
        margin: 10mm;
      }
      .admit-card {
        box-shadow: none;
        border: 1px solid #000;
        border-radius: 0;
        width: 100%;
        max-width: 190mm;
        margin: 0 auto;
      }
      .btn-print {
        display: none !important;
      }
    }

    /* Print Buttons */
    .btn-print {
      display: flex;
      justify-content: center;
      margin: 20px 0;
      gap: 12px;
    }
    .btn-print button {
      background: #0b63b8;
      color: #fff;
      padding: 10px 22px;
      border: none;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
      transition: 0.3s;
    }
    .btn-print button:hover {
      background: #084b87;
    }
    .btn-print button.cancel {
      background: #d32f2f;
    }
    .btn-print button.cancel:hover {
      background: #a32121;
    }
  </style>
</head>
<body>

<div class="admit-card">
  <!-- Header -->
  <div class="header">
    <img src="{{ asset('public/'.Auth::guard('admin')->user()->logo.'') }}" alt="Logo">
    <h1>{{ $school->name }}</h1>
    <p>{{ $school->address }}</p>
    <p><strong>ADMIT CARD – Annual Examination {{ $session->session }}</strong></p>
  </div>

  <!-- Student Info -->
  <div class="student-info">
    <div class="student-details">
      <p><strong>Student Name:</strong> {{ $student->name }}</p>
      <p><strong>Father’s Name:</strong> {{ $student->father_name }}</p>
      <p><strong>Date of Birth:</strong> {{ date('d-m-Y', strtotime($student->dob)) }}</p>
      <p><strong>Class / Section:</strong> {{ $class->name }} – {{ $section->name }}</p>
      <p><strong>Roll No:</strong> {{ $student->roll_no }}</p>
      <p><strong>Admission No:</strong> {{ $student->addmission_no }}</p>
    </div>
    <div class="student-photo">
      <img src="https://techwebmantra.com/school/public/admin/student/{{ $student->photo }}" alt="Student Photo">
    </div>
  </div>

  <!-- Exam Schedule Table -->
  <table>
    <tr>
      <th>Date</th>
      <th>Subject</th>
      <th>Time</th>
      <th>Duration</th>
    </tr>
    
    @foreach($exam as $ex)
    <tr>
      <td>{{ date('l, d M Y', strtotime($ex->exam_date)) }}</td>
      <td>{{ $ex->subName }}</td>
      <td>{{ date('h:i A', strtotime($ex->start_time)) }} - {{ date('h:i A', strtotime($ex->end_time)) }}</td>
      <td>{{ number_format((float)$ex->duration,'2','.','') }} Hours</td>
    </tr>
    @endforeach
  </table>

  <!-- Signatures -->
  <div class="signatures">
    <div class="sign-box">
      ____________________ <br>
      Student’s Signature
    </div>
    <div class="sign-box">
      ____________________ <br>
      Principal’s Signature
    </div>
  </div>

  <!-- Instructions -->
  <div class="instructions">
    <h3>Important Instructions:</h3>
    <ul>
      <li>Admit Card must be carried to the examination hall.</li>
      <li>Student should reach the exam centre at least 30 minutes before the exam.</li>
      <li>Mobile phones, calculators or electronic devices are strictly prohibited.</li>
      <li>Admit Card should be preserved until the result declaration.</li>
    </ul>
  </div>
</div>

<!-- Print / Cancel Buttons -->
<div class="btn-print">
  <button onclick="window.print()">🖨️ Print Admit Card</button>
  <button class="cancel" onclick="window.history.back()">❌ Cancel</button>
</div>

</body>
</html>





