<form action="{{ $action }}" method="POST" class="has-bold-labels">

    @csrf

    @if ($method)
        @method($method)
    @endif

    <fieldset>
        <legend>{{ $legend }}</legend>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="{{ old('title', $task->title) }}">
            @fieldError('title')
        </div>

        <div class="form-group">
            <label for="details">Details</label>
            <textarea name="details" id="details" class="form-control" placeholder="Details">{{ old('details', $task->details) }}</textarea>
            @fieldError('details')
        </div>

        <div class="form-group">
            <label for="dueDate">Due Date <small class="text-muted">mm/dd/yyyy</small></label>
            <input type="text" name="dueDate" id="dueDate" class="form-control dateField" placeholder="Due Date" value="{{ old('dueDate', Auth::user()->formatDate($task->dueDate)) }}">
            @fieldError('dueDate')
        </div>

        <div class="form-group">
            <label for="member_id">Person Responsible</label>
            <select name="member_id" id="member_id" class="custom-select">
                <option value="">Not Assigned</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}" {{ (string) $member->id === (string) old('member_id', $task->member_id) ? 'selected' : '' }}>{{ $member->firstName }} {{ $member->lastName }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" name="active" id="active" {{ ($task->active) ? ' checked' : '' }}>
            <label for="active">Active</label>
        </div>

        @if ($showComplete)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="completed" id="completed" {{ ($task->completed) ? ' checked' : '' }}>
                <label for="completed">Completed</label>
            </div>
        @endif

    </fieldset>

    <button type="submit" class="btn btn-primary">
        {{ __('form.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ $cancelRoute }}">
        {{ __('form.cancel') }}
    </a>

</form>
