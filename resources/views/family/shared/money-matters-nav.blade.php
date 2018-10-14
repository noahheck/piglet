@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family.money-matters.nav.css') }}" />
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/family.money-matters.nav.js') }}"></script>
@endpush

@php
    $settingsActive = false;

    if (in_array($active, [
        'categories',
        'methods',
        'accounts',
        'income-sources',
        'recurring-expenses',
        'expense-groups',
        'settings',
    ])) {
        $settingsActive = true;
    }
@endphp

<div class="list-group">

    <a href="{{ route('family.money-matters', [$family]) }}" class="list-group-item-action list-group-item {{ ($active === 'home') ? 'active' : '' }}">{{ __('money-matters.money-matters') }}</a>
    <a href="{{ route('family.cash-flow-plans.index', [$family]) }}" class="list-group-item-action list-group-item {{ ($active === 'cash-flow-plans') ? 'active' : '' }}">Cash Flow Plans</a>
    <a href="{{ route('family.merchants.index', [$family]) }}" class="list-group-item-action list-group-item {{ ($active === 'merchants') ? 'active' : '' }}">{{ __('merchants.merchants') }}</a>
    <a href="{{ route('family.piggy-banks.index', [$family]) }}" class="list-group-item-action list-group-item {{ ($active === 'piggy-banks') ? 'active' : '' }}">{{ __('piggy-banks.piggy-banks') }}</a>
    <a href="#" class="list-group-item-action list-group-item settingsItem {{ ($settingsActive) ? 'settingsActive' : '' }}" id="settingsItem">
        <span class="float-right">
            <span class="fa fa-chevron-down settings-shown"></span>
            <span class="fa fa-chevron-up settings-hidden"></span>
        </span>
        Settings
    </a>
    <a href="{{ route('family.categories.index', [$family]) }}" class="list-group-item-action list-group-item settings-item {{ ($active === 'categories') ? 'active' : '' }}" style="display: {{ $settingsActive ? 'inline' : 'none' }}">{{ __('categories.categories') }}</a>
    <a href="{{ route('family.income-sources.index', [$family]) }}" class="list-group-item-action list-group-item settings-item {{ ($active === 'income-sources') ? 'active' : '' }}" style="display: {{ $settingsActive ? 'inline' : 'none' }}">{{ __('income-sources.income-sources') }}</a>
    <a href="{{ route('family.recurring-expenses.index', [$family]) }}" class="list-group-item-action list-group-item settings-item {{ ($active === 'recurring-expenses') ? 'active' : '' }}" style="display: {{ $settingsActive ? 'inline' : 'none' }}">{{ __('recurring-expenses.recurring-expenses') }}</a>
    <a href="{{ route('family.expense-groups.index', [$family]) }}" class="list-group-item-action list-group-item settings-item {{ ($active === 'expense-groups') ? 'active' : '' }}" style="display: {{ $settingsActive ? 'inline' : 'none' }}">{{ __('expense-groups.expense-groups') }}</a>
    <a href="{{ route('family.money-matters.settings', [$family]) }}" class="list-group-item-action list-group-item settings-item {{ ($active === 'settings') ? 'active' : '' }}" style="display: {{ $settingsActive ? 'inline' : 'none' }}">{{ __('money-matters.settings') }}</a>

</div>
