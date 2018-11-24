@extends('layouts.marketing')

@section('marketing')

    <div class="jumbotron homepage-jumbotron">


        <div class="row">
            <div class="col-12 col-md-6 order-md-2">
                <img class="img-fluid rounded-circle" src="{{ asset('img/cartoon_family_fullsize.jpg') }}" alt="{{ config('app.name') }}">
            </div>
            <div class="col-12 col-md-6 order-md-1 sjumbotron-content">

                <div class="jumbotron-content">

                    <h1 class="text-center">Welcome to <br> {{ config('app.name') }}!</h1>

                    <hr>

                    <h3>Tools to keep your family organized so your energy can be spent on loving your life!</h3>

                </div>

                <p class="text-center">
                    <span class="fa-stack fa-3x">
                        <span class="fa fa-circle fa-stack-2x color-green"></span>
                        <span class="fa fa-dollar fa-stack-1x color-white"></span>
                    </span>
                </p>

            </div>

        </div>

        <hr>

        <h2>Money Matters</h2>

        <div class="row">

            <div class="col-12 col-md-6">

            </div>
            <div class="col-12 col-md-6">

            </div>

        </div>

    </div>

@endsection
