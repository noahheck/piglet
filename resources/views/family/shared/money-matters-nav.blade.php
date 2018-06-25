@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family.money-matters.nav.css') }}" />
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/family.money-matters.nav.js') }}"></script>
@endpush

@php
    $settingsActive = false;

    if (in_array($active, ['categories', 'methods', 'accounts'])) {
        $settingsActive = true;
    }
@endphp

<div class="list-group shadow">

    <a href="{{ route('family.money-matters', [$family]) }}" class="list-group-item-action list-group-item {{ ($active === 'home') ? 'active' : '' }}">{{ __('money-matters.money-matters') }}</a>
    <a href="#" class="list-group-item-action list-group-item {{ ($active === 'budget') ? 'active' : '' }}">Budget</a>
    <a href="{{ route('family.merchants.index', [$family]) }}" class="list-group-item-action list-group-item {{ ($active === 'merchants') ? 'active' : '' }}">{{ __('merchants.merchants') }}</a>
    <a href="#" class="list-group-item-action list-group-item settingsItem {{ ($settingsActive) ? 'settingsActive' : '' }}" id="settingsItem">
        <span class="float-right">
            <span class="fa fa-chevron-down settings-shown"></span>
            <span class="fa fa-chevron-up settings-hidden"></span>
        </span>
        Settings
    </a>
    <a href="{{ route('family.categories.index', [$family]) }}" class="list-group-item-action list-group-item settings-item {{ ($active === 'categories') ? 'active' : '' }}" style="display: {{ $settingsActive ? 'inline' : 'none' }}">{{ __('categories.categories') }}</a>
    <a href="#" class="list-group-item-action list-group-item settings-item {{ ($active === 'methods'   ) ? 'active' : '' }}" style="display: {{ $settingsActive ? 'inline' : 'none' }}">Methods</a>
    <a href="#" class="list-group-item-action list-group-item settings-item {{ ($active === 'accounts'  ) ? 'active' : '' }}" style="display: {{ $settingsActive ? 'inline' : 'none' }}">Accounts</a>

</div>
