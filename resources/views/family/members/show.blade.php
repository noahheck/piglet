@extends('layouts.app')

@section('title')
 - {{ $family->name }} - {{ $member->firstName }} {{ $member->lastName }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family.member.show.css') }}" />
@endpush

@push('scripts')

@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.members.index', [$family]) => __('family-members.family_members'),
        ],
        'location' => $member->firstName
    ])

    <h2>{{ $member->firstName }} {{ $member->lastName }}</h2>

    <div class="row">

        <div class="col-12 col-md-4 col-lg-3">

            <div class="card shadow">
                {!! $member->photo(['img-fluid', 'card-img-top']) !!}
                @if ($member->birthdate || $member->allow_login || $member->gender)
                    <div class="card-body">

                        @php
                            $bodyContent = [];
                            if ($member->allow_login) {
                                $bodyContent[] = '<span class="fa fa-user-circle-o" title="' . __('family-members.member_can_log_in') . '"></span>';
                            }

                            if ($member->birthdate) {
                                $bodyContent[] = $member->age . ' years';
                            }

                            if ($member->gender) {
                                $bodyContent[] = ucfirst($member->gender);
                            }
                        @endphp

                        {!! implode(' - ', $bodyContent) !!}

                    </div>
                @endif

                @if (Auth::user()->member->is_administrator)
                    <a href="{{ route('family.members.edit', [$family, $member]) }}">
                        <div class="card-footer text-right text-muted">
                            <span class="fa fa-pencil-square-o"></span> {{ ucwords(__('form.edit_details')) }}
                        </div>
                    </a>
                @endif

            </div>

        </div>

        <div class="col-12 col-md-8 col-lg-9">



        </div>

    </div>

@endsection
