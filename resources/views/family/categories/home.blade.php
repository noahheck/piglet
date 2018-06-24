@extends('layouts.app')

@section('title')
    - {{ $family->name }} - Categories
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family.categories.index.css') }}" />
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/family.categories.index.js') }}"></script>
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
        ],
        'location'   => 'Categories',
        'menu' => [
            ['type' => 'link', 'href' => route('family.categories.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => 'Add New Category'],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3 col-xl-2">

            @include('family.shared.money-matters-nav', ['active' => 'categories'])

        </div>

        <div class="col-12 col-md-9 col-xl-10">

            <h2>Categories</h2>

            <hr>

            @if (count($categories) === 0)
                <p>You haven't added any categories yet. Go ahead and create your first one now:</p>
                <p class="text-center">
                    <a class="btn btn-primary" href="{{ route('family.categories.create', $family) }}"><span class="fa fa-plus-circle"></span> Add New Category</a>
                </p>
            @else

                <div class="row justify-content-center">

                    <div class="col-12 col-md-10 col-lg-8 col-xl-6">

                        @if ($categories->where('active', true)->count() > 0)
                            <h4>Active Categories</h4>
                        @endif

                        <ul class="list-group shadow active-categories" id="activeCategories">

                            @foreach ($categories->where('active', true) as $category)
                                <li class="list-group-item" data-category-id="{{ $category->id }}">
                                    <span class="fa fa-sort sort-handle"></span>
                                    <a href="{{ route('family.categories.show', [$family, $category]) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach

                        </ul>

                        @if ($categories->where('active', false)->count() > 0)
                            <h4>Inactive Categories</h4>
                        @endif

                        <ul class="list-group shadow inactive-categories" id="inactiveCategories">

                            @foreach ($categories->where('active', false) as $category)
                                <li class="list-group-item" data-category-id="{{ $category->id }}">
                                    <a href="{{ route('family.categories.show', [$family, $category]) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach

                        </ul>

                    </div>

                </div>

            @endif

        </div>

    </div>

@endsection
