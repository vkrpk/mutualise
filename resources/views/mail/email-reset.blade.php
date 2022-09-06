{{-- @component('mail::message') --}}
title
Your message body.
{{-- <input type="text" name="email"> --}}
{{-- @php dd($notifiable->routes['mail']);  @endphp --}}
{{-- <form action="{{ $route }}" method="get">
    @csrf
    <input type="hidden" value="{{ $notifiable->routes['mail'] }}" name="email">
    <button class="btn btn-primary-soft text-primary" type="submit">Changer mon email</button>
</form> --}}
<a href="{{ $route }}">Changer email</a>
{{-- {{ dd($route) }} --}}
{{-- @component('mail::button', ['url' => $maildata['url']]) --}}
Verify
{{-- @endcomponent --}}
Thanks,<br>
{{-- {{ config('app.name') }} --}}
{{-- @endcomponent --}}
