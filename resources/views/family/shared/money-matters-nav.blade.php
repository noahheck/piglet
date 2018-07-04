@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family.money-matters.nav.css') }}" />
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/family.money-matters.nav.js') }}"></script>
@endpush

@php
    $settingsActive = false;

    if (in_array($active, ['categories', 'methods', 'accounts', 'income-sources', 'recurring-expenses'])) {
        $settingsActive = true;
    }
@endphp

<div class="list-group">

    <a href="{{ route('family.money-matters', [$family]) }}" class="list-group-item-action list-group-item {{ ($active === 'home') ? 'active' : '' }}">{{ __('money-matters.money-matters') }}</a>
    <a href="{{ route('family.budgets.index', [$family]) }}" class="list-group-item-action list-group-item {{ ($active === 'budget') ? 'active' : '' }}">Monthly Budget</a>
    <a href="{{ route('family.merchants.index', [$family]) }}" class="list-group-item-action list-group-item {{ ($active === 'merchants') ? 'active' : '' }}">{{ __('merchants.merchants') }}</a>
    <a href="#" class="list-group-item-action list-group-item settingsItem {{ ($settingsActive) ? 'settingsActive' : '' }}" id="settingsItem">
        <span class="float-right">
            <span class="fa fa-chevron-down settings-shown"></span>
            <span class="fa fa-chevron-up settings-hidden"></span>
        </span>
        Settings
    </a>
    <a href="{{ route('family.categories.index', [$family]) }}" class="list-group-item-action list-group-item settings-item {{ ($active === 'categories') ? 'active' : '' }}" style="display: {{ $settingsActive ? 'inline' : 'none' }}">{{ __('categories.categories') }}</a>
    <a href="{{ route('family.income-sources.index', [$family]) }}" class="list-group-item-action list-group-item settings-item {{ ($active === 'income-sources') ? 'active' : '' }}" style="display: {{ $settingsActive ? 'inline' : 'none' }}">{{ __('income-sources.income-sources') }}</a>
    <a href="{{ route('family.recurring-expenses.index', [$family]) }}" class="list-group-item-action list-group-item settings-item {{ ($active === 'recurring-expenses') ? 'active' : '' }}" style="display: {{ $settingsActive ? 'inline' : 'none' }}">Recurring Expenses</a>

    <a href="#" class="list-group-item-action list-group-item settings-item {{ ($active === 'methods'   ) ? 'active' : '' }}" style="display: {{ $settingsActive ? 'inline' : 'none' }}">Methods (!!)</a>
    <a href="#" class="list-group-item-action list-group-item settings-item {{ ($active === 'accounts'  ) ? 'active' : '' }}" style="display: {{ $settingsActive ? 'inline' : 'none' }}">Accounts (!!)</a>

</div>
