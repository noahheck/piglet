@extends('layouts.app')

@section('scripts')
    <script src="{{ asset("js/home.js") }}"></script>
@endsection

@section('content')

    <div class="row">

        <div class="col">

            @formSuccess('family.create-success')

            <h2>Welcome Home!</h2>

            <a href="{{ route('family.create') }}">Let's setup your family!</a>

        </div>

    </div>

@endsection
