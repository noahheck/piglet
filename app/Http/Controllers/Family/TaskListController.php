<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Family\TaskList;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class TaskListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Family $family)
    {
        $taskLists = TaskList::all();

        return view('family.taskLists.home', [
            'family'    => $family,
            'taskLists' => $taskLists,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Family $family)
    {
        $taskList = new TaskList(['active' => true]);

        return view('family.taskLists.new', [
            'family'   => $family,
            'taskList' => $taskList,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Family $family, Request $request)
    {
        $request->validate(TaskList::getValidations());

        $taskList = new TaskList();
        $taskList->fill($request->only($taskList->getFillable()));

        $taskList->save();

        return redirect()->route('family.taskLists.show', [$family, $taskList]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family\TaskList  $taskList
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family, TaskList $taskList)
    {
        return view('family.taskLists.show', [
            'family'   => $family,
            'taskList' => $taskList,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family\TaskList  $taskList
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family, TaskList $taskList)
    {
        return view('family.taskLists.edit', [
            'family'   => $family,
            'taskList' => $taskList,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family\TaskList  $familyTaskList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family, TaskList $taskList)
    {
        $request->validate($taskList->getValidations());

        $taskList->fill($request->only($taskList->getFillable()));

        $taskList->active = $request->has('active');

        $taskList->save();

        return redirect()->route('family.taskLists.show', [$family, $taskList]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family\TaskList  $familyTaskList
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskList $familyTaskList)
    {
        //
    }
}
