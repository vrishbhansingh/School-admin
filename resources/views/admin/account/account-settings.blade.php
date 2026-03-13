<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>New User Setting- Tech Web Mantra</title>
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
                    <h3>New User Setting</h3>
                    <ul>
                        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li>New User Setting</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Account Settings Area Start Here -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Add New User</h3>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                            aria-expanded="false">...</a>
        
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-times text-orange-red"></i>Close</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                        </div>
                                    </div>
                                </div>
                                <form class="new-added-form">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>First Name *</label>
                                            <input type="text" placeholder="" class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Last Name *</label>
                                            <input type="text" placeholder="" class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>User Type *</label>
                                            <select class="select2">
                                                <option value="">Please Select*</option>
                                                <option value="1">Super Admin</option>
                                                <option value="2">Admin</option>
                                                <option value="3">User</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Gender *</label>
                                            <select class="select2">
                                                <option value="">Please Select Gender *</option>
                                                <option value="1">Male</option>
                                                <option value="2">Female</option>
                                                <option value="3">Others</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Father's Name</label>
                                            <input type="text" placeholder="" class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Mother's Name</label>
                                            <input type="text" placeholder="" class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Date Of Birth *</label>
                                            <input type="text" placeholder="dd/mm/yyyy" class="form-control air-datepicker"
                                                data-position='bottom right'>
                                            <i class="far fa-calendar-alt"></i>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Religion *</label>
                                            <select class="select2">
                                                <option value="">Please Select *</option>
                                                <option value="1">Islam</option>
                                                <option value="2">Christian</option>
                                                <option value="3">Hindu</option>
                                                <option value="4">Buddhish</option>
                                                <option value="5">Others</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Joining Data *</label>
                                            <input type="text" placeholder="dd/mm/yyyy" class="form-control air-datepicker"
                                                data-position='bottom right'>
                                            <i class="far fa-calendar-alt"></i>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>E-Mail</label>
                                            <input type="email" placeholder="" class="form-control">
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Subject *</label>
                                            <select class="select2">
                                                <option value="">Please Select*</option>
                                                <option value="1">Mathmetics</option>
                                                <option value="2">English</option>
                                                <option value="3">Chemistry</option>
                                                <option value="3">Biology</option>
                                                <option value="3">Others</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Class *</label>
                                            <select class="select2">
                                                <option value="">Please Select Class *</option>
                                                <option value="1">Play</option>
                                                <option value="2">Nursery</option>
                                                <option value="3">One</option>
                                                <option value="3">Two</option>
                                                <option value="3">Three</option>
                                                <option value="3">Four</option>
                                                <option value="3">Five</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Section *</label>
                                            <select class="select2">
                                                <option value="">Please Select Section *</option>
                                                <option value="1">Pink</option>
                                                <option value="2">Blue</option>
                                                <option value="3">Bird</option>
                                                <option value="3">Rose</option>
                                                <option value="3">Red</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>ID No *</label>
                                            <input type="text" placeholder="" class="form-control">
                                        </div>                               
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Phone</label>
                                            <input type="text" placeholder="" class="form-control">
                                        </div>
                                        <div class="col-lg-6 col-12 form-group">
                                            <label>Adress *</label>
                                            <textarea class="textarea form-control" name="message" id="form-message" cols="10"
                                                rows="4"></textarea>
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
                    <div class="col-4-xxxl col-xl-5">
                        <div class="card account-settings-box height-auto">
                            <div class="card-body">
                                <div class="heading-layout1 mg-b-20">
                                    <div class="item-title">
                                        <h3>All User</h3>
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
                                <div class="all-user-box">
                                    <div class="media media-none--xs active">
                                        <div class="item-img">
                                            <img src="img/figure/user1.jpg" class="media-img-auto" alt="user">
                                        </div>
                                        <div class="media-body space-md">
                                            <h5 class="item-title">Steven Johnson</h5>
                                            <div class="item-subtitle">Super Admin</div>
                                        </div>
                                    </div>
                                    <div class="media media-none--xs">
                                        <div class="item-img">
                                            <img src="img/figure/user2.jpg" class="media-img-auto" alt="user">
                                        </div>
                                        <div class="media-body space-md">
                                            <h5 class="item-title">Maria Jane</h5>
                                            <div class="item-subtitle">Super Admin</div>
                                        </div>
                                    </div>
                                    <div class="media media-none--xs">
                                        <div class="item-img">
                                            <img src="img/figure/user3.jpg" class="media-img-auto" alt="user">
                                        </div>
                                        <div class="media-body space-md">
                                            <h5 class="item-title">Andrew Walles</h5>
                                            <div class="item-subtitle">Super Admin</div>
                                        </div>
                                    </div>
                                    <div class="media media-none--xs">
                                        <div class="item-img">
                                            <img src="img/figure/user4.jpg" class="media-img-auto" alt="user">
                                        </div>
                                        <div class="media-body space-md">
                                            <h5 class="item-title">Walter Emma</h5>
                                            <div class="item-subtitle">Super Admin</div>
                                        </div>
                                    </div>
                                    <div class="media media-none--xs">
                                        <div class="item-img">
                                            <img src="img/figure/user5.jpg" class="media-img-auto" alt="user">
                                        </div>
                                        <div class="media-body space-md">
                                            <h5 class="item-title">Stuart Johnson</h5>
                                            <div class="item-subtitle">Super Admin</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8-xxxl col-xl-7">
                        <div class="card account-settings-box">
                            <div class="card-body">
                                <div class="heading-layout1 mg-b-20">
                                    <div class="item-title">
                                        <h3>User Details</h3>
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
                                <div class="user-details-box">
                                    <div class="item-img">
                                        <img src="img/figure/user.jpg" alt="user">
                                    </div>
                                    <div class="item-content">
                                        <div class="info-table table-responsive">
                                            <table class="table text-nowrap">
                                                <tbody>
                                                    <tr>
                                                        <td>Name:</td>
                                                        <td class="font-medium text-dark-medium">Steven Johnson</td>
                                                    </tr>
                                                    <tr>
                                                        <td>User Type:</td>
                                                        <td class="font-medium text-dark-medium">Super Admin</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gender:</td>
                                                        <td class="font-medium text-dark-medium">Male</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Father Name:</td>
                                                        <td class="font-medium text-dark-medium">Steve Jones</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mother Name:</td>
                                                        <td class="font-medium text-dark-medium">Naomi Rose</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Date Of Birth:</td>
                                                        <td class="font-medium text-dark-medium">07.08.2016</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Religion:</td>
                                                        <td class="font-medium text-dark-medium">Islam</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Joining Date:</td>
                                                        <td class="font-medium text-dark-medium">07.08.2016</td>
                                                    </tr>
                                                    <tr>
                                                        <td>E-mail:</td>
                                                        <td class="font-medium text-dark-medium">stevenjohnson@gmail.com</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Subject:</td>
                                                        <td class="font-medium text-dark-medium">English</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Class:</td>
                                                        <td class="font-medium text-dark-medium">2</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Section:</td>
                                                        <td class="font-medium text-dark-medium">Pink</td>
                                                    </tr>
                                                    <tr>
                                                        <td>ID No:</td>
                                                        <td class="font-medium text-dark-medium">10005</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Address:</td>
                                                        <td class="font-medium text-dark-medium">House #10, Road #6, Australia</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phone:</td>
                                                        <td class="font-medium text-dark-medium">+ 88 98568888418</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Account Settings Area End Here -->
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