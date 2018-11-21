Dear {{ $member->firstName }},

<p>{{ $user->firstName }} has invited you to be a part of their family on {{ config('app.name') }}!</p>

<p>You can <a href="{{ route('register') }}">create your account</a> at:</p>

<p>{{ route("register") }}</p>

<p>If you already have an account, simply <a href="{{ route('login') }}">login here</a>:</p>

<p>{{ route('login') }}</p>

<p>Sincerely,</p>

<p>{{ config('app.name') }} (the team)</p>

<p>P.S. If you feel you have received this email in error, you can simply ignore it :) (or come check out {{ config('app.name') }} on your own!)</p>

