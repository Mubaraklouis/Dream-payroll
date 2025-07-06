<x-mail::message>
Hello {{ $name }},  

A new payment record have been sent to your account !

<x-mail::button :url="route('login')">
View details
</x-mail::button>

Thanks,<br>
Dream Bridge Consultant Ltd.
</x-mail::message>
