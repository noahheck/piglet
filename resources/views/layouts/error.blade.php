@extends('layouts.marketing')


@section('marketing')

    <div class="row justify-content-center">

        <div class="col-12 col-sm-10 col-md-8">
            <h1>Whoops: @yield('errorCode')</h1>
        </div>

        <div class="col-12">
            <hr>
        </div>


        <div class="col-12 col-sm-10 col-md-8">

            @yield('error')

            <p>
                Head back to the <a href="{{ route('homepage') }}">homepage</a> and try again.
            </p>

            @if(config('app.debug'))

                <hr>

                <h3>Debug Info:</h3>

                <dl>
                    <dt>
                        Exception:
                    </dt>
                    <dd>
                        {{ get_class($exception) }}
                    </dd>
                </dl>

                <dl>
                    <dt>
                        Code:
                    </dt>
                    <dd>
                        {{ $exception->getCode() }}
                    </dd>
                </dl>

                <dl>
                    <dt>
                        Message:
                    </dt>
                    <dd>
                        {{ $exception->getMessage() }}
                    </dd>
                </dl>

                <dl>
                    <dt>
                        Trace:
                    </dt>
                    <dd>
                        {!! nl2br(e($exception->getTraceAsString())) !!}
                    </dd>
                </dl>

            @endif

        </div>


    </div>

@endsection
