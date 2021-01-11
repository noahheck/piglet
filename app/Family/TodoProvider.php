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

    public function getPendingTodosForMember(Member $member)
    {
        $todos = $this->todoModel
            ->ordered()
            ->whereNull('completed')
            ->where('active', true)
            ->where('created_by', $member->id)
            ->get();

        return $todos;
    }

    public function getTodosForMemberCompletedOnDate(Member $member, $date)
    {
        $todos = $this->todoModel
            ->ordered()
            ->where('completed', $date->format('m/d/Y'))
            ->where('created_by', $member->id)
            ->get();

        return $todos;
    }

    public function getOverdueTodosForMember(Member $member, $date)
    {
        $todaysDate = $date->format('m/d/Y');

        $todos = $this->todoModel
            ->ordered()
            ->whereNull('completed')
            ->where('active', true)
            ->where('created_by', $member->id)
            ->where('due_date', '<', $todaysDate)
            ->get();

        return $todos;
    }

    public function getDueTodayTodosForMember(Member $member, $date)
    {
        $todaysDate = $date->format('m/d/Y');

        $todos = $this->todoModel
            ->ordered()
            ->whereNull('completed')
            ->where('active', true)
            ->where('created_by', $member->id)
            ->where('due_date', '=', $todaysDate)
            ->get();

        return $todos;
    }
}
