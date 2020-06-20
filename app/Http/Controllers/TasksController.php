<?php

namespace App\Http\Controllers;

use App\Mirror;
use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::latest()->paginate(5);

        return view('todo.todo-crud',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.add-task-form');
    }

    /**
     * Show the modal for deleting a new task.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteModal($id)
    {
        $task = Task::find($id);
        return view('todo.delete-modal',compact('task'));
    }

    /**
     * Show the modal for deleting a new task.
     *
     * @return \Illuminate\Http\Response
     */
    public function showEditForm()
    {
        return view('todo.edit-task-form');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Task::updateOrCreate(['name' => $request->name, 'description' => $request->description]);
        Mirror::updateOrCreate(['name' => $request->name, 'description' => $request->description]);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return back();
    }
}
