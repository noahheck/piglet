@extends('layouts.app')

@section('title')
    - {{ $family->name }} - Merchants
@endsection

@push('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/family/member/home.css') }}" />--}}
@endpush

@push('scripts')

@endpush

@section('content')

    @include('family.shared.breadcrumb', [
        'breadcrumb' => [
            route('family.money-matters', [$family]) => 'Money Matters'
        ],
        'location'   => 'Merchants',
        'menu' => [
            ['type' => 'link', 'href' => route('family.merchants.create', [$family]), 'icon' => 'fa fa-plus-circle', 'text' => 'Add New Merchant'],
        ]
    ])
            {{--['type' => 'link', 'href' => '#', 'icon' => 'fa fa-building', 'text' => 'Merchants'],
            ['type' => 'link', 'href' => '#', 'icon' => 'fa fa-cogs', 'text' => 'Settings'],--}}

    <div class="row">

        <div class="col-12 col-md-3 col-lg-2">

            @include('family.shared.money-matters-nav', ['active' => 'merchants'])

        </div>

        <div class="col-12 col-md-9 col-lg-10">

            @if (count($merchants) === 0)
                <p>You haven't added any merchants yet. Go ahead and <a href="{{ route('family.merchants.create', [$family]) }}">add your first merchant</a> now.</p>
            @else

                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th>Name</th>
                            {{--<th></th>--}}
                        </tr>
                    </thead>

                    @foreach ($merchants as $merchant)

                        <tr>
                            <td>
                                <a href="{{ route('family.merchants.show', [$family, $merchant]) }}">
                                    {{ $merchant->name }}
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </table>

            @endif

        </div>

    </div>

@endsection
