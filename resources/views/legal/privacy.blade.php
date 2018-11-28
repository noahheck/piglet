@extends('layouts.marketing')

@section('marketing')

    <div class="row justify-content-center">


        <div class="col-12 col-md-10 col-lg-8">
            <h1>Privacy Policy</h1>
        </div>

        <div class="col-12">
            <hr>
        </div>

        <div class="col-12 col-md-10 col-lg-8">
            @include ('legal.shared._privacy')
        </div>
    </div>


@endsection
