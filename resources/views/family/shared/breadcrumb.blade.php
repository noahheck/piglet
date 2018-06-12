<div class="row">

    <div class="col-12">

        @if (isset($menu))
            <div class="page-menu-container" id="pageMenuContainer">
                <span class="fa fa-chevron-down dropdown-trigger rounded-circle" id="pageMenuDropdownTrigger"></span>
                <ul class="dropdown-content" id="pageMenuDropdownContent">
                    <a href="#"><li>Test</li></a>
                    <a href="#"><li>Test 2</li></a>

                    @foreach ($menu as $item)
                        <a href="{{ $item['href'] }}">
                            <li><span class="{{ $item['icon'] }}"></span> {{ $item['text'] }}</li>
                        </a>
                    @endforeach

                </ul>
            </div>
        @endif

        <a href="{{ route('family.home', [$family]) }}">{{ __('family.family_home') }}</a> &gt;

        @foreach ($breadcrumb as $href => $text)
            <a href="{{ $href }}">{{ $text }}</a> >
        @endforeach
        {{ $location }}

    </div>

</div>

<hr>
