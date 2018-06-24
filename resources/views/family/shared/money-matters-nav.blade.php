<div class="list-group">

    <a href="{{ route('family.money-matters', [$family]) }}" class="list-group-item-action list-group-item {{ ($active === 'home') ? 'active' : '' }}">{{ __('money-matters.money-matters') }}</a>
    <a href="#" class="list-group-item-action list-group-item {{ ($active === 'budget') ? 'active' : '' }}">Budget</a>
    <a href="{{ route('family.merchants.index', [$family]) }}" class="list-group-item-action list-group-item {{ ($active === 'merchants') ? 'active' : '' }}">{{ __('merchants.merchants') }}</a>
    <a href="#" class="list-group-item-action list-group-item {{ ($active === 'settings') ? 'active' : '' }}">Settings</a>

</div>
