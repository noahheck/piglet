<div class="list-group">
    <a href="{{ route('admin.home') }}"     class="list-group-item list-group-item-action {{ (!$key)               ? 'active' : '' }}">Admin Home</a>
    <a href="{{ route('admin.users') }}"    class="list-group-item list-group-item-action {{ ($key === 'users')    ? 'active' : '' }}">Users</a>
    <a href="{{ route('admin.families') }}" class="list-group-item list-group-item-action {{ ($key === 'families') ? 'active' : '' }}">Families</a>
    {{--<a href="{{ route('help', ['family'])     }}" class="list-group-item list-group-item-action {{ ($key === 'family')     ? 'active' : '' }}">{{ __('help/family.family') }}</a>--}}
    {{--<a href="{{ route('help', ['merchants'])  }}" class="list-group-item list-group-item-action {{ ($key === 'merchants')  ? 'active' : '' }}">{{ __('merchants.merchants') }}</a>--}}
</div>
