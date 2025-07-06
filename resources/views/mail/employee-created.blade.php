<x-mail::message>
Hello {{ $name }},  

Bellow is your unique code to create your Dream Bridge Consultants Account:

# {{ $otp }}

<x-mail::button :url="route('employee.register')">
Create my account
</x-mail::button>

Thanks,<br>
Dream Bridge Consultant Ltd.
</x-mail::message>
