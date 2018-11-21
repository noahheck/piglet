<p>Dear {{ $user->firstName }},</p>

<p>Here is your new email verification PIN:</p>

<p><strong>{{ $pin }}</strong></p>

<p>Sincerely,</p>

<p>{{ config('app.name') }} (the team)</p>
