@php
    $categories = \App\Family\Category::where('active', true)->orderBy('d_order')->get();

    $merchants = \App\Family\Merchant::orderBy('name')->get();
@endphp

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/family.cash-flow-plans.expenses._form.js') }}"></script>
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
            <label for="description">{{ __('expenses.description') }}</label>
            <input type="text" name="description" id="description" class="form-control" placeholder="{{ __('expenses.description') }}" value="{{ old('description', $expense->description) }}">
            @fieldError('description')
        </div>

        <div class="form-group">
            <label for="expense_group_id">{{ __('expense-groups.expense-group') }}</label>
            <select class="custom-select" name="expense_group_id" id="expense_group_id">
                <option value="">-- None --</option>
                @foreach ($cashFlowPlan->expenseGroups as $expenseGroup)
                    <option value="{{ $expenseGroup->id }}" data-category="{{ $expenseGroup->category_id }}" data-sub-category="{{ $expenseGroup->sub_category }}" {{ (old('expense_group_id', $expense->expense_group_id) == $expenseGroup->id) ? 'selected' : '' }}>{{ $expenseGroup->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="projected">{{ __('expenses.projected') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                </div>
                <input type="text" name="projected" id="projected" class="form-control money-field" placeholder="{{ __('expenses.projected') }}" value="{{ old('projected', Auth::user()->formatCurrency($expense->projected, false)) }}">
            </div>
            @fieldError('projected')
        </div>

        <hr>

        <div class="form-group">
            <label for="actual">{{ __('expenses.actual') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                </div>
                <input type="text" name="actual" id="actual" class="form-control money-field" placeholder="{{ __('expenses.actual') }}" value="{{ old('actual', Auth::user()->formatCurrency($expense->actual, false)) }}">
            </div>
            @fieldError('actual')
        </div>

        <div class="form-group">
            <label for="date">{{ __('expenses.date') }} <small class="text-muted">mm/dd/yyyy</small></label>
            <input type="text" name="date" id="date" class="form-control dateField datepicker" placeholder="{{ __('expenses.date') }}" value="{{ old('date', Auth::user()->formatDate($expense->date)) }}">
            @fieldError('date')
        </div>

        <div class="form-group">
            <label for="merchant_id">{{ __('expenses.merchant') }}</label>
            <select class="custom-select" name="merchant_id" id="merchant_id">
                <option value="">Select One</option>
                @foreach ($merchants as $merchant)
                    <option value="{{ $merchant->id }}" data-category="{{ $merchant->default_category_id }}" data-sub-category="{{ $merchant->default_sub_category }}" {{ (old('merchant_id', $expense->merchant_id) == $merchant->id) ? 'selected' : '' }}>{{ $merchant->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="category_id">{{ __('expenses.category') }}</label>
            <select class="custom-select" name="category_id" id="category_id">
                <option value="">--</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" data-options="{{ implode('|', $category->sub_categories) }}" {{ (old('category_id', ($expense->category_id) ? $expense->category_id : '') == $category->id) ? "selected" : "" }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @fieldError('category_id')
        </div>

        <div class="form-group">
            <label for="sub_category">{{ __('expenses.sub-category') }}</label>
            <select class="custom-select" name="sub_category" id="sub_category">
                <option value="">--</option>
                @if (old('sub_category', $expense->sub_category))
                    <option selected value="{{ old('sub_category', $expense->sub_category) }}">{{ old('sub_category', $expense->sub_category) }}</option>
                @endif
            </select>
            @fieldError('sub_category')
        </div>

        <div class="form-group">
            <label for="payment_detail">{{ __('expenses.payment-detail') }}</label>
            <input type="text" name="payment_detail" id="payment_detail" class="form-control" placeholder="{{ __('expenses.payment-detail') }}" value="{{ old('payment_detail', $expense->payment_detail) }}">
            @fieldError('payment_detail')
        </div>

        <div class="form-group">
            <label for="detail">{{ __('expenses.detail') }}</label>
            <textarea name="detail" id="detail" class="form-control" placeholder="{{ __('expenses.detail') }}" rows="3">{{ old('detail', $expense->detail) }}</textarea>
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
