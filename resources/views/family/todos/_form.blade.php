{{--@push('scripts')
    <script type="text/javascript" src="{{ mix('js/family.events._form.js') }}"></script>
@endpush--}}

<form name="event" action="{{ $action }}" method="POST" class="has-bold-labels" autocomplete="off">

    @csrf

    @if ($method)
        @method($method)
    @endif

    <input type="hidden" name="return" value="{{ old('return', url()->previous()) }}">

    @formError

    <fieldset>
        <legend>{{ __('events.details') }}</legend>

        <div class="form-group">
            <label for="title">{{ __('todos.title') }}</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="{{ __('todos.title') }}" value="{{ old('title', $todo->title) }}" autofocus>
            @fieldError('title')
        </div>


        <div class="row">

            <div class="col-6">

                <div class="form-group">
                    <label for="due_date">{{ __('todos.due_date') }} <small class="text-muted">mm/dd/yyyy</small></label>
                    <input type="text" name="due_date" id="due_date" class="form-control datepicker" placeholder="{{ __('todos.due_date') }}" value="{{ old('due_date', $todo->due_date) }}">
                    @fieldError('due_date')
                </div>

            </div>

        </div>

        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="private" id="private" {{ $todo->isPrivate() ? 'checked' : '' }} value="1">
            <label class="form-check-label ml-2" for="private">
                {{ __('todos.private') }}
            </label>
            <small class="text-muted">{{ __('todos.private_description') }}</small>
        </div>

        @if ($todo->id)
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="active" id="active" {{ $todo->active ? 'checked' : '' }} value="1">
                <label class="form-check-label ml-2" for="active">
                    {{ __('todos.active') }}
                </label>
            </div>
        @endif

        <div class="form-group">
            <label for="details">{{ __('todos.details') }}</label>
            <textarea name="details" id="details" class="form-control" placeholder="{{ __('todos.details') }}" rows="3">{{ old('details', $todo->details) }}</textarea>
            @fieldError('details')
        </div>

    </fieldset>

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('form.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ $cancelRoute }}">
        {{ __('form.cancel') }}
    </a>

</form>
