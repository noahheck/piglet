@extends('layouts.app')


@push('stylesheets')
{{--    <link rel="stylesheet" type="text/css" href="{{ mix('css/home.css') }}" />--}}
@endpush

@push('scripts')
{{--    <script src="{{ mix("js/home.js") }}"></script>--}}
@endpush

@section('content')

    <div class="row justify-content-center">

        @foreach ($families as $family)

            <div class="col-6 col-md-4 col-xl-3">
                <a class="card mb-3" href="{{ route('family.home', [$family]) }}">
                    {!! $family->photo(['card-img-top']) !!}
                    <div class="card-body border-top {{ ($family->active) ? '' : 'text-muted' }}">
                        <p class="card-text">{{ $family->name }}{{ ($family->active) ? '' : ' - ' . __('family-settings.archived') }}</p>
                    </div>
                </a>
            </div>

        @endforeach

    </div>

@endsection
