<?php

namespace App\Http\Controllers;
use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
  public function index()
  {
    $devices = Task::latest()->paginate(100);
    if (Auth::guest()) {
      return view('auth.login');
    }
      return view('admins.admin', compact('devices'));

  }
}
