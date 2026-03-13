<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Teacher Details - Tech Web Mantra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/admin/img/favicon.png') }}" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('public/admin/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/css/normalize.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/fonts/flaticon.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/css/fullcalendar.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/css/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/admin/css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('public/admin/css/print.css') }}" media="print">

    <style>

        .self_data{
    color:#ffffff;
   }
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: #f0f0f0;
    }

    #profile-card {
      display: flex;
      flex-wrap: wrap;
      max-width: 1000px;
      margin: 0px auto;
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 15px 40px rgba(0,0,0,0.1);
      position: relative;
      overflow: hidden;
    }

    #print-btn {
      position: absolute;
      top: 15px;
      right: 15px;
      background: none;
      border: none;
      font-size: 24px;
      color: #5a4db2;
      cursor: pointer;
      z-index: 10;
    }

    .left-section {
      flex: 0 0 260px;
      background: linear-gradient(160deg, #08500b, #FF9800);
      color: #fff;
      padding: 35px 20px;
      text-align: center;
    }

    .profile-photo {
      width: 140px;
      height: 140px;
      margin: 0 auto 15px;
      border-radius: 50%;
      overflow: hidden;
      border: 4px solid #fff;
    }

    .profile-photo img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .left-section h2 {
      font-size: 24px;
      margin: 10px 0 5px;
    }

    .left-section p {
      margin: 4px 0;
      font-size: 13px;
    }

    .right-section {
      flex: 1;
      padding: 35px 40px;
    }

    .section {
      margin-bottom: 25px;
    }

    .section-title {
      font-size: 16px;
      font-weight: 600;
      color: #333;
      border-left: 4px solid #5a4db2;
      padding-left: 10px;
      margin-bottom: 15px;
    }

    .row-line {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }

    .row-item {
      flex: 1;
      min-width: 160px;
      background: #f9f9f9;
      padding: 6px 23px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .row-item strong {
      display: block;
      font-size: 13px;
      color: #5a4db2;
      margin-bottom: 4px;
    }

    .row-item span {
      font-size: 14px;
      color: #222;
    }

    @media print {
      body * {
        visibility: hidden;
      }

      #print-area, #print-area * {
        visibility: visible !important;
      }

      #print-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        margin: 0;
        padding: 0;
        box-shadow: none !important;
      }

      #print-btn {
        display: none !important;
      }

      .row-item {
        page-break-inside: avoid;
      }
    }
  </style>
</head>

<body>  

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
                <div class="breadcrumbs-area">
                    <h3>Teacher</h3>
                    <ul>
                        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li>Teacher Details</li>
                    </ul>
                </div>

                <!-- Profile Card -->
                <div id="print-area">
                <div id="profile-card">
  <button id="print-btn" onclick="printProfileCard()" title="Print"><i class="fas fa-print"></i></button>

  <div class="left-section">
    <div class="profile-photo">
      <img src="{{ asset('public/admin/student_logo.png') }}" alt="Rahul Kumar">
    </div>
    
    <h2 class="self_data">Rahul Kumar</h2>
    <p class="self_data">rahulkumar@gmail.com</p>
    <p class="self_data">+91-9856888841</p>
    <p class="self_data">Roll No: <strong>10005</strong></p>
    <p class="self_data">Admission No: <strong>ADM-2024-0005</strong></p>
    
  </div>

  <div class="right-section">
    <div class="section">
      <div class="section-title">Personal Information</div>
      <div class="row-line">
        <div class="row-item"><strong>Gender</strong><span>Male</span></div>
        <div class="row-item"><strong>DOB</strong><span>07‑Aug‑2016</span></div>
        <div class="row-item"><strong>Religion</strong><span>Hindu</span></div>
        <div class="row-item"><strong>Blood Group</strong><span>B+</span></div>
      </div>
    </div>

    <div class="section">
      <div class="section-title">Guardian Details</div>
      <div class="row-line">
        <div class="row-item"><strong>Father's Name</strong><span>Mohan Kumar</span></div>
        <div class="row-item"><strong>Mother's Name</strong><span>Savitri Devi</span></div>
        <div class="row-item"><strong>Father's Occupation</strong><span>Graphic Designer</span></div>
      </div>
    </div>

    <div class="section">
      <div class="section-title">Contact Information</div>
      <div class="row-line">
        <div class="row-item"><strong>Email</strong><span>rahulkumar@gmail.com</span></div>
        <div class="row-item"><strong>Phone</strong><span>+91-9856888841</span></div>
        <div class="row-item"><strong>Address</strong><span>B block sector-8, Rohini-110085</span></div>
      </div>
    </div>

    <div class="section">
      <div class="section-title">Academic Information</div>
      <div class="row-line">
        <div class="row-item"><strong>Admission Date</strong><span>07‑Aug‑2019</span></div>
        <div class="row-item"><strong>Session</strong><span>2024–2025</span></div>
        <div class="row-item"><strong>Class</strong><span>2</span></div>
        <div class="row-item"><strong>Section</strong><span>A</span></div>
        <div class="row-item"><strong>Section</strong><span>Pink</span></div>
        <div class="row-item"><strong>Class Teacher</strong><span>Ms. Sonam Kumari</span></div>
      </div>
    </div>
  </div>
</div>
</div>



                @include('admin.include.footer')
            </div>
        </div>
    </div>

    <script src="{{ asset('public/admin/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/plugins.js') }}"></script>
    <script src="{{ asset('public/admin/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/main.js') }}"></script>

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
</body>

</html>
