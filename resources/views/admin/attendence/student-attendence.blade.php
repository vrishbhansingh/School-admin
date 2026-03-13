<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Student Attendence - Tech Web Mantra</title>
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
                    <h3>Student Attendence</h3>
                    <ul>
                        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li>Attendence</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <div class="row">
                    <!-- Student Attendence Search Area Start Here -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Student Attendence</h3>
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
                                            <label>Select Class</label>
                                            <select class="select2">
                                                <option value="">Select Class</option>
                                                <option value="1">Nursery</option>
                                                <option value="2">Play</option>
                                                <option value="3">One</option>
                                                <option value="4">Two</option>
                                                <option value="5">Three</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Select Section</label>
                                            <select class="select2">
                                                <option value="0">Select Section</option>
                                                <option value="1">A</option>
                                                <option value="2">B</option>
                                                <option value="3">C</option>
                                                <option value="4">D</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Select Month</label>
                                            <select class="select2">
                                                <option value="0">Select Month</option>
                                                <option value="1">January</option>
                                                <option value="2">February</option>
                                                <option value="3">March</option>
                                                <option value="4">April</option>
                                                <option value="5">May</option>
                                                <option value="6">June</option>
                                                <option value="7">July</option>
                                                <option value="8">August</option>
                                                <option value="9">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Select Session</label>
                                            <select class="select2">
                                                <option value="0">Select Session</option>
                                                <option value="1">2016-2017</option>
                                                <option value="2">2017-20108</option>
                                                <option value="3">2018-2019</option>
                                                <option value="4">2020-2021</option>
                                            </select>
                                        </div>
                                        <div class="col-12 form-group mg-t-8">
                                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                            <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Student Attendence Search Area End Here -->
                    <!-- Student Attendence Area Start Here -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Attendence Sheet Of Class One: Section A, April 2019</h3>
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
                                <div class="table-responsive">
                                    <table class="table bs-table table-striped table-bordered text-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="text-left">Students</th>
                                                <th>1</th>
                                                <th>2</th>
                                                <th>3</th>
                                                <th>4</th>
                                                <th>5</th>
                                                <th>6</th>
                                                <th>7</th>
                                                <th>8</th>
                                                <th>9</th>
                                                <th>10</th>
                                                <th>11</th>
                                                <th>12</th>
                                                <th>13</th>
                                                <th>14</th>
                                                <th>15</th>
                                                <th>16</th>
                                                <th>17</th>
                                                <th>18</th>
                                                <th>19</th>
                                                <th>20</th>
                                                <th>21</th>
                                                <th>22</th>
                                                <th>23</th>
                                                <th>24</th>
                                                <th>25</th>
                                                <th>26</th>
                                                <th>27</th>
                                                <th>28</th>
                                                <th>29</th>
                                                <th>30</th>
                                                <th>31</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-left">Michele Johnson</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Richi Akon</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Amanda Kherr</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Michele Johnson</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Richi Akon</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Amanda Kherr</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Michele Johnson</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Richi Akon</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Amanda Kherr</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Michele Johnson</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Richi Akon</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Amanda Kherr</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Michele Johnson</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Richi Akon</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Amanda Kherr</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Michele Johnson</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Richi Akon</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Amanda Kherr</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-times text-danger"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td><i class="fas fa-check text-success"></i></td>
                                                <td>-</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Student Attendence Area End Here -->
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