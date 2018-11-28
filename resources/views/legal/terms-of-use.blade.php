@extends('layouts.marketing')

@section('marketing')

    <div class="row justify-content-center">

        <div class="col-12 col-md-10 col-lg-8">
            <h1>Terms of Use</h1>
        </div>

        <div class="col-12">
            <hr>
        </div>

        <div class="col-12 col-md-10 col-lg-8">
            @include ('legal.shared._terms')
        </div>
    </div>


@endsection
