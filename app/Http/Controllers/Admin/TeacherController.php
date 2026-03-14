<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

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

  public function add_teacher_data(Request $request)
  {
    $validator = Validator::make($request->all(), [

      'teacher_name' => 'required|string|max:255',
      'email' => 'required|email|unique:teachers,email',
      'phone' => 'required|string|max:20|unique:teachers,phone',
      'gender' => 'required|in:M,F,O',
      'dob' => 'nullable|date',
      'blood_group' => 'nullable|string|max:5',
      'qualification' => 'nullable|string|max:255',
      'experience' => 'nullable|string|max:50',
      'joining_date' => 'nullable|date',
      'address' => 'nullable|string',
      'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'

    ]);

    if ($validator->fails()) {

      return response()->json([
        'status' => false,
        'errors' => $validator->errors()
      ], 422);
    }

    $teacher = new Teacher();

    $lastTeacher = Teacher::orderBy('id', 'desc')->first();

    if ($lastTeacher) {
      $lastNumber = (int) substr($lastTeacher->id_no, 3); // remove TCH
      $nextNumber = $lastNumber + 1;
    } else {

      $nextNumber = 1;
    }

    $id_no = 'TCH' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

    $teacher->id_no = $id_no;
    $teacher->school_id = Auth::guard('admin')->user()->school_id;
    $teacher->teacher_name = $request->input('teacher_name');
    $teacher->email = $request->input('email');
    $teacher->phone = $request->input('phone');
    $teacher->gender = $request->input('gender');
    $teacher->address = $request->input('address');
    $teacher->dob = $request->input('dob');
    $teacher->qualification = $request->input('qualification');
    $teacher->experience = $request->input('experience');
    $teacher->joining_date = $request->input('joining_date');
    $teacher->blood_group = $request->input('blood_group');
    // Set other fields as necessary

    if ($request->hasFile('profile_image')) {
      $image = $request->file('profile_image');
      $imageName = time() . '_' . $image->getClientOriginalName();
      $image->move(public_path('uploads/teachers'), $imageName);
      $teacher->profile_image = $imageName;
    }

    $result = $teacher->save();

    if ($result) {
      return response()->json([
        'message' => 'Teacher added successfully'
      ]);
    } else {
      return response()->json([
        'message' => 'Failed to add teacher'
      ], 500);
    }
  }
  public function update_teacher(Request $request)
  {
    $teacher = Teacher::find($request->teacher_id);
    if (!$teacher) {

      return response()->json([
        'message' => 'Teacher not found'
      ], 404);
    }

    $teacher->teacher_name = $request->teacher_name;
    $teacher->email = $request->email;
    $teacher->phone = $request->phone;
    $teacher->gender = $request->gender;
    $teacher->address = $request->address;
    $teacher->dob = $request->dob;
    $teacher->qualification = $request->qualification;
    $teacher->experience = $request->experience;
    $teacher->joining_date = $request->joining_date;
    $teacher->blood_group = $request->blood_group;

    // Image Upload
    if ($request->hasFile('profile_image')) {

      if ($teacher->profile_image && file_exists(public_path('uploads/teachers/' . $teacher->profile_image))) {

        unlink(public_path('uploads/teachers/' . $teacher->profile_image));
      }

      $image = $request->file('profile_image');
      $imageName = time() . '_' . $image->getClientOriginalName();
      $image->move(public_path('uploads/teachers'), $imageName);

      $teacher->profile_image = $imageName;
    }

    $result = $teacher->update();

    if ($result) {
      return response()->json([
        'message' => 'Teacher updated successfully'
      ]);
    } else {
      return response()->json([
        'message' => 'Failed to update teacher'
      ], 500);
    }
  }

  public function update_teacher_status(Request $request)
  {

    $teacher = Teacher::where('id', $request->id)->first();

    if (!$teacher) {
      return response()->json(['error' => 'Teacher not found']);
    }
    if ($request->status == 1) {
      $teacher->status = 'Active';
    } else {
      $teacher->status = 'Inactive';
    }
    $result = $teacher->update();

    if ($result) {
      return response()->json(['success' => true]);
    }
  }
}
