@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('expense-groups.expense-groups') }} - {{ __('expense-groups.create-new') }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ mix('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')

@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
            route('family.expense-groups.index', [$family]) => __('expense-groups.expense-groups'),
        ],
        'location'   => __('expense-groups.create-new'),
    ])

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">

            @include('family.expense-groups._form', [
                'action'      => route('family.expense-groups.store', [$family]),
                'method'      => false,
                'cancelRoute' => url()->previous(),
            ])

        </div>

    </div>

@endsection
