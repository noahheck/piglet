@extends('layouts.app')

@section('title')
 - {{ $family->name }} - {{ $member->firstName }} {{ $member->lastName }}
@endsection

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family.member.show.css') }}" />
@endsection

@section('scripts')

@endsection

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.member.index', [$family]) => __('family-members.family_members'),
        ],
        'location' => $member->firstName
    ])

    <h2>{{ $member->firstName }} {{ $member->lastName }}</h2>

    <div class="row">

        <div class="col-12 col-md-4 col-lg-3">

            <div class="card shadow">
                {!! $member->photo(['img-fluid', 'card-img-top']) !!}
                @if ($member->birthdate)
                    <div class="card-body">
                        {{ $member->age }} years - {{ ucfirst($member->gender) }}
                    </div>
                @endif

                <a href="{{ route('family.member.edit', [$family, $member]) }}">
                    <div class="card-footer text-right text-muted">
                        <span class="fa fa-pencil-square-o"></span> {{ ucwords(__('form.edit_details')) }}
                    </div>
                </a>

            </div>

        </div>

        <div class="col-12 col-md-8 col-lg-9">



        </div>

    </div>

@endsection
