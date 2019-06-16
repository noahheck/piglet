<div class="row sticky-top bg-white family-navigation-bar">

    @if ($family->allow_support_access)

        <div class="col-12">
            <div class="alert alert-warning" role="alert">
                {{ __('family.in-support-access-mode') }}

                @if (Auth::user()->familyMember()->is_administrator && Route::current()->getName() !== 'family.edit')
                    <a href="{{ route('family.edit', [$family]) }}">{{ __('application.take-me-there') }}</a>
                @endif
            </div>
        </div>

    @endif

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
                            @elseif (isset($item['type']) && $item['type'] === 'help')
                                <li>
                                    <a href="{{ route("help", [$item['key']]) }}" class="load-help-link" data-help-section="{{ $item['key'] }}">
                                        <span class="fa fa-question-circle fa-fw"></span> {{ __('application.help') }}
                                    </a>
                                </li>
                            @elseif (isset($item['type']) && $item['type'] === 'print')
                                <li>
                                    <a href="{{ $item['href'] }}" id="pageMenuPrintOption">
                                        <span class="fa fa-print fa-fw"></span> Print
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

        <hr>

    </div>

</div>

