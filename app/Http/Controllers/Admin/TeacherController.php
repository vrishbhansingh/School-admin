<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

  public function edit_teacher($id)
  {
    $teacher = Teacher::find($id);
    if ($teacher) {
      return view('admin.teacher.edit-teacher', compact('teacher'));
    } else {
      return redirect()->route('admin.teacher_list')->with('error', 'Teacher not found');
    }
  }

  public function teacher_payments()
  {
    return view('admin.teacher.teacher-payment');
  }

  public function get_teachers_data()
  {
    $school_id = Auth::guard('admin')->user()->school_id;

    $data = Teacher::where('school_id', $school_id)->get();
    if ($data) {
      return response()->json($data);
    } else {
      return response()->json(['message' => 'No teachers found'], 404);
    }
  }
}
