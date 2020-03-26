
@component('mail::message')
Hello **{{$name}}**,  {{-- use double space for line break --}}
Your website is running well!

Click below to start working right now
@component('mail::button', ['url' => $link])
Go to your inbox
@endcomponent
Sincerely,  
Website Health Checker team.
@endcomponent