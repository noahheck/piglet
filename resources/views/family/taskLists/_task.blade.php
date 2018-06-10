<p>
    <input type="checkbox" {{ ($task->completed) ? ' checked' : '' }} data-task-id="{{ $task->id }}">
    <a href="{{ route('family.tasks.edit', [$family, $taskList, $task]) }}">
        {{ $task->title }}
    </a>
    @if ($task->dueDate)
        <small class="text-muted">{{ Auth::user()->formatDate($task->dueDate) }}</small>
    @endif

    @if ($task->member)
        {!! $task->member->icon() !!}
    @endif
</p>
