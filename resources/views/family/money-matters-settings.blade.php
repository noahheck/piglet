@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('money-matters.money-matters') }} - {{ __('money-matters.settings') }}
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')

@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => __('money-matters.money-matters'),
        ],
        'location'   => __('money-matters.settings'),
    ])

    <div class="row">

        <div class="col-12 col-md-3">

            @include('family.shared.money-matters-nav', ['active' => 'settings'])

        </div>

        <div class="col-12 col-md-9">

            <h2>{{ __('money-matters.settings') }}</h2>

            <form class="has-bold-labels" name="money-matters-settings" action="{{ route('family.money-matters.settings-save', [$family, 'return' => url()->previous()]) }}" method="POST">

                @csrf

                @formError

                <div class="row justify-content-center">

                    <div class="col-12 col-sm-10">

                        @include ('family.shared.money-matters-settings-form')

                        <button type="submit" class="btn btn-primary">
                            {{ __('form.save') }}
                        </button>

                        <a class="btn btn-secondary" href="{{ url()->previous() }}">
                            {{ __('form.cancel') }}
                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

@endsection
