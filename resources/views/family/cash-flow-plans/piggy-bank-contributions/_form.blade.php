@php
    /*$categories = \App\Family\Category::where('active', true)->orderBy('d_order')->get();

    $merchants = \App\Family\Merchant::orderBy('name')->get();*/
@endphp

@push('scripts')
    {{--<script type="text/javascript" src="{{ mix('js/family.cash-flow-plans.expenses._form.js') }}"></script>--}}
@endpush

<form name="expense" action="{{ $action }}" method="POST" class="has-bold-labels">

    @csrf

    @if ($method)
        @method($method)
    @endif

    @formError

    <fieldset>
        <legend>{{ __('expenses.details') }}</legend>

        <div class="form-group">
            <label for="piggy_bank_id">{{ __('piggy-banks.piggy-bank') }}</label>
            <select class="custom-select" name="piggy_bank_id" id="piggy_bank_id" {{ ($contribution->piggy_bank_id) ? '' : 'autofocus' }}>
                <option value="">{{ __('form.select-one') }}</option>
                @foreach ($piggyBanks as $piggyBank)
                    <option value="{{ $piggyBank->id }}" {{ (old('piggy_bank_id', $contribution->piggy_bank_id) == $piggyBank->id) ? 'selected' : '' }}>{{ $piggyBank->name }}</option>
                @endforeach
            </select>
            @fieldError('piggy_bank_id')
        </div>

        {{--<hr>--}}

        <div class="form-group">
            <label for="actual">{{ __('piggy-banks.contribution') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                </div>
                <input {{ ($contribution->piggy_bank_id) ? 'autofocus' : '' }} type="text" name="actual" id="actual" class="form-control money-field" placeholder="{{ __('piggy-banks.contribution') }}" value="{{ old('actual', App\formatCurrency($contribution->actual, false)) }}">
            </div>
            @fieldError('actual')
        </div>

        <div class="form-group">
            <label for="date">{{ __('piggy-banks.date') }} <small class="text-muted">mm/dd/yyyy</small></label>
            <input type="text" name="date" id="date" class="form-control dateField datepicker" placeholder="{{ __('piggy-banks.date') }}" value="{{ old('date', App\formatDate($contribution->date)) }}">
            @fieldError('date')
        </div>

        <div class="form-group">
            <label for="detail">{{ __('piggy-banks.detail') }}</label>
            <textarea name="detail" id="detail" class="form-control" placeholder="{{ __('piggy-banks.detail') }}" rows="3">{{ old('detail', $contribution->detail) }}</textarea>
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
