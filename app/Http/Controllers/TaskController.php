<?php
namespace App\Http\Controllers;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\Location;

class TaskController extends Controller
{

  public function index()
  {
      //return view('tasks.task');
  }

  public function store(TaskValidation $request)
    {
      $task = Task::create([
      'user_id' => auth()->id(),
      'deviceId' => $request->input('deviceId'),
      'latitude' => $request->input('latitude'),
      'longitude' => $request->input('longitude'),
      'type' => $request->input('type'),
    ]);
      if ($request->input('type') === 'work') {
        Mail::to(Auth::user()->email)->send(new Location($task));
    }
      return redirect()->route('home')->with('success', 'Coordinates has been sent to database.');
    }
}
