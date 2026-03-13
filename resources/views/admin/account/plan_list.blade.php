<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Plan List - Tech Web Mantra</title>
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
    <link rel="stylesheet" href="{{ asset('public/admin/css/select2.min.css') }}">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="{{ asset('public/admin/css/datepicker.min.css') }}">
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
  
  
  <style>
/* ===== Premium Form Card ===== */
.calc-card {
    background: #fff;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 8px 28px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}
.calc-card:hover {
    box-shadow: 0 10px 35px rgba(0,0,0,0.12);
}

/* ===== Form Inputs ===== */
#planCalcForm .form-control {
    border: 1.6px solid #ccc;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 15px;
    transition: all 0.3s ease;
}
#planCalcForm .form-control:focus {
    border-color: #0077ff;
    box-shadow: 0 0 0 3px rgba(0,119,255,0.2);
}

/* ===== Labels ===== */
#planCalcForm label {
    font-weight: 600;
    color: #444;
    margin-bottom: 6px;
}

/* ===== Buttons Premium Look ===== */
.btn-premium {
    border: none;
    padding: 10px 24px;
    font-size: 15px;
    font-weight: 600;
    border-radius: 10px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}
.btn-calc {
    background: linear-gradient(135deg,#28a745,#20c997);
    color: #fff;
}
.btn-calc:hover {
    background: linear-gradient(135deg,#20c997,#28a745);
}
.btn-export {
    background: linear-gradient(135deg,#007bff,#00c6ff);
    color: #fff;
}
.btn-export:hover {
    background: linear-gradient(135deg,#00c6ff,#007bff);
}

/* ===== Action Buttons Group ===== */
.calc-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 20px;
}

/* ===== Result Box ===== */
#calcResult {
    border-radius: 10px;
    font-size: 15px;
    padding: 15px 18px;
}


.new-added-form .form-group i {
    /* position: absolute; */
    /* top: 56px; */
    /* right: 34px; */
    font-size: 15px;
    color: #fff;
}
</style>
</head>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
         <!-- Header Menu Area Start Here -->
        @include('admin.include.header')
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
           @include('admin.include.sidebar')
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Plan List</h3>
                    <ul>
                        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li>Add Plan List</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Add Expense Area Start Here -->
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Plan Calculation</h3>
                            </div>
                           <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" 
                                data-toggle="dropdown" aria-expanded="false">...</a>
        
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                </div>
                            </div>
                        </div>
                        <form class="new-added-form">
                            <div class="row">
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Total Members *</label>
                                    <input type="number" id="total_members" name="total_members" class="form-control" placeholder="Enter total members" required>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Total Levels *</label>
                                    <input type="number" id="total_levels" name="total_levels" class="form-control" placeholder="Enter total levels" required>
                                </div>
                                
                                
                                <div class="col-12 form-group mg-t-8">
                                    <button type="button" id="calcBtn" style="cursor:pointer;" class="btn-premium btn-export">
                                 <i class="fa fa-download"></i> Calculate & Export
                            </button>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Add Expense Area End Here -->
                 @include('admin.include.footer')
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
    <!-- jquery-->
    <script src="{{ asset('public/admin/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/plugins.js') }}"></script>
    <script src="{{ asset('public/admin/js/jquery.scrollUp.min.js') }}"></script>
    
    <script src="{{ asset('public/admin/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('public/admin/js/main.js') }}"></script>

    <!-- Preloader Hide Script -->
    <script>
        window.addEventListener('load', function () {
            document.getElementById('preloader').style.display = 'none';
        });
    </script>
    
    
    <script>
    $("#calcBtn").on("click", function () {
    let total_members = $('#total_members').val();
    let total_levels = $('#total_levels').val();

    if(!total_members || !total_levels){
        toast.error("Please enter members & levels!");
        return;
    }

    // Redirect to download CSV
    window.location.href = "{{ url('admin/getExport') }}/" + total_members + "/" + total_levels;
});

   
</script>

</body>

</html>
