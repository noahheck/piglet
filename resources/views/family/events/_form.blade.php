@push('scripts')
    <script type="text/javascript" src="{{ mix('js/family.events._form.js') }}"></script>
@endpush

<form name="event" action="{{ $action }}" method="POST" class="has-bold-labels">

    @csrf

    @if ($method)
        @method($method)
    @endif

    @formError

    <fieldset>
        <legend>{{ __('events.details') }}</legend>

        <div class="form-group">
            <label for="title">{{ __('events.title') }}</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="{{ __('events.title') }}" value="{{ old('title', $event->title) }}" autofocus>
            @fieldError('title')
        </div>

        <div class="row">

            <div class="col-6">

                <div class="form-group">
                    <label for="date">{{ __('events.date') }} <small class="text-muted">mm/dd/yyyy</small></label>
                    <input type="text" name="date" id="date" class="form-control datepicker" placeholder="{{ __('events.date') }}" value="{{ old('date', $event->date) }}">
                    @fieldError('date')
                </div>

            </div>

            <div class="col-6">

                <div class="form-group">
                    <label class="form-check-label float-right" for="all_day">
                        <input class="form-check-input" type="checkbox" value="1" id="all_day" name="all_day" {{ (old('all_day', $event->all_day)) ? "checked" : "" }}>
                        {{ __('events.all_day') }}
                    </label>
                    <label for="time">{{ __('events.time') }}</label>
                    <input type="text" name="time" id="time" class="form-control timepicker" placeholder="HH:MM AM" value="{{ old('time', $event->time) }}">
                    @fieldError('time')
                </div>

            </div>

        </div>

        <div class="form-group">
            <label for="details">{{ __('events.details') }}</label>
            <textarea name="details" id="details" class="form-control" placeholder="{{ __('events.details') }}" rows="3">{{ old('details', $event->details) }}</textarea>
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
