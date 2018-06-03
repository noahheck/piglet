@extends('layouts.app')

@section('scripts')
    <script src="{{ asset("js/home.js") }}"></script>
@endsection

@section('content')

    <div class="row">

        <div class="col">

            @formSuccess('family.create-success')

            <h2>Welcome Home!</h2>

            @if ($invitations->count())
                <div class="row justify-content-center">

                    <div class="col-12 col-sm-10 col-md-8 col-lg-6">

                        <div class="card">

                            <div class="card-header">
                                You've been invited to be a part of:
                            </div>
                            <div class="card-body">


                                @foreach ($invitations as $invitation)
                                    <div class="invitation">
                                        <p>{{ $invitation->family->name }}</p>
                                        <form action="{{ route("invitation.accept", $invitation) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-block btn-primary">
                                                Accept Invitation
                                            </button>
                                        </form>
                                    </div>
                                @endforeach

                            </div>

                        </div>

                    </div>

                </div>

            @endif

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
