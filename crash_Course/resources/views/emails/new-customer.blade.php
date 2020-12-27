@component('mail::message')
# New Customer has been created.


<b>Customer</b> {{$customer->name}} has been created.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
