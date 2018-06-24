@extends('layouts.app')

@section('title')
    - {{ $family->name }} - Categories - {{ $category->name }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')

@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters',    [$family]) => __('money-matters.money-matters'),
            route('family.categories.index', [$family]) => 'Categories',
        ],
        'location'   => $category->name,
        'menu' => [
            ['type' => 'link', 'href' => route('family.categories.edit', [$family, $category]), 'icon' => 'fa fa-pencil-square-o', 'text' => __('form.edit')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3 col-xl-2">

            @include('family.shared.money-matters-nav', ['active' => 'categories'])

        </div>

        <div class="col-12 col-md-9 col-xl-10">

            <h2>{{ $category->name }}</h2>

            @if ($category->active)
                <p><span class="fa fa-check-square-o" title="Active"></span> Active</p>
            @else
                <p class="text-muted"><span class="fa fa-square-o" title="Inactive"></span> Inactive</p>
            @endif

            <hr>

            <p>{{ $category->description }}</p>

        </div>

    </div>

@endsection
