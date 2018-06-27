<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
class TasksController extends Controller
{
    public function index(){
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function store(){
        request()->validate([
            'name'        => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        Task::create(request()->only('name', 'description'));

        return back();
    }
}
