@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('categories.categories') }} - {{ $category->name }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ mix('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')

@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters',    [$family]) => __('money-matters.money-matters'),
            route('family.categories.index', [$family]) => __('categories.categories'),
        ],
        'location'   => $category->name,
        'menu' => [
            ['type' => 'link', 'href' => route('family.categories.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => __('categories.add-new-category')],
            ['type' => 'link', 'href' => route('family.categories.edit', [$family, $category]), 'icon' => 'fa fa-pencil-square-o', 'text' => __('form.edit')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'categories'])

        </div>

        <div class="col-12 col-md-9">

            <h2 style="padding-left: 7px; border-left: 4px solid {{ $category->color }}">{{ $category->name }}</h2>

            @if ($category->active)
                <p><span class="fa fa-check-square-o" title="{{ __('categories.active') }}"></span> {{ __('categories.active') }}</p>
            @else
                <p class="text-muted"><span class="fa fa-square-o" title="{{ __('categories.inactive') }}"></span> {{ __('categories.inactive') }}</p>
            @endif

            <p class="{{ ($category->active) ? "" : "text-muted" }}">
                <strong>{{ __('categories.sub-categories') }}</strong>: {{ implode(', ', $category->sub_categories) }}
            </p>

            <hr>

            <p>{{ $category->description }}</p>

        </div>

    </div>

@endsection
