Dear {{ $member->firstName }},

{{ $user->firstName }} has invited you to be a part of their family on {{ config('app.name') }}!

You can create your account at:

{{ route("register") }}

If you already have an account, simply login here:

{{ route('login') }}

Sincerely,

{{ config('app.name') }} (the team)

P.S. If you feel you have received this email in error, you can simply ignore it :) (or come check out {{ config('app.name') }} on your own!)
