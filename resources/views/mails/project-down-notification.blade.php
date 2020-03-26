
@component('mail::message')
Hello **{{$name}}**,  {{-- use double space for line break --}}
One of your website urls in not working!

Click below to start working right now
@component('mail::button', ['url' => $link])
Go to your inbox
@endcomponent
Sincerely,  
Website Health Checker team.
@endcomponent