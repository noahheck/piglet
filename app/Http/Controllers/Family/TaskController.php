<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Family\Task;
use App\Family\TaskList;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Family $family)
    {
        /*$tasks = Task::all();

        return view('family.tasks.home', [
            'family' => $family,
            'tasks'  => $tasks,
        ]);*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Family $family, TaskList $taskList)
    {
        $task = new Task();

        $task->task_list_id = $taskList->id;
        $task->active       = true;

        return view('family.tasks.new', [
            'family'   => $family,
            'taskList' => $taskList,
            'task'     => $task,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Family $family, TaskList $taskList, Request $request)
    {
        $request->validate(Task::getValidations());

        $task = new Task;

        $task->fill($request->only($task->getFillable()));
        $task->task_list_id = $taskList->id;
        $task->active = $request->has('active');

        $task->save();

        return redirect()->route('family.taskLists.show', [$family, $taskList]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family\Task  $familyTask
     * @return \Illuminate\Http\Response
     */
    public function show(Task $familyTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family\Task  $familyTask
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $familyTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family\Task  $familyTask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $familyTask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family\Task  $familyTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $familyTask)
    {
        //
    }
}
