@extends('layouts.app')

@section('title')
 - {{ $family->name }} Home
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/family/home.css') }}" />
@endpush

@push('scripts')
    {{--<script src="{{ mix("js/home.js") }}"></script>--}}
@endpush

@section('content')

    @include('family.shared.breadcrumb', [])

    <div class="row">

        <div class="col-12 col-md-8 text-center">

            <h2>{{ $family->name }}</h2>

            {!! $family->photo(['rounded-circle', 'img-fluid', 'family-photo']) !!}

            @if (Auth::user()->member->is_administrator)
                <p><a href="{{ route('family.edit', $family) }}" class="btn btn-outline-primary">{{ ucwords(__('form.edit_details')) }}</a></p>
            @endif

        </div>

        <div class="col-12 col-md-4">

            <a class="card shadow component-link" href="{{ route('family.members.index', $family) }}">
                <div class="card-body">
                    <h5 class="card-title">
                        <span class="fa fa-users"></span>
                        {{ __('family-members.family_members') }}
                    </h5>
                    @foreach ($members as $member)
                        {!! $member->icon(['rounded-circle'])  !!}
                    @endforeach
                </div>
            </a>

            {{--<div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Goals <small class="text-muted">- Coming Soon!</small></h5>
                    Setting and tracking progress toward goals
                </div>
            </div>--}}

            <a class="card shadow component-link" href="{{ route('family.money-matters', $family) }}">
                <div class="card-body">
                    <h5 class="card-title">
                        <span class="fa fa-usd"></span>
                        {{ __('money-matters.money-matters') }}
                    </h5>
                    <p>
                        <span class="fa fa-pull-left fa-bar-chart fa-2x fa-border"></span>
                        {{ __('money-matters.money-matters-shortDesc') }}
                    </p>
                </div>
            </a>

            {{--<a class="card shadow" href="{{ route('family.taskLists.index', $family) }}">
                <div class="card-body">
                    <h5 class="card-title">Things to do</h5>
                    To do lists and things
                </div>
            </a>

            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Schedule <small class="text-muted">- Coming Soon!</small></h5>
                    Schedule type things
                </div>
            </div>--}}

        </div>

    </div>

@endsection
