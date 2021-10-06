@component('mail::message')
# Introduction
<p>Dear{{ $user->first_name . $user->last_name }}Wellcome to My Repository</p>
<p>please click this link to verify your mail</p>

@component('mail::button', ['url' => route('verify-email', ['user' => $user->username, 'timestamp' => $timestamp, 'signature' => $signature])])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
