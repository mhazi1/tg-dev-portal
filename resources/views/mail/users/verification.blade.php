@component('mail::message')
# Email Verification Required

Hi {{ $user->name }},

Thank you for registering with us! To complete your registration, please verify your email address by clicking the button below:

@component('mail::button', ['url' => $url])
Verify Email Address
@endcomponent

If you did not create an account, no further action is required.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

