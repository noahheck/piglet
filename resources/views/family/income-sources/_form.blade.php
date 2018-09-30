@push('scripts')
    <script type="text/javascript" src="{{ asset('js/family.income-sources._form.js') }}"></script>
@endpush

<form name="incomeSource" action="{{ $action }}" method="POST" class="has-bold-labels">

    @csrf

    @if ($method)
        @method($method)
    @endif

    @formError

    <fieldset>
        <legend>{{ __('income-sources.details') }}</legend>

        <div class="form-group">
            <label for="name">{{ __('income-sources.name') }}</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('income-sources.name') }}" value="{{ old('name', $incomeSource->name) }}">
            @fieldError('name')
        </div>

        <div class="form-group">
            <label for="default_amount">{{ __('income-sources.default-amount') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                </div>
                <input type="text" name="default_amount" id="default_amount" class="form-control money-field" placeholder="{{ __('income-sources.default-amount') }}" value="{{ old('default_amount', App\formatCurrency($incomeSource->default_amount, false)) }}">
            </div>
            @fieldError('default_amount')
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="active" name="active" {{ ($incomeSource->active) ? "checked" : "" }}>
            <label class="form-check-label" for="active">
                {{ __('income-sources.active') }}
            </label>
        </div>

        <div class="form-group">
            <label for="description">{{ __('income-sources.description') }}</label>
            <textarea name="description" id="description" class="form-control" placeholder="{{ __('income-sources.description') }}" rows="3">{{ old('description', $incomeSource->description) }}</textarea>
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
