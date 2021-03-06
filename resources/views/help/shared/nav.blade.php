<div class="list-group">
    <a href="{{ route('help') }}"                     class="list-group-item list-group-item-action {{ (!$key)                     ? 'active' : '' }}">{{ __('application.home') }}</a>
    <a href="{{ route('help', ['navigation'])     }}" class="list-group-item list-group-item-action {{ ($key === 'navigation')     ? 'active' : '' }}">{{ __('help/navigation.navigation') }}</a>
    <a href="{{ route('help', ['family'])         }}" class="list-group-item list-group-item-action {{ ($key === 'family')         ? 'active' : '' }}">{{ __('help/family.family') }}</a>
    <a href="{{ route('help', ['family-members']) }}" class="list-group-item list-group-item-action {{ ($key === 'family-members') ? 'active' : '' }}">{{ __('help/family-members.family-members') }}</a>
    <a href="{{ route('help', ['calendar'])       }}" class="list-group-item list-group-item-action {{ ($key === 'calendar')       ? 'active' : '' }}">{{ __('help/calendar.calendar') }}</a>

    {{--<a href="{{ route('help', ['merchants'])  }}" class="list-group-item list-group-item-action {{ ($key === 'merchants')  ? 'active' : '' }}">{{ __('merchants.merchants') }}</a>--}}
</div>
