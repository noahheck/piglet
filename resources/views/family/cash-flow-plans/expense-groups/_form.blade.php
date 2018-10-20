@php
    $categories = \App\Family\Category::where('active', true)->orderBy('d_order')->get();

    $expenseGroupTemplates = \App\Family\ExpenseGroup::where('active', true)->orderBy('name')->get();
@endphp

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/family.cash-flow-plans.expense-groups._form.js') }}"></script>
@endpush

<form name="incomeSource" action="{{ $action }}" method="POST" class="has-bold-labels">

    @csrf

    @if ($method)
        @method($method)
    @endif

    @formError

    <fieldset>
        <legend>{{ __('expense-groups.details') }}</legend>

        <div class="form-group">
            <label for="expense_group_id">{{ __('expense-groups.expense-group') }}</label>
            <select class="custom-select" name="expense_group_id" id="expense_group_id">
                <option value="">{{ __('expense-groups.select-expense-group') }}</option>

                @if ($expenseGroupTemplates->where('category_id', null)->count() > 0)
                    <optgroup label="-- {{ __('expense-groups.uncategorized') }} --">
                        @foreach ($expenseGroupTemplates->where('category_id', null) as $template)

                            @php
                                $disabled = '';
                                $inUse    = '';

                                if ($cashFlowPlan->hasExpenseGroupTemplate($template)) {
                                    $disabled = 'disabled';
                                    $inUse    = ' - ' . __('form.already-in-use');
                                }

                            @endphp
                            <option
                                value="{{ $template->id }}"
                                data-category="{{ $template->category_id }}"
                                data-sub-category="{{ $template->sub_category }}"
                                data-default-amount="{{ App\formatCurrency($template->default_amount, false) }}"
                                data-name="{{ $template->name }}"
                                {{ $disabled }}
                                {{ ($template->id == old('expense_group_id', $expenseGroup->expense_group_id)) ? 'selected' : '' }}
                            >{{ $template->name }} - {{ App\formatCurrency($template->default_amount, true) }} {{ $inUse }}</option>
                        @endforeach
                    </optgroup>
                @endif

            @foreach ($categories as $category)
                    @continue($expenseGroupTemplates->where('category_id', $category->id)->count() === 0)
                    <optgroup label="{{ $category->name }}">

                    @foreach ($expenseGroupTemplates->where('category_id', $category->id) as $template)

                            @php
                                $disabled = '';
                                $inUse    = '';

                                if ($cashFlowPlan->hasExpenseGroupTemplate($template)) {
                                    $disabled = 'disabled';
                                    $inUse    = ' - ' . __('form.already-in-use');
                                }

                            @endphp
                            <option
                                    value="{{ $template->id }}"
                                    data-category="{{ $template->category_id }}"
                                    data-sub-category="{{ $template->sub_category }}"
                                    data-default-amount="{{ App\formatCurrency($template->default_amount, false) }}"
                                    data-name="{{ $template->name }}"
                                    {{ $disabled }}
                                    {{ ($template->id == old('expense_group_id', $expenseGroup->expense_group_id)) ? 'selected' : '' }}
                            >{{ $template->name }} - {{ App\formatCurrency($template->default_amount, true) }} {{ $inUse }}</option>
                        @endforeach

                    </optgroup>
                @endforeach

            </select>
        </div>

        <div class="form-group">
            <label for="name">{{ __('expense-groups.name') }}</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('expense-groups.name') }}" value="{{ old('name', $expenseGroup->name) }}">
            @fieldError('name')
        </div>

        <div class="form-group">
            <label for="projected">{{ __('expense-groups.projected-amount') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                </div>
                <input type="text" name="projected" id="projected" class="form-control money-field" placeholder="{{ __('expense-groups.projected-amount') }}" value="{{ old('projected', App\formatCurrency($expenseGroup->projected, false)) }}">
            </div>
            @fieldError('projected')
        </div>

        <div class="form-group">
            <label for="category_id">{{ __('expense-groups.category') }}</label>
            <select class="custom-select" name="category_id" id="category_id">
                <option value="">--</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" data-options="{{ implode('|', $category->sub_categories) }}" {{ (old('category_id', ($expenseGroup->category_id) ? $expenseGroup->category_id : '') == $category->id) ? "selected" : "" }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @fieldError('category_id')
        </div>

        <div class="form-group">
            <label for="sub_category">{{ __('expense-groups.sub-category') }}</label>
            <select class="custom-select" name="sub_category" id="sub_category">
                <option value="">--</option>
                @if (old('sub_category', $expenseGroup->sub_category))
                    <option selected value="{{ old('sub_category', $expenseGroup->sub_category) }}">{{ old('sub_category', $expenseGroup->sub_category) }}</option>
                @endif
            </select>
            @fieldError('sub_category')
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="cash" name="cash" {{ ($expenseGroup->cash) ? "checked" : "" }}>
            <label class="form-check-label" for="cash">
                {{ __('expense-groups.cash') }}
            </label>
            <p>{{ __('expense-groups.cash-description') }}</p>
            @fieldError('cash')
        </div>

        <div class="form-group">
            <label for="detail">{{ __('expense-groups.details') }}</label>
            <textarea name="detail" id="detail" class="form-control" placeholder="{{ __('expense-groups.details') }}" rows="3">{{ old('detail', $expenseGroup->detail) }}</textarea>
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
