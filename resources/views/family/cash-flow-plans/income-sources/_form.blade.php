@php

$incomeSourceTemplates = \App\Family\IncomeSource::where('active', true)->get();

@endphp

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/family.cash-flow-plans.income-sources._form.js') }}"></script>
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
            <label for="type">{{ __('income-sources.income-source') }} {{ __('cash-flow-plans.type') }}</label>
            <select class="custom-select" name="type" id="type">
                @foreach ($incomeSource::$typeDescriptions as $type => $description)
                    <option value="{{ $type }}" {{ (old('type', $incomeSource->type) === $type) ? 'selected' : '' }}>{{ $description }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="income_source_id">{{ __('income-sources.income-source') }}</label>
            <select class="custom-select" name="income_source_id" id="income_source_id">
                @foreach ($incomeSourceTemplates as $template)
                    <option value="{{ $template->id }}" data-default-amount="{{ Auth::user()->formatCurrency($template->default_amount, false) }}" data-name="{{ $template->name }}">{{ $template->name }} ({{ Auth::user()->formatCurrency($template->default_amount, true) }})</option>
                @endforeach
                <option value="">{{ __('form.other') }}</option>
            </select>
        </div>

        <div class="form-group">
            <label for="name">{{ __('income-sources.name') }}</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('income-sources.name') }}" value="{{ old('name', $incomeSource->name) }}">
            @fieldError('name')
        </div>

        <div class="form-group">
            <label for="amount">{{ __('income-sources.amount') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                </div>
                <input type="text" name="amount" id="amount" class="form-control money-field" placeholder="{{ __('income-sources.amount') }}" value="{{ old('amount', Auth::user()->formatCurrency($incomeSource->amount, false)) }}">
            </div>
            @fieldError('amount')
        </div>

        <div class="form-group">
            <label for="detail">{{ __('income-sources.details') }}</label>
            <textarea name="detail" id="detail" class="form-control" placeholder="{{ __('income-sources.details') }}" rows="3">{{ old('detail', $incomeSource->detail) }}</textarea>
            @fieldError('detail')
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