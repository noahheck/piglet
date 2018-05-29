<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Family\Task;
use App\Family\TaskList;
use App\Family\Member;
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

        $members = Member::all();

        return view('family.tasks.new', [
            'family'   => $family,
            'taskList' => $taskList,
            'task'     => $task,
            'members'  => $members,
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
    public function edit(Family $family, TaskList $taskList, Task $task)
    {
        $members = Member::all();

        return view('family.tasks.edit', [
            'family'   => $family,
            'taskList' => $taskList,
            'task'     => $task,
            'members'  => $members,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family\Task  $familyTask
     * @return \Illuminate\Http\Response
     */
    public function update(Family $family, TaskList $taskList, Task $task, Request $request)
    {
        $request->validate(Task::getValidations());

        $task->fill($request->only($task->getFillable()));

        $task->active = $request->has('active');

        $task->save();

        return redirect()->route('family.taskLists.show', [$family, $taskList]);
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
