
@component('mail::message')
 {{-- <img src="https://ww4.filmoq.com/wp-content/uploads/2020/03/logoo.png">   --}}
# Introduction

The body of your message.

@component('mail::button', ['url' => $url])
Button Text
@endcomponent

Thanks,<br>
{{ $name }}
<br><a href="{{$url}}">Link reset Pass no html</a>
@endcomponent
