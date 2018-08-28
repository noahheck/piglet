@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('expense-groups.expense-groups') }} - {{ $expenseGroup->name }} - {{ __('form.edit') }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')

@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters',   [$family]) => __('money-matters.money-matters'),
            route('family.expense-groups.index', [$family]) => __('expense-groups.expense-groups'),
            route('family.expense-groups.show', [$family, $expenseGroup]) => $expenseGroup->name,
        ],
        'location'   => __('form.edit'),
    ])

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">

            @include('family.expense-groups._form', [
                'action'      => route('family.expense-groups.update', [$family, $expenseGroup]) . '?' . app('request')->getQueryString(),
                'method'      => 'PUT',
                'cancelRoute' => route('family.expense-groups.index', [$family, $expenseGroup]),
            ])

        </div>

    </div>

@endsection
