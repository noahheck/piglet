@php
    $categories = \App\Family\Category::where('active', true)->orderBy('d_order')->get();

    $merchants = \App\Family\Merchant::orderBy('name')->get();
@endphp

@push('stylesheets')
    <link rel="stylesheet" href="{{ mix('css/family.cash-flow-plans.expenses._form.css') }}" type="text/css">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ mix('js/family.cash-flow-plans.expenses._form.js') }}"></script>
@endpush

<form name="expense" action="{{ $action }}" method="POST" class="has-bold-labels" data-controller="toggle-new-merchant">

    @csrf

    @if ($method)
        @method($method)
    @endif

    @formError

    <fieldset>
        <legend>{{ __('expenses.details') }}</legend>

        <div class="card shadow mb-4">
            <div class="card-body">

                <div class="form-group">
                    <label for="expense_group_id">{{ __('expense-groups.expense-group') }}</label>
                    <select class="custom-select" name="expense_group_id" id="expense_group_id">
                        @foreach ($cashFlowPlan->expenseGroups as $expenseGroup)
                            <option value="{{ $expenseGroup->id }}" data-category="{{ $expenseGroup->category_id }}" data-sub-category="{{ $expenseGroup->sub_category }}" {{ (old('expense_group_id', $expense->expense_group_id) == $expenseGroup->id) ? 'selected' : '' }}>{{ $expenseGroup->name }}</option>
                        @endforeach
                    </select>
                    @fieldError('expense_group_id')
                </div>

                <div class="form-group">
                    <label for="actual">{{ __('expenses.amount') }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                        </div>
                        <input type="text" name="actual" id="actual" class="form-control money-field" placeholder="{{ __('expenses.amount') }}" value="{{ old('actual', App\formatCurrency($expense->actual, false)) }}">
                    </div>
                    @fieldError('actual')
                </div>

                <div class="form-group">
                    <label for="date">{{ __('expenses.date') }} <small class="text-muted">mm/dd/yyyy</small></label>
                    <input type="text" name="date" id="date" class="form-control dateField datepicker" placeholder="{{ __('expenses.date') }}" value="{{ old('date', App\formatDate($expense->date)) }}">
                    @fieldError('date')
                </div>

                <div class="form-group" id="existingMerchantGroup" data-target="toggle-new-merchant.existingGroup">
                    <label for="merchant_id">{{ __('expenses.merchant') }}</label><button tabindex="-1" type="button" class="btn btn-sm btn-link" data-action="toggle-new-merchant#showNewMerchant">{{ __('merchants.add-new-merchant') }}</button>
                    <select class="custom-select" name="merchant_id" id="merchant_id" data-target="toggle-new-merchant.merchantId">
                        <option value="">Select One</option>
                        @foreach ($merchants as $merchant)
                            <option value="{{ $merchant->id }}" data-category="{{ $merchant->default_category_id }}" data-sub-category="{{ $merchant->default_sub_category }}" {{ (old('merchant_id', $expense->merchant_id) == $merchant->id) ? 'selected' : '' }}>{{ $merchant->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group d-none" id="newMerchantGroup" data-target="toggle-new-merchant.newGroup">
                    <div class="form-group">
                        <label for="merchant_name">{{ __('merchants.add-new-merchant') }}</label><button type="button" class="btn btn-sm btn-link" id="cancelCreateNewMerchantsss"  data-action="toggle-new-merchant#cancelNewMerchant">{{ __('form.cancel') }}</button>
                        <input type="text" name="merchant_name" id="merchant_name" class="form-control" data-target="toggle-new-merchant.newMerchantName" placeholder="{{ __('merchants.merchant') . ' ' . __('merchants.name') }}" value="{{ old('merchant_name', '') }}">
                        @fieldError('merchant_name')
                    </div>
                </div>

            </div>
        </div>

        <div class="additional-fields" id="additionalFields">

            <div class="form-group">
                <label for="description">{{ __('expenses.description') }}</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="{{ __('expenses.description') }}" value="{{ old('description', $expense->description) }}">
                @fieldError('description')
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

        </div>

        <button type="button" class="btn btn-link btn-sm show-additional-fields" id="showAdditionalFields">
            <span class="show-additional">Show Additional Fields</span>
            <span class="hide-additional">Hide Additional Fields</span>
        </button>

    </fieldset>

    <hr>

    <button type="submit" class="btn btn-primary">
        {{ __('form.save') }}
    </button>

    <a class="btn btn-secondary" href="{{ $cancelRoute }}">
        {{ __('form.cancel') }}
    </a>

    <button type="button" class="btn btn-outline-primary{{-- create-new-merchant--}}" data-action="toggle-new-merchant#showNewMerchant">{{ __('merchants.add-new-merchant') }}</button>

</form>
