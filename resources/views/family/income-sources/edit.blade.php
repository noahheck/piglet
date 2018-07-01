@extends('layouts.app')

@section('title')
    - {{ $family->name }} - Income Sources - {{ $incomeSource->name }} - Edit
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
            route('family.income-sources.index', [$family]) => 'Income Sources',
            route('family.income-sources.show', [$family, $incomeSource]) => $incomeSource->name,
        ],
        'location'   => 'Edit',
    ])

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8 col-xl-7">

            @include('family.income-sources._form', [
                'action'      => route('family.income-sources.update', [$family, $incomeSource]),
                'method'      => 'PUT',
                'cancelRoute' => route('family.income-sources.show', [$family, $incomeSource]),
            ])

        </div>

    </div>

@endsection
