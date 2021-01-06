<?php

namespace App\Family;

class TodoProvider
{
    /**
     * @var Todo
     */
    private $todoModel;

    public function __construct(Todo $todoModel)
    {
        $this->todoModel = $todoModel;
    }

    public function getTodosAccessibleByMember(Member $member)
    {
        $todos = $this->todoModel
                ->ordered()
                ->where('private', false)
                ->orWhere(function($query) use ($member) {
                    $query->where('private', true)
                        ->where('created_by', $member->id);
                })
                ->get();

        return $todos;
    }
}
