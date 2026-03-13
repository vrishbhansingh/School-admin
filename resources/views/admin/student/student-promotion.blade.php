<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Student Promotion - Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/admin/img/favicon.png') }}">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('public/admin/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/admin/css/normalize.css') }}">
  <link rel="stylesheet" href="{{ asset('public/admin/css/main.css') }}">
  <link rel="stylesheet" href="{{ asset('public/admin/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/admin/fonts/flaticon.css') }}">
  <link rel="stylesheet" href="{{ asset('public/admin/css/animate.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/admin/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/admin/css/datepicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/admin/css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f7fa;
    }

    .promotion-card {
      max-width: 900px;
      margin: 0 auto;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
      background: #fff;
    }

    .btn-fill-md {
      padding: 8px 20px;
      font-size: 14px;
      border-radius: 5px;
    }

    .card-title {
      font-size: 20px;
      font-weight: 600;
    }

    .promotion-card select,
    .promotion-card input,
    .promotion-card textarea {
      border-radius: 6px;
      border: 1px solid #dcdcdc;
      background-color: #fafafa;
    }

    .promotion-card .form-group label {
      font-size: 14px;
      color: #333;
    }

    .promotion-card .btn-lg {
      font-size: 16px;
      border-radius: 6px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: 0.3s ease;
    }

    .promotion-card .btn-lg:hover {
      background-color: #0056b3;
    }

    .breadcrumbs-area .btn {
      font-size: 14px;
      padding: 6px 14px;
      border-radius: 6px;
      transition: 0.3s ease;
    }

    .breadcrumbs-area .btn:hover {
      background-color: #004ea2;
      color: #fff;
    }
  </style>
</head>

<body>
  <div id="wrapper" class="wrapper bg-ash">
    @include('admin.include.header')
    <div class="dashboard-page-one">
      @include('admin.include.sidebar')
      <div class="dashboard-content-one">

        <!-- Breadcrumbs and Action Button -->
        <div class="breadcrumbs-area d-flex justify-content-between align-items-center flex-wrap mb-3">
          <div>
            <h3 class="mb-0">🎓 Student Promotion</h3>
            <ul class="breadcrumb">
              <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li>Promotion</li>
            </ul>
          </div>
          <div>
            <a href="{{ route('admin.student_promotion_list') }}" class="btn btn-sm btn-primary shadow-sm">
              <i class="fas fa-list mr-1"></i> Promotion History
            </a>
          </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Promotion Form -->
        <div class="promotion-card">
          <div class="card-header mb-4 border-bottom pb-2">
            <h4 class="card-title text-primary font-weight-bold">🎓 Promote Students</h4>
          </div>

          <form class="new-added-form" id="student_promotion" method="POST">
            @csrf
            <div class="row g-4">
              <!-- Session Selection -->
              <div class="col-md-6 form-group">
                <label>Current Session <span class="text-danger">*</span></label>
                <select name="old_session_id" class="form-control select2">
                  <option value="">Select</option>
                  @foreach($Sses as $ss)
                  <option value="{{ $ss->id }}">{{ $ss->session }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6 form-group">
                <label>Promote Session <span class="text-danger">*</span></label>
                <select name="new_session_id" class="form-control select2">
                  <option value="">Select</option>
                  @foreach($Sses as $ss)
                  <option value="{{ $ss->id }}">{{ $ss->session }}</option>
                  @endforeach
                </select>
              </div>

              <!-- Class Selection -->
              <div class="col-md-6 form-group">
                <label>Promotion From Class <span class="text-danger">*</span></label>
                <select name="old_class_id" class="form-control select2">
                  <option value="">Select Class</option>
                  @foreach($Sclass as $class)
                  <option value="{{ $class->id }}">{{ $class->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6 form-group">
                <label>Promotion To Class <span class="text-danger">*</span></label>
                <select name="new_class_id" class="form-control select2">
                  <option value="">Select Class</option>
                  @foreach($Sclass as $class)
                  <option value="{{ $class->id }}">{{ $class->name }}</option>
                  @endforeach
                </select>
              </div>

              <!-- Optional Student & Date -->
              <div class="col-md-6 form-group">
                <label>Select Student</label>
                <select name="student_id" class="form-control select2">
                  <option value="">-- All Students --</option>
                  @foreach($students as $student)
                  <option value="{{ $student->id }}">{{ $student->name }} - {{ $student->roll_no }}</option>
                  @endforeach
                </select>
              </div>

              <!-- Remarks -->
              <div class="col-12 form-group">
                <label>Remarks / Notes</label>
                <textarea name="remarks" class="form-control" rows="3" placeholder="Write something..."></textarea>
              </div>

              <!-- Submit Button -->
              <div class="col-12 text-right">
                <button type="submit" id="submit-button" class="btn btn-lg btn-primary px-4 py-2 font-weight-bold">
                  <span id="btn-text">Promote Now</span>
                  <span id="btn-spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                </button>
              </div>
            </div>
          </form>
        </div>

        @include('admin.include.footer')
      </div>
    </div>
  </div>

  <!-- JS -->
  <script src="{{ asset('public/admin/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('public/admin/js/plugins.js') }}"></script>
  <script src="{{ asset('public/admin/js/popper.min.js') }}"></script>
  <script src="{{ asset('public/admin/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('public/admin/js/select2.min.js') }}"></script>
  <script src="{{ asset('public/admin/js/datepicker.min.js') }}"></script>
  <script src="{{ asset('public/admin/js/jquery.scrollUp.min.js') }}"></script>
  <script src="{{ asset('public/admin/js/main.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script>
    $(function () {
      $('.select2').select2({ width: '100%' });
      $('.datepicker').datepicker({ format: 'dd-mm-yyyy', autoclose: true });

      $('#student_promotion').on('submit', function (e) {
        e.preventDefault();

        let fd = new FormData(this);

        $.ajax({
          url: "{{ route('admin.promote_new_class_student') }}",
          type: "POST",
          data: fd,
          dataType: 'json',
          processData: false,
          contentType: false,

          beforeSend: function () {
            $('#submit-button').prop('disabled', true);
            $('#btn-text').text('Saving...');
            $('#btn-spinner').removeClass('d-none');
          },

          success: function (result) {
            if (result.status) {
              toastr.success(result.msg);
              setTimeout(() => {
                window.location.href = result.location;
              }, 800);
            } else {
              toastr.error(result.msg);
            }
          },

          complete: function () {
            $('#btn-text').text('Promote Now');
            $('#btn-spinner').addClass('d-none');
            $('#submit-button').prop('disabled', false);
          },

          error: function (xhr) {
            console.log(xhr.responseText);
            toastr.error("Something went wrong. Please try again.");
            $('#btn-text').text('Promote Now');
            $('#btn-spinner').addClass('d-none');
            $('#submit-button').prop('disabled', false);
          }
        });
      });
    });
  </script>
</body>
</html>
