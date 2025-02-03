@component('mail::message')
# Password Reset

Hi {{ $user->name }},

You have requested to reset your password. To complete the process, please click the button below:

@component('mail::button', ['url' => $url])
Reset Password
@endcomponent

If you did not request to reset the password, no further action is required.

Thanks,<br>
{{ config('app.name') }}
@endcomponent