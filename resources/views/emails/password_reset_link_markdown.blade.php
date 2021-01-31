@component('mail::message')
# Password Reset
 
Please click the following button to reset your password.
If you did not request a change of password, please ignore this e-mail.
 
@component('mail::button', ['url' => $link])
Click here to reset your password
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent
