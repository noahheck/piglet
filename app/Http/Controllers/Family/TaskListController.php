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
        return view('family.taskLists.home', [
            'family' => $family,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
