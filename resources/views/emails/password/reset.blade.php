<x-mail::message>
    # GH LINKS RESET ACCOUNT PASWORD

    Click on the button below to change your password

    <x-mail::button :url="''">
        Reset Password
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
