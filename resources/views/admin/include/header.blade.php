<style>

    body, .dashboard-summery-one {
    font-family: 'Poppins', sans-serif;
}

    .nav-bar-header-one {
    background: linear-gradient(to right, #004767, #004767);
    display: flex;
    justify-content: space-between;
    align-items: center;
    min-width: 24rem;
    margin-top: -5px;
    margin-bottom: -8px;
    margin-left: -1rem;
}

   /* Colorful Card Designs */
.dashboard-summery-one {
    padding: 20px 15px;
    border-radius: 12px;
    color: #fff;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease-in-out;
    background: linear-gradient(193deg, #1a9e20 0%, #104e76 80%);
}

.dashboard-summery-one .item-title {
    font-size: 15px;
    font-weight: 500;
    color: #fff;
    margin-bottom: 3px;
    white-space: nowrap;
}

.dashboard-summery-one:hover {
    transform: translateY(-5px);
}

/* Customize Individual Cards */
.dashboard-summery-one.bg-light-green {
    background: linear-gradient(135deg, #32ccbc 0%, #90f7ec 100%);
    color: #073b4c;
}

.dashboard-summery-one.bg-light-blue {
    background: linear-gradient(135deg, #2193b0 0%, #6dd5ed 100%);
    color: #003049;
}

.dashboard-summery-one.bg-light-yellow {
    background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);
    color: #783f04;
}

.dashboard-summery-one.bg-light-red {
    background: linear-gradient(135deg, #f85032 0%, #e73827 100%);
    color: #fff;
}

/* Icon styles */
.dashboard-summery-one .item-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    overflow: hidden;
}

.sidebar-menu-one .sidebar-menu-content .nav-sidebar-menu > .nav-item > .nav-link span {
    font-size: 15px;
    color: #ffffff;
    -webkit-transition: all 0.3s ease-out;
    -moz-transition: all 0.3s ease-out;
    -ms-transition: all 0.3s ease-out;
    -o-transition: all 0.3s ease-out;
    transition: all 0.3s ease-out;
}

.dashboard-summery-one .item-icon:hover {
    background: rgba(255,255,255,0.3);
}

.dashboard-summery-one .item-content .item-title {
    color: #ffffff;
    margin-bottom: 2px;
    font-family: system-ui;
}

.text-blue {
    color: #ffffff;
}

.text-orange {
    color: #ffffff;
}

.text-red {
    color: #ffffff;
}

.text-green {
    color: #ffffff;
}

.dashboard-summery-one .item-content .item-number {
    font-size: 20px;
    font-weight: 500;
    color: #ffffff;
    font-family: system-ui;
}

/* Content inside cards */


.dashboard-summery-one .item-number {
    font-size: 22px;
    font-weight: 700;
    color: #fff;
    line-height: 1.2;
}

/* Remove extra margin */
.mg-b-20 {
    margin-bottom: 15px !important;
}


/* Reduce space between dashboard cards */
.row.gutters-20 {
    margin-left: -10px;
    margin-right: -10px;
}

.row.gutters-20 > [class*='col-'] {
    padding-left: 10px;
    padding-right: 10px;
}

/* Sidebar compact design */
.sidebar-main {
    width: 240px;
    background: #004767;
    min-height: 100vh;
    overflow-y: auto;
    padding-top: 10px;
}

.sidebar-menu-content {
    padding: 0;
}

.nav-sidebar-menu .nav-item {
    margin-bottom: 5px;
}

.nav-sidebar-menu .nav-link {
    display: flex;
    align-items: center;
    padding: 10px 15px;
    font-size: 14px;
    color: #ffffff;
    transition: 0.3s;
}

.nav-sidebar-menu .nav-link i {
    margin-right: 10px;
    font-size: 16px;
}

.nav-sidebar-menu .nav-link:hover,
.nav-sidebar-menu .nav-item.active > .nav-link {
    background-color: #090a0d;
    border-left: 4px solid #ffa502;
    color: #ffffff;
}

.sub-group-menu {
    background-color: #404852;
    padding-left: 15px;
}

.sub-group-menu .nav-link {
    font-size: 13px;
    padding: 6px 15px;
    color: #dcdcdc;
}

.sub-group-menu .nav-link:hover {
    color: #ffffff;
    background: #57606f;
}

/* Responsive Scrollbar */
.sidebar-main::-webkit-scrollbar {
    width: 6px;
}
.sidebar-main::-webkit-scrollbar-thumb {
    background: #aaa;
    border-radius: 4px;
}


/* Optimize breadcrumb spacing */
.breadcrumbs-area {
    padding: 10px 20px;
    margin-bottom: 10px;
    background-color: #ececec; /* optional */
    border-radius: 6px;
}

.breadcrumbs-area h3 {
    margin: 0;
    font-size: 20px;
    font-weight: 600;
}

.breadcrumbs-area ul {
    margin: 5px 0 0;
    padding: 0;
    list-style: none;
}

.breadcrumbs-area ul li {
    display: inline;
    color: #555;
    margin-right: 8px;
}

.breadcrumbs-area ul li a {
    color: #007bff;
    text-decoration: none;
}

.breadcrumbs-area ul li::after {
    content: "/";
    margin-left: 8px;
    color: #ccc;
}

.breadcrumbs-area ul li:last-child::after {
    content: "";
}

.footer-wrap-layout1 {
    margin-top: auto;
    background-color: #f8f9fa;
    padding: 10px 20px;
    text-align: center;
    font-size: 14px;
    color: #555;
    border-top: 1px solid #ddd;
}

#wrapper {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.bg-light-purple {
    background-color: #e3d4f3 !important;
}
.text-purple {
    color: #6f42c1 !important;
}
.bg-light-cyan {
    background-color: #d1f1f9 !important;
}

@media (max-width: 1200px) {
  .row.gutters-20 > [class*='col-'] { padding-bottom: 30px; }
}
@media (max-width: 768px) {
  .item-title { font-size: 15px; }
  .item-number { font-size: 20px; }
}

@media (max-width: 768px) {
  .dashboard-summery-one .item-title {
    font-size: 14px;
  }
  .dashboard-summery-one .item-number {
    font-size: 20px;
  }
}


.center-logo-mobile {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 70px;
    background-color: #004767; /* optional: background white */
}

.center-logo-mobile .header-logo img {
    max-height: 50px;
    width: auto;
}

.blink-dot {
    height: 10px;
    width: 10px;
    background-color: #28a745;
    border-radius: 50%;
    display: inline-block;
    animation: blink-animation 1s infinite;
}

@keyframes blink-animation {
    0%, 100% { opacity: 1; }
    50% { opacity: 0; }
}

.sidebar-logo img {
    height: 55px;
    width: auto;
}

.sidebar-logo span {
    font-size: 16px;
    font-weight: 600;
    color: white;
}

.nav-bar-header-one .header-logo {
    /* padding-left: 10px; */
    margin-top: -53px;
}

.nav-bar-header-one .header-logo {
    padding-left: 6px;
}


</style>


<div class="navbar navbar-expand-md header-menu-one bg-light">
            <div class="nav-bar-header-one">
                
                <div class="header-logo">
                <a href="{{ route('admin.dashboard') }}" style="display: block; max-width: 170px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: white;">
                    <!--<img style="height: 59px;width: 170px;" src="{{ asset('public/admin/twm_school_logo.png') }}" alt="logo">-->
                    
<div class="header-logo">
    <a href="{{ route('admin.dashboard') }}" style="display: block; max-width: 170px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: white;">
        @if(Auth::guard('admin')->user()->id == 2)
            <img style="height: 130px;width: 184px;margin-top: 29px;" src="https://techwebmantra.com/school/public/{{ Auth::guard('admin')->user()->logo }}" alt="logo">
        @else
        @if(Auth::guard('admin')->user()->id == 3)
            <img style="height: 109px;width: 114px;margin-top: 50px;margin-left: 29px;padding: 14px;" src="https://techwebmantra.com/school/public/{{ Auth::guard('admin')->user()->logo }}" alt="logo">
        @else
        
        <img style="height: 109px;width: 120px;margin-top: 50px;margin-left: 29px;padding: 14px;" src="https://techwebmantra.com/school/public/{{ Auth::guard('admin')->user()->logo }}" alt="logo">
        
        @endif
        @endif
    </a>
    
    @if(Auth::guard('admin')->user()->id == 3)
    <div style="font-size: 13px; color: #d4fcd4; display: flex; align-items: center; gap: 5px;margin-top: -21px;">
        <span style="margin-left: 40px;">Super Admin</span>
        <span class="blink-dot"></span>
    </div>
    @else
    <div style="font-size: 13px; color: #d4fcd4; display: flex; align-items: center; gap: 5px;margin-top: -38px;">
        <span style="margin-left: 40px;">Super Admin</span>
        <span class="blink-dot"></span>
    </div>
    
    @endif
    
</div>


                </a>
                
            </div>
                 <div class="toggle-button sidebar-toggle">
                    <button type="button" class="item-link">
                        <span class="btn-icon-wrap">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="d-md-none mobile-nav-bar">
               <button class="navbar-toggler pulse-animation" type="button" data-toggle="collapse" data-target="#mobile-navbar" aria-expanded="false">
                    <i class="far fa-arrow-alt-circle-down"></i>
                </button>
                <button type="button" class="navbar-toggler sidebar-toggle-mobile">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="header-main-menu collapse navbar-collapse" id="mobile-navbar">
                <ul class="navbar-nav">
                    <li class="navbar-item header-search-bar">
                        <div class="input-group stylish-input-group">
                            <span class="input-group-addon">
                                <button type="submit">
                                    <span class="flaticon-search" aria-hidden="true"></span>
                                </button>
                            </span>
                            <input type="text" class="form-control" placeholder="Find Something . . .">
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    
                    <li class="navbar-item dropdown header-message">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="far fa-envelope"></i>
                            <div class="item-title d-md-none text-16 mg-l-10">Message</div>
                            <span>5</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="item-header">
                                <h6 class="item-title">05 Message</h6>
                            </div>
                            <div class="item-content">
                                
                            </div>
                        </div>
                    </li>
                    <li class="navbar-item dropdown header-notification">
                        <a class="navbar-nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <i class="far fa-bell"></i>
                            <div class="item-title d-md-none text-16 mg-l-10">Notification</div>
                            <span>0</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="item-header">
                                <h6 class="item-title">0 Notifiacations</h6>
                            </div>
                            
                        </div>
                    </li>

                    <li class="navbar-item dropdown header-admin" style="margin-top: -11px;">
                        <a class="navbar-nav-link" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            
                            <div class="admin-img">
                                
                                <img src="{{ asset('public/admin/img/admin.jpg') }}" alt="Admin">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            
                            <div class="item-content">
                                <ul class="settings-list">
                                    <!--<li><a href="#"><i class="flaticon-user"></i>My Profile</a></li>
                                    <li><a href="#"><i class="flaticon-list"></i>Task</a></li>
                                    <li><a href="#"><i class="flaticon-chat-comment-oval-speech-bubble-with-text-lines"></i>Message</a></li>-->
                                    <li><a href="{{ route('admin.account_security') }}"><i class="flaticon-gear-loading"></i>Account Settings</a></li>
                                    <li><a href="{{ route('admin.logout') }}"><i class="flaticon-turn-off"></i>Log Out</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                     
                </ul>
            </div>
        </div>