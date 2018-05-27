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

        /**
         * @todo Change route to the newly created taskList
         */
        return redirect()->route('family.taskLists.index', [$family]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family\TaskList  $familyTaskList
     * @return \Illuminate\Http\Response
     */
    public function show(TaskList $familyTaskList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family\TaskList  $familyTaskList
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskList $familyTaskList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family\TaskList  $familyTaskList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskList $familyTaskList)
    {
        //
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
