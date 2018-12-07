@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('categories.categories') }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/family.categories.index.css') }}" />
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ mix('js/family.categories.index.js') }}"></script>
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
        ],
        'location'   => __('categories.categories'),
        'menu' => [
            ['type' => 'link', 'href' => route('family.categories.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => __('categories.add-new-category')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'categories'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ __('categories.categories') }}</h2>

            <hr>

            @if (count($categories) === 0)
                <p>{{ __('categories.no-categories-create') }}</p>
                <p class="text-center">
                    <a class="btn btn-primary" href="{{ route('family.categories.create', $family) }}"><span class="fa fa-plus-circle"></span> {{ __('categories.add-new-category') }}</a>
                </p>
            @else

                <div class="row justify-content-center">

                    <div class="col-12 col-md-10 col-lg-8 col-xl-6">

                        @if ($categories->where('active', true)->count() > 0)
                            <h4>{{ __('categories.active-categories') }}</h4>
                        @endif

                        <ul class="list-group shadow active-categories" id="activeCategories">

                            @foreach ($categories->where('active', true) as $category)
                                <li class="list-group-item" data-category-id="{{ $category->id }}" style="border-left: 4px solid {{ $category->color }}">
                                    <span class="fa fa-sort sort-handle"></span>
                                    <a href="{{ route('family.categories.edit', [$family, $category]) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach

                        </ul>

                        @if ($categories->where('active', false)->count() > 0)
                            <h4>{{ __('categories.inactive-categories') }}</h4>
                        @endif

                        <ul class="list-group shadow inactive-categories" id="inactiveCategories">

                            @foreach ($categories->where('active', false) as $category)
                                <li class="list-group-item" data-category-id="{{ $category->id }}">
                                    <a href="{{ route('family.categories.edit', [$family, $category]) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach

                        </ul>

                    </div>

                </div>

            @endif

        </div>

    </div>

@endsection
