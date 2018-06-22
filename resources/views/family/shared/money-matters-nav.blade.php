<div class="list-group">

    <a href="{{ route('family.money-matters', [$family]) }}" class="list-group-item-action list-group-item {{ ($active === 'home') ? 'active' : '' }}">Home</a>
    <a href="#" class="list-group-item-action list-group-item {{ ($active === 'periods') ? 'active' : '' }}">Periods</a>
    <a href="{{ route('family.merchants.index', [$family]) }}" class="list-group-item-action list-group-item {{ ($active === 'merchants') ? 'active' : '' }}">Merchants</a>
    <a href="#" class="list-group-item-action list-group-item {{ ($active === 'settings') ? 'active' : '' }}">Settings</a>

</div>
