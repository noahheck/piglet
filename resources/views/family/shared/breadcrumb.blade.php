<div class="row">

    <div class="col-12">

        @if (isset($menu))
            <div class="page-menu-container" id="pageMenuContainer">
                {{--<span class="dropdown-trigger">--}}
                    <span class="fa fa-chevron-down rounded-circle dropdown-trigger" id="pageMenuDropdownTrigger"></span>
                {{--</span>--}}
                <div class="dropdown-content" id="pageMenuDropdownContent">
                    <span class="fa fa-chevron-up dropdown-trigger rounded-circle" id="pageMenuDropdownTrigger"></span>
                    <ul>
                        {{--<li><a href="#"><span class="fa fa-check-square-o"></span> Edit this</a></li>
                        <li><a href="#"><span class="fa fa-trash-o"></span> Delete</a></li>--}}
                        @foreach ($menu as $item)

                            @if (isset($item['type']) && $item['type'] === 'delete')
                                <li>
                                    <form action="{{ $item['href'] }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="d-none" id="pageMenuDeleteButton">
                                        <label for="pageMenuDeleteButton" class="delete-label d-block" style="cursor: pointer;">
                                            <span class="fa fa-trash-o"></span> {{ (isset($item['text'])) ? $item['text'] : 'Delete' }}
                                        </label>
                                    </form>
                                </li>
                            @elseif (isset($item['type']) && $item['type'] === 'link')
                                <li>
                                    <a href="{{ $item['href'] }}">
                                        <span class="{{ $item['icon'] }}"></span> {{ $item['text'] }}
                                    </a>
                                </li>
                            @endif

                        @endforeach
                    </ul>
                </div>
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
