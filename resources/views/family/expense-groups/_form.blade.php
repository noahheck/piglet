@php
    $categories = \App\Family\Category::where('active', true)->orderBy('d_order')->get();
@endphp

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/family.expense-groups._form.js') }}"></script>
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
            <label for="name">{{ __('expense-groups.name') }}</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('expense-groups.name') }}" value="{{ old('name', $expenseGroup->name) }}">
            @fieldError('name')
        </div>

        <div class="form-group">
            <label for="default_amount">{{ __('expense-groups.default-amount') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><span class="fa fa-dollar"></span></div>
                </div>
                <input type="text" name="default_amount" id="default_amount" class="form-control money-field" placeholder="{{ __('expense-groups.default-amount') }}" value="{{ old('default_amount', Auth::user()->formatCurrency($expenseGroup->default_amount, false)) }}">
            </div>
            @fieldError('default_amount')
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="active" name="active" {{ ($expenseGroup->active) ? "checked" : "" }}>
            <label class="form-check-label" for="active">
                {{ __('expense-groups.active') }}
            </label>
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
                @if (old('default_sub_category', $expenseGroup->sub_category))
                    <option selected value="{{ old('sub_category', $expenseGroup->sub_category) }}">{{ old('sub_category', $expenseGroup->sub_category) }}</option>
                @endif
            </select>
            @fieldError('sub_category')
        </div>

        <div class="form-group">
            <label for="description">{{ __('expense-groups.description') }}</label>
            <textarea name="description" id="description" class="form-control" placeholder="{{ __('expense-groups.description') }}" rows="3">{{ old('description', $expenseGroup->description) }}</textarea>
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
