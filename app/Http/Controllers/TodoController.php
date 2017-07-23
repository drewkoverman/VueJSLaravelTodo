<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TodoController extends Controller
{
    public function index() {
      $task = Todo::all();
      return $task;
    }

    public function show($id) {
      $task = Todo::find($id);
      return $task;
    }

    public function store(Request $request) {

      $this->validate($request, [
        'title' => 'required|max:50'
      ]);

      $task = new Todo;

      $task->title = $request->input('title');
      $task->completed = $request->input('completed');

      $task->save();

      return $request->all();
    }

    public function destroy($id) {
      $task = Todo::find($id);

      if($task) {
        $task->delete();
      }

      return "Record deleted #". $id;
    }
}
