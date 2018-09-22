@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('income-sources.income-sources') }} - {{ $incomeSource->name }} - {{ __('form.edit') }}
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
            route('family.income-sources.index', [$family]) => __('income-sources.income-sources'),
            route('family.income-sources.show', [$family, $incomeSource]) => $incomeSource->name,
        ],
        'location'   => __('form.edit'),
    ])

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">

            @include('family.income-sources._form', [
                'action'      => route('family.income-sources.update', [$family, $incomeSource, 'return' => url()->previous()]),
                'method'      => 'PUT',
                'cancelRoute' => url()->previous(),
            ])

        </div>

    </div>

@endsection
