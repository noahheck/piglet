@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('piggy-banks.piggy-banks') }} - {{ $piggyBank->name }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/family.merchants.index.js') }}"></script>
@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family])   => __('money-matters.money-matters'),
            route('family.piggy-banks.index', [$family]) => __('piggy-banks.piggy-banks'),
        ],
        'location'   => $piggyBank->name,
        'menu' => [
            ['type' => 'link', 'href' => route('family.piggy-banks.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => __('piggy-banks.add-new-piggy-bank')],
            ['type' => 'link', 'href' => route('family.piggy-banks.edit', [$family, $piggyBank]), 'icon' => 'fa fa-pencil-square-o', 'text' => __('form.edit')],
        ]
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'piggy-banks'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ $piggyBank->name }}</h2>

            <p>{!! nl2br(e($piggyBank->description)) !!}</p>

            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: {{ $piggyBank->percentCompleted }}%" aria-valuenow="{{ $piggyBank->balance }}" aria-valuemin="0" aria-valuemax="{{ App\formatCurrency($piggyBank->target_amount, false) }}"></div>
            </div>

            <hr>

            <dl>

                <dt>{{ __('piggy-banks.dueDate') }}</dt>
                <dd>{{ App\formatDate($piggyBank->dueDate) }}</dd>

                <dt>{{ __('piggy-banks.starting-amount') }}</dt>
                <dd>{{ App\formatCurrency($piggyBank->starting_amount) }}</dd>

                <dt>{{ __('piggy-banks.target-amount') }}</dt>
                <dd>{{ App\formatCurrency($piggyBank->target_amount) }}</dd>



            </dl>

        </div>

    </div>

@endsection
