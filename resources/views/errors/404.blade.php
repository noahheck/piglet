@extends('layouts.error')

@section('errorCode')
    404 - Not Found
@endsection

@section('error')
    <p>The thing you were looking for doesn't exist (unless you were looking for the error page), or somebody made a mistake somewhere. If this keeps happening, please let us know.</p>

    <p class="small text-muted">But you might have found Heidi...</p>
@endsection
