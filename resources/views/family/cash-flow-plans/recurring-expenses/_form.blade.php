@php

$categories                = \App\Family\Category::where('active', true)->orderBy('name')->get();
$merchants                 = \App\Family\Merchant::orderBy('name')->get();

$recurringExpenseTemplates = \App\Family\RecurringExpense::where('active', true)->orderBy('name')->with(['merchant'])->get();

@endphp

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/family.cash-flow-plans.recurring-expenses._form.js') }}"></script>
@endpush

<form name="incomeSource" action="{{ $action }}" method="POST" class="has-bold-labels">

    @csrf

    @if ($method)
        @method($method)
    @endif

    @formError

    <fieldset>
        <legend>{{ __('recurring-expenses.details') }}</legend>

        <div class="form-group">
            <label for="type">{{ __('recurring-expenses.recurring-expense') }} {{ __('cash-flow-plans.type') }}</label>
            <select class="custom-select" name="type" id="type">
                @foreach ($recurringExpense::$typeDescriptions as $type => $description)
                    <option value="{{ $type }}" {{ (old('type', $recurringExpense->type) === $type) ? 'selected' : '' }}>{{ $description }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="recurring_expense_id">{{ __('recurring-expenses.recurring-expense') }}</label>
            <select class="custom-select" name="recurring_expense_id" id="recurring_expense_id">

                <option value="">Select a recurring expense</option>

                @foreach ($categories as $category)
                    @continue($recurringExpenseTemplates->where('category_id', $category->id)->count() === 0)
                    <optgroup label="{{ $category->name }}">

                        @foreach ($recurringExpenseTemplates->where('category_id', $category->id) as $template)
                            <option
                                value="{{ $template->id }}"
                                data-merchant-id="{{ $template->merchant_id }}"
                                data-default-amount="{{ $template->default_amount }}"
                                data-category="{{ $template->category_id }}"
                                data-sub-category="{{ $template->sub_category }}"
                                data-name="{{ $template->name }}"
                                data-description="{{ $template->description }}"
                            >{{ $template->name }}</option>
                        @endforeach

                    </optgroup>
                @endforeach

            </select>
        </div>

        <hr>

        <div class="form-group">
            <label for="name">{{ __('recurring-expenses.name') }}</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('recurring-expenses.name') }}" value="{{ old('name', $recurringExpense->name) }}" readonly>
            @fieldError('name')
        </div>

        <div class="form-group">
            <label for="merchant_id_select">{{ __('recurring-expenses.merchant') }}</label>
            <input type="hidden" name="merchant_id" id="merchant_id" value="{{ old('merchant_id', $recurringExpense->merchant_id) }}">
            <select class="custom-select" name="merchant_id_select" id="merchant_id_select" disabled>
                <option value="">--</option>
                @foreach ($merchants as $merchant)
                    <option value="{{ $merchant->id }}">{{ $merchant->name }}</option>
                @endforeach
            </select>
            @fieldError('merchant_id')
        </div>

        <div class="form-group">
            <label for="category_id_select">{{ __('recurring-expenses.category') }}</label>
            <input type="hidden" name="category_id" id="category_id" value="{{ old('category_id', $recurringExpense->category_id) }}">
            <select class="custom-select" name="category_id_select" id="category_id_select" disabled>
                <option value="">--</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @fieldError('category_id')
        </div>

        <div class="form-group">
            <label for="sub_category">{{ __('recurring-expenses.sub-category') }}</label>
            <input type="text" name="sub_category" id="sub_category" class="form-control" placeholder="{{ __('recurring-expenses.sub-category') }}" value="{{ old('sub_category', $recurringExpense->sub_category) }}" readonly>
            @fieldError('sub_category')
        </div>

        <hr>

        <div class="form-group">
            <label for="amount">{{ __('recurring-expenses.amount') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                </div>
                <input type="text" name="amount" id="amount" class="form-control money-field" placeholder="{{ __('recurring-expenses.amount') }}" value="{{ old('amount', Auth::user()->formatCurrency($recurringExpense->amount, false)) }}">
            </div>
            @fieldError('amount')
        </div>


        <div class="form-group actual-field">
            <label for="date">{{ __('recurring-expenses.date') }} <small class="text-muted">mm/dd/yyyy</small></label>
            <input type="text" name="date" id="date" class="form-control dateField datepicker" placeholder="{{ __('recurring-expenses.date') }}" value="{{ old('date', Auth::user()->formatDate($recurringExpense->date)) }}">
            @fieldError('date')
        </div>

        <div class="form-group actual-field">
            <label for="payment_detail">{{ __('recurring-expenses.payment-detail') }}</label>
            <input type="text" name="payment_detail" id="payment_detail" class="form-control" placeholder="{{ __('recurring-expenses.payment-detail') }}" value="{{ old('payment_detail', $recurringExpense->payment_detail) }}">
            @fieldError('payment_detail')
        </div>


        <div class="form-group">
            <label for="detail">{{ __('recurring-expenses.details') }}</label>
            <textarea name="detail" id="detail" class="form-control" placeholder="{{ __('recurring-expenses.details') }}" rows="3">{{ old('detail', $recurringExpense->detail) }}</textarea>
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
