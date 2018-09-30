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
            <label for="income_source_id">{{ __('income-sources.income-source') }}</label>
            <select class="custom-select" name="income_source_id" id="income_source_id">
                <option value="">{{ __('income-sources.select-income-source') }}</option>
                @foreach ($incomeSourceTemplates as $template)
                    <option value="{{ $template->id }}" data-default-amount="{{ App\formatCurrency($template->default_amount, false) }}" data-name="{{ $template->name }}" {{ ($template->id == old('income_source_id', $incomeSource->income_source_id)) ? 'selected' : '' }}>{{ $template->name }} ({{ App\formatCurrency($template->default_amount, true) }})</option>
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
            <label for="projected">{{ __('income-sources.projected') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                </div>
                <input type="text" name="projected" id="projected" class="form-control money-field" placeholder="{{ __('income-sources.projected') }}" value="{{ old('projected', App\formatCurrency($incomeSource->projected, false)) }}">
            </div>
            @fieldError('projected')
        </div>

        <hr>

        <div class="form-group">
            <label for="actual">{{ __('income-sources.actual') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                </div>
                <input type="text" name="actual" id="actual" class="form-control money-field" placeholder="{{ __('income-sources.actual') }}" value="{{ old('actual', App\formatCurrency($incomeSource->actual, false)) }}">
            </div>
            @fieldError('actual')
        </div>

        <div class="form-group">
            <label for="date">{{ __('income-sources.date') }} <small class="text-muted">mm/dd/yyyy</small></label>
            <input type="text" name="date" id="date" class="form-control dateField datepicker" placeholder="{{ __('income-sources.date') }}" value="{{ old('date', Auth::user()->formatDate($incomeSource->date)) }}">
            @fieldError('date')
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
