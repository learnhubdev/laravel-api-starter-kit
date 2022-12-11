<x-mail::message>
    # Activate Your Membership

    Hi {{ $fullName }},
    Your membership sign up is almost complete. Please confirm your membership by clicking on the button below.

    <x-mail::button :url="$memberActivationUrl">
        Activate Membership
    </x-mail::button>

    Thank you,<br>
    {{ $appName }}
</x-mail::message>
