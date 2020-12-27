@component('mail::message')
# A User Just Filled The Contact Form

<strong>Name: </strong>{{ $data['name'] }} <br>
<strong>email: </strong><a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a> <br>
<strong>message: </strong>{{ $data['msg'] }}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
