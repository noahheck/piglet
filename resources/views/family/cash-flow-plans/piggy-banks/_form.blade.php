@php
    $piggyBankTargets = \App\Family\PiggyBank::where([
    ['active', '=', true],
    ['completed', '=', false],
])->orderBy('dueDate')->get();
@endphp

@push('scripts')
    <script type="text/javascript" src="{{ mix('js/family.cash-flow-plans.piggy-banks._form.js') }}"></script>
@endpush

<form name="piggyBank" action="{{ $action }}" method="POST" class="has-bold-labels">

    @csrf

    @if ($method)
        @method($method)
    @endif

    @formError

    <fieldset>
        <legend>{{ __('piggy-banks.details') }}</legend>

        <div class="form-group">
            <label for="piggy_bank_id">{{ __('piggy-banks.piggy-bank') }}</label>
            <select class="custom-select" name="piggy_bank_id" id="piggy_bank_id">
                <option value="">{{ __('piggy-banks.select-piggy-bank') }}</option>

                @foreach ($piggyBankTargets as $target)
                    @php
                        $disabled = '';
                        $inUse    = '';

                        if ($cashFlowPlan->hasPiggyBank($target)) {
                            $disabled = 'disabled';
                            $inUse    = ' - ' . __('form.already-in-use');
                        }

                    @endphp
                    <option
                        value="{{ $target->id }}"
                        {{ $disabled }}
                        data-monthly-contribution="{{ App\FormatCurrency($target->monthly_contribution, false) }}"
                        {{ ($target->id == old('piggy_bank_id', $piggyBank->piggy_bank_id)) ? 'selected' : '' }}

                    >{{ $target->name }} - {{ App\formatCurrency($target->monthly_contribution, true) }} {{ $inUse }}</option>
                @endforeach

            </select>
            @fieldError('piggy_bank_id')
        </div>

        <div class="form-group">
            <label for="projected">{{ __('piggy-banks.projected-amount') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                </div>
                <input type="text" name="projected" id="projected" class="form-control money-field" placeholder="{{ __('piggy-banks.projected-amount') }}" value="{{ old('projected', App\formatCurrency($piggyBank->projected, false)) }}">
            </div>
            @fieldError('projected')
        </div>

        <div class="form-group">
            <label for="detail">{{ __('piggy-banks.details') }}</label>
            <textarea name="detail" id="detail" class="form-control" placeholder="{{ __('piggy-banks.details') }}" rows="3">{{ old('detail', $piggyBank->detail) }}</textarea>
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
