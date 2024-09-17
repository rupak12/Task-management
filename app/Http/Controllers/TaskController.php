<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view('task.list');
    }

    public function create()
    {
        return view('task.task-create');
    }

    public function edit($id)
    {
        return view('task.task-update', ['taskId' => $id]);
    }
}
