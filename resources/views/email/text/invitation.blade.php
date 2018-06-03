Dear {{ $member->firstName }},

{{ $user->firstName }} has invited you to be a part of their family on Piglet!

You can create your account at:

{{ route("register") }}

If you already have an account, simply login here:

{{ route('login') }}

Sincerely,

Piglet (the team)

P.S. If you feel you have received this email in error, you can simply ignore it :).
