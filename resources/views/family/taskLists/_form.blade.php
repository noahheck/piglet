<div class="row justify-content-center">

    <div class="col-12 col-sm-10 col-md-6">

        <form action="{{ $action }}" method="POST" class="has-bold-labels">

            @csrf

            @if ($method)
                @method($method)
            @endif

            <fieldset>
                <legend>{{ $legend }}</legend>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="{{ old('title', $taskList->title) }}">
                    @fieldError('title')
                </div>

                <div class="form-group">
                    <label for="details">Details</label>
                    <textarea name="details" id="details" class="form-control" placeholder="Details">{{ old('details', $taskList->details) }}</textarea>
                    @fieldError('details')
                </div>

                <div class="form-group">
                    <label for="dueDate">Due Date <small class="text-muted">mm/dd/yyyy</small></label>
                    <input type="text" name="dueDate" id="dueDate" class="form-control dateField" placeholder="Due Date" value="{{ old('dueDate', Auth::user()->formatDate($taskList->dueDate)) }}">
                    @fieldError('dueDate')
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="active" id="active" {{ ($taskList->active) ? ' checked' : '' }}>
                    <label for="active">Active</label>
                </div>

            </fieldset>

            <div class="float-left">

                <button type="submit" class="btn btn-primary">
                    {{ __('form.save') }}
                </button>

                <a class="btn btn-secondary" href="{{ $cancelRoute }}">
                    {{ __('form.cancel') }}
                </a>
            </div>

        </form>

        @if ($showDelete)
            <form method="POST" action="{{ route('family.taskLists.destroy', [$family, $taskList]) }}" id="deleteTaskListForm" class="float-right">

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">
                    Delete
                </button>

            </form>
        @endif


    </div>

</div>
