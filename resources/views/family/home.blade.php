@extends('layouts.app')

@section('title')
 - {{ $family->name }} Home
@endsection

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family/home.css') }}" />
@endsection

@section('scripts')
    {{--<script src="{{ asset("js/home.js") }}"></script>--}}
@endsection

@section('content')

    <div class="row">

        <div class="col-12 col-md-8 text-center">

            <h2>{{ $family->name }}</h2>

            {!! $family->photo(['rounded-circle', 'img-fluid', 'family-photo']) !!}

            @if (Auth::user()->member->is_administrator)
                <p><a href="{{ route('family.edit', $family) }}" class="btn btn-outline-primary">{{ ucwords(__('form.edit_details')) }}</a></p>
            @endif

        </div>

        <div class="col-12 col-md-4">

            <a class="card shadow" href="{{ route('family.members.index', $family) }}">
                <div class="card-body">
                    <h5 class="card-title">{{ __('family-members.family_members') }}</h5>
                    @foreach ($members as $member)
                        {!! $member->icon(['rounded-circle'])  !!}
                    @endforeach
                </div>
            </a>

            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Goals <small class="text-muted">- Coming Soon!</small></h5>
                    Setting and tracking progress toward goals
                </div>
            </div>

            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Budget <small class="text-muted">- Coming Soon!</small></h5>
                    Money Matters
                </div>
            </div>

            <a class="card shadow" href="{{ route('family.taskLists.index', $family) }}">
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
            </div>

        </div>

    </div>

@endsection
