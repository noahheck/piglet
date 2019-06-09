@extends('layouts.app')

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/admin.css') }}" />
@endpush

@push('scripts')
{{--    <script type="text/javascript" src="{{ mix('js/admin.js') }}"></script>--}}
@endpush

@section('content')

    <div class="row">

        <div class="col-12 col-md-3">
            @include('admin.shared.nav', ['active' => $key])
        </div>

        <div class="col-12 col-md-9">

            @if (isset($key) && $key)
                @include("admin.section.{$key}")
            @else

                <h1>Admin</h1>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <a href="{{ route('admin.users') }}" class="card border-0 shadow mb-5">
                            <div class="card-body color-white bg-red">
                                <h4 class="card-title text-center">
                                    Users
                                </h4>
                            </div>
                            <div class="card-body">
                                <p class="text-center display-2">
                                    <span class="fa fa-user"></span>
                                </p>
                                <p class="text-center display-3">
                                    {{ $numUsers }}
                                </p>
                            </div>
                        </a>
                    </div>

                    <div class="col-12 col-md-6">
                        <a href="{{ route('admin.families') }}" class="card border-0 shadow mb-5">
                            <div class="card-body color-white bg-purple">
                                <h4 class="card-title text-center">
                                    Families
                                </h4>
                            </div>
                            <div class="card-body">
                                <p class="text-center display-2">
                                    <span class="fa fa-users"></span>
                                </p>
                                <p class="text-center display-3">
                                    {{ $numFamilies }}
                                </p>
                            </div>
                        </a>
                    </div>


                    <div class="col-12 col-md-6 offset-md-3">
                        <a href="{{ route('admin.support') }}" class="card border-0 shadow mb-5">
                            <div class="card-body color-white bg-purple">
                                <h4 class="card-title text-center">
                                    Families in Support Mode
                                </h4>
                            </div>
                            <div class="card-body">
                                <p class="text-center display-2">
                                    <span class="fa fa-wrench"></span>
                                </p>
                                <p class="text-center display-3">
                                    {{ $numFamiliesInSupportMode }}
                                </p>
                            </div>
                        </a>
                    </div>

                </div>
            @endif

        </div>

    </div>

@endsection
