<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function teacher_list()
    {
       
      return view('admin.teacher.teacher-list');

    }

    public function teacher_details()
    {
      return view('admin.teacher.teacher-details');
    }

    public function add_teacher()
    {
      return view('admin.teacher.add-teacher');
    }

    public function teacher_payments()
    {
      return view('admin.teacher.teacher-payment');
    }


}
