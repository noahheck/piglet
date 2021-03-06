<p class="task {{ ($task->isActive() && $task->isOverdue()) ? 'isOverdue' : '' }} {{ ($task->isActive() && $task->isDueToday()) ? 'isDueToday' : '' }}">

    @if ($task->isCompleted())
        <span class="fa fa-check-square-o"></span>
    @elseif ($task->isInactive())
        <span class="fa fa-minus-square-o"></span>
    @else
        <span class="fa fa-square-o"></span>
    @endif

    <a href="{{ route('family.tasks.edit', [$family, $taskList, $task]) }}">
        {{ $task->title }}
    </a>

    @if ($task->dueDate)
        <small class="dueDate">{{ App\formatDate($task->dueDate) }}</small>
    @endif

    @if ($task->member)
        {!! $task->member->icon() !!}
    @endif
</p>
