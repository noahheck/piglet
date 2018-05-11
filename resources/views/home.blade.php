@extends('layouts.app')

@section('scripts')
    <script src="{{ asset("js/home.js") }}"></script>
@endsection

@section('content')

    <div class="row">

        <div class="col">

            @formSuccess('family.create-success')

            <h2>Welcome Home!</h2>

            <a href="{{ route('family.create') }}">Create-a-family</a>

            <ul>
                @foreach ($families as $family)
                    <li>
                        <a href="{{ route('family.home', $family) }}">{{ $family->name }}</a>
                    </li>
                @endforeach
            </ul>

        </div>

    </div>

@endsection
