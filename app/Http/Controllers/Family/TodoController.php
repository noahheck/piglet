<?php

namespace App\Http\Controllers\Family;

use App\Family;
use App\Family\TodoProvider;
use App\Http\Controllers\Controller;
use App\Family\Todo;

use App\Http\Requests\Family\Todo\Store as StoreRequest;
use App\Http\Requests\Family\Todo\Update as UpdateRequest;

use App\Jobs\Family\Todo\Create;
use App\Jobs\Family\Todo\Update;
use Illuminate\Http\Request;
use function App\flashSuccess;
use function App\flashWarning;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @ return \Illuminate\Http\Response
     */
    public function index(Request $request, Family $family, TodoProvider $todoProvider)
    {
        $allTodos = $todoProvider->getTodosAccessibleByMember($request->user()->familyMember());

        $allTodos->load('createdBy');

        return view('family.todos.home', compact('family', 'allTodos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @ return \Illuminate\Http\Response
     */
    public function create(Family $family)
    {
        $todo = new Todo;
        $todo->active = true;
        $todo->private = false;

        return view('family.todos.new', compact('family', 'todo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @ return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Family $family)
    {
        $this->dispatchNow($todoCreated = new Create(
            $request->title,
            $request->due_date,
            $request->details,
            $request->has('private'),
            $request->user()->familyMember()
        ));

        flashSuccess('todos.todo-created');

        if ($return = $request->return) {

            return redirect($return);
        }

        return redirect()->route('family.home', [$family]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Family\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Family $family, Todo $todo)
    {
        abort_unless($request->user()->can('view', $todo), 403);

        $todo->load('createdBy');

        return view('family.todos.show', compact('family', 'todo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Family\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Family $family, Todo $todo)
    {
        abort_unless($request->user()->can('update', $todo), 403);

        return view('family.todos.edit', compact('family', 'todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Family\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Family $family, Todo $todo)
    {
        abort_unless($request->user()->can('update', $todo), 403);

        $this->dispatchNow($todoUpdated = new \App\Jobs\Family\Todo\Update(
            $todo,
            $request->title,
            $request->due_date,
            $request->details,
            $request->has('private'),
            $request->has('active')
        ));

        flashSuccess('todos.todo-updated');

        if ($return = $request->return) {

            return redirect($return);
        }

        return redirect()->route('family.home', [$family]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Family\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Family $family, Todo $todo)
    {
        abort_unless($request->user()->can('delete', $todo), 403);

        $todo->delete();

        flashWarning('todos.todo-deleted');

        return redirect()->route('family.home', [$family]);
    }


    public function complete(Request $request, Family $family, Todo $todo)
    {
        abort_unless($request->user()->can('update', $todo), 403);

        $today = $request->user()->today()->format("m/d/Y");

        $todo->completed = $today;
        $todo->save();

        if ($return = $request->return) {

            return redirect($return);
        }

        return redirect()->route('family.home', [$family]);
    }

    public function uncomplete(Request $request, Family $family, Todo $todo)
    {
        abort_unless($request->user()->can('update', $todo), 403);

        $todo->completed = null;
        $todo->save();

        if ($return = $request->return) {

            return redirect($return);
        }

        return redirect()->route('family.home', [$family]);
    }
}
