@extends('layouts.app')

@section('title')
 - {{ $family->name }} - {{ __('family-members.family_members') }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/family/member/home.css') }}" />
@endpush

@push('scripts')

@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [],
        'location'   => __('family-members.family_members'),
        'menu' => [
            ['type' => 'link', 'href' => route('family.members.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => 'Add New'],
            ['type' => 'help', 'key' => 'family-members'],
            /*['type' => 'delete', 'href' => route('family.members.create', [$family]), 'text' => 'Delete Family'],*/
        ]
    ])

    <div class="row">
        <div class="col">
            <h2>
                {{ __('family-members.family_members') }}
            </h2>
        </div>
    </div>

    <div class="row justify-content-center">

        @foreach($members as $member)
            <div class="col-6 col-md-4 col-lg-3">
                <a class="card shadow" href="{{ route('family.members.show', [$family, $member]) }}">
                    {!! $member->photo(['card-img-top']) !!}
                    <div class="card-footer text-muted">
                        <p style="color: {{ $member->color }};">
                            @if($member->allow_login)
                                <span class="fa fa-user-circle-o" title="{{ __('family-members.member_can_log_in') }}"></span> -
                            @endif
                            {{ $member->firstName }}
                        </p>
                    </div>
                </a>
            </div>
        @endforeach

    </div>

@endsection
