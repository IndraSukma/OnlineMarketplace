<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageController extends Controller
{
    publuc function dashboard()
    {
      return view('manage.dashboard');
    }
}
