@push('scripts')
    {{--<script type="text/javascript" src="{{ mix('js/family.merchants._form.js') }}"></script>--}}
@endpush

@php
// $categories = \App\Family\Category::where('active', true)->orderBy('d_order')->get();
@endphp

<form name="piggyBank" action="{{ $action }}" method="POST" class="has-bold-labels">

    @csrf

    @if ($method)
        @method($method)
    @endif

    @formError

    <fieldset>
        <legend>{{ __('piggy-banks.details') }}</legend>

        <div class="form-group">
            <label for="name">{{ __('piggy-banks.name') }}</label>
            <input autofocus type="text" name="name" id="name" class="form-control" placeholder="{{ __('piggy-banks.name') }}" value="{{ old('name', $piggyBank->name) }}">
            @fieldError('name')
        </div>

        <div class="form-group">
            <label for="default_amount">{{ __('piggy-banks.starting-amount') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                </div>
                <input type="text" name="starting_amount" id="starting_amount" class="form-control money-field" placeholder="{{ __('piggy-banks.starting-amount') }}" value="{{ old('starting_amount', App\formatCurrency($piggyBank->starting_amount, false)) }}">
            </div>
            @fieldError('starting_amount')
        </div>

        <div class="form-group">
            <label for="default_amount">{{ __('piggy-banks.target-amount') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                </div>
                <input type="text" name="target_amount" id="target_amount" class="form-control money-field" placeholder="{{ __('piggy-banks.target-amount') }}" value="{{ old('target_amount', App\formatCurrency($piggyBank->target_amount, false)) }}">
            </div>
            @fieldError('target_amount')
        </div>

        <div class="form-group">
            <label for="monthly_contribution">{{ __('piggy-banks.monthly-contribution') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                </div>
                <input type="text" name="monthly_contribution" id="monthly_contribution" class="form-control money-field" placeholder="{{ __('piggy-banks.monthly-contribution') }}" value="{{ old('monthly_contribution', App\formatCurrency($piggyBank->monthly_contribution, false)) }}">
            </div>
            @fieldError('monthly_contribution')
        </div>

        <div class="form-group">
            <label for="dueDate">{{ __('piggy-banks.dueDate') }} <small class="text-muted">mm/dd/yyyy</small></label>
            <input type="text" name="dueDate" id="dueDate" class="form-control dateField datepicker" placeholder="{{ __('piggy-banks.dueDate') }}" value="{{ old('dueDate', App\formatDate($piggyBank->dueDate)) }}">
            @fieldError('dueDate')
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="active" name="active" {{ ($piggyBank->active) ? "checked" : "" }}>
            <label class="form-check-label" for="active">
                {{ __('piggy-banks.active') }}
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="completed" name="completed" {{ ($piggyBank->completed) ? "checked" : "" }}>
            <label class="form-check-label" for="completed">
                {{ __('piggy-banks.completed') }}
            </label>
        </div>

        <div class="form-group">
            <label for="description">{{ __('piggy-banks.description') }}</label>
            <textarea name="description" id="description" class="form-control" placeholder="{{ __('piggy-banks.description') }}" rows="3">{{ old('description', $piggyBank->description) }}</textarea>
            @fieldError('description')
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
