<div class="list-group">
    <a href="{{ route('admin.home') }}"     class="list-group-item list-group-item-action {{ (!$key)               ? 'active text-light bg-dark' : '' }}">Admin Home</a>
    <a href="{{ route('admin.users') }}"    class="list-group-item list-group-item-action {{ ($key === 'users')    ? 'active text-light bg-dark' : '' }}">Users</a>
    <a href="{{ route('admin.families') }}" class="list-group-item list-group-item-action {{ ($key === 'families') ? 'active text-light bg-dark' : '' }}">Families</a>
    <a href="{{ route('admin.support') }}"  class="list-group-item list-group-item-action {{ ($key === 'support')  ? 'active text-light bg-dark' : '' }}">Support</a>
</div>
