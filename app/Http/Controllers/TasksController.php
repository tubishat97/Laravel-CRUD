<?php

namespace App\Http\Controllers;

use App\Mirror;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TasksController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
     */
    public function deleteModal($id)
    {
        $task = Task::find($id);
        return view('todo.delete-modal',compact('task'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);
        $todo =  Task::create($request->all());

        $inserts[] =
            [
                'id'=>$todo->id,
                'name' => $todo->name,
                'description' => $todo->description,
                'created_at' => $todo->created_at,
                'updated_at' => $todo->updated_at ,
            ];
        DB::table('mirrors')->insert($inserts);

        Session::flash('success', 'Task successfully added!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        return view('todo.edit-task-form',compact('task'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $mirror = Mirror::findOrFail($id);
        $input = $request->all();
        $task->fill($input)->save();
        $mirror->fill($input)->save();


        Session::flash('success', 'Task successfully Edited!');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $mirror = Mirror::find($id);
        $task->delete();
        $mirror->delete();
        Session::flash('warning', 'Task successfully deleted!');
        return redirect()->back();

    }
}
