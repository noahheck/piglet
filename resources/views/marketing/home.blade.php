@extends('layouts.marketing')

@section('marketing')

    <div class="jumbotron homepage-jumbotron">


        <div class="row">
            <div class="col-12 col-md-6 order-md-2">
                <img class="img-fluid rounded-circle" src="{{ asset('img/cartoon_family_fullsize.jpg') }}" alt="{{ config('app.name') }}">
            </div>
            <div class="col-12 col-md-6 order-md-1 sjumbotron-content">

                <div class="jumbotron-content text-center">

                    <h1>Welcome to <br> {{ config('app.name') }}!</h1>

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


        <div class="row mt-5 border shadow-sm pb-5">

            <div class="col-12">

                <h2 class="pb-4">Money Matters</h2>

            </div>

            <div class="col-12 col-md-6">

                <div class="card border-0 shadow mb-5">
                    <div class="card-body color-white bg-red">
                        <h4 class="card-title text-center">
                            <span class="fa fa-list-ul"></span>
                            Organize
                        </h4>
                    </div>
                    <img class="card-img border-bottom border-top" src="{{ asset('img/marketing/organize.png') }}" alt="">
                    <div class="card-body">
                        <p class="card-text">
                            All your family's money habits together
                        </p>
                    </div>
                </div>

            </div>

            <div class="col-12 col-md-6">

                <div class="card border-0 shadow mb-5">
                    <div class="card-body color-white bg-purple">
                        <h4 class="card-title text-center">
                            <span class="fa fa-arrow-circle-right"></span>
                            Plan
                        </h4>
                    </div>
                    <img class="card-img border-bottom border-top" src="{{ asset('img/marketing/plan.png') }}" alt="">
                    <div class="card-body">
                        <p class="card-text">
                            Put your family's financial plan in place
                        </p>
                    </div>
                </div>

            </div>

            <div class="col-12 col-md-6">

                <div class="card border-0 shadow">
                    <div class="card-body color-white bg-blue">
                        <h4 class="card-title text-center">
                            <span class="fa fa-bar-chart"></span>
                            Track
                        </h4>
                    </div>
                    <img class="card-img border-bottom border-top" src="{{ asset('img/marketing/track.png') }}" alt="">
                    <div class="card-body">
                        <p class="card-text">
                            Track your progress and make your plan work
                        </p>
                    </div>
                </div>

            </div>

            <div class="col-12 col-md-6">

                <div class="card border-0 shadow">
                    <div class="card-body color-white bg-green">
                        <h4 class="card-title text-center">
                            <span class="fa fa-line-chart"></span>
                            Save
                        </h4>
                    </div>
                    <img class="card-img border-bottom border-top" src="{{ asset('img/marketing/save.png') }}" alt="">
                    <div class="card-body">
                        <p class="card-text">
                            Save for and meet your family's financial goals
                        </p>
                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection
