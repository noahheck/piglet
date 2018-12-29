<div class="row">

    <div class="col-12">

        @if (isset($menu) && count($menu) > 0)
            <div class="page-menu-container" id="pageMenuContainer">
                <span class="fa fa-chevron-down rounded-circle dropdown-trigger" id="pageMenuDropdownTrigger"></span>
                <div class="dropdown-content" id="pageMenuDropdownContent">
                    <span class="fa fa-chevron-up dropdown-trigger rounded-circle" id="pageMenuDropdownTrigger"></span>
                    <ul>
                        @foreach ($menu as $item)

                            @if (isset($item['type']) && $item['type'] === 'delete')
                                <li>
                                    <form action="{{ $item['href'] }}" method="POST" id="pageMenuDeleteForm">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="d-none" id="pageMenuDeleteButton">
                                        <label for="pageMenuDeleteButton" class="delete-label d-block" style="cursor: pointer;">
                                            <span class="fa fa-trash-o fa-fw"></span> {{ (isset($item['text'])) ? $item['text'] : 'Delete' }}
                                        </label>
                                    </form>
                                </li>
                            @elseif (isset($item['type']) && $item['type'] === 'form')
                                <li>
                                    <form action="{{ $item['href'] }}" method="POST">
                                        @csrf
                                        <input type="submit" class="d-none" id="{{ $item['id'] }}">
                                        <label for="{{ $item['id'] }}" class="d-block" style="cursor: pointer;">
                                            <span class="{{ $item['icon'] }} fa-fw"></span> {{ $item['text'] }}
                                        </label>
                                    </form>
                                </li>
                            @elseif (isset($item['type']) && $item['type'] === 'link')
                                <li>
                                    <a href="{{ $item['href'] }}">
                                        <span class="{{ $item['icon'] }} fa-fw"></span> {{ $item['text'] }}
                                    </a>
                                </li>
                            @endif

                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <a href="{{ route('family.home', [$family]) }}">{{ __('family.family_home') }}</a>

        @if (isset($breadcrumb))
            @foreach ($breadcrumb as $href => $text)
                &gt; <a href="{{ $href }}">{{ $text }}</a>
            @endforeach
        @endif

        @if (isset($location))
            &gt; {{ $location }}
        @endif

    </div>

</div>

<hr>
