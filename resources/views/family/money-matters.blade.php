@extends('layouts.app')

@section('title')
    - {{ $family->name }} - {{ __('family-members.family_members') }}
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/family/member/home.css') }}" />
@endpush

@push('scripts')

@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [],
        'location'   => 'Money Matters',
        /*'menu' => [
            ['type' => 'link', 'href' => route('family.members.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => 'Add New'],
        ]*/
    ])

@endsection
