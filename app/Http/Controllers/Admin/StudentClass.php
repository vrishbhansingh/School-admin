<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentClass extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function all_class()
    {
       
      return view('admin.class.all-class');

    }
    
    
    public function add_class()
    {
       
      return view('admin.class.add-class');

    }
    
    public function class_routine()
    {
       
      return view('admin.class.class-routine');

    }
    
    public function transport()
    {
       
      return view('admin.transport.transport');

    }
    
    


}
