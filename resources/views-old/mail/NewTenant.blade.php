@extends('mail._layout')

@section('content')

Hello {{ $recipient['first_name'] }},

<x-mail::panel>
    <strong>{{ $tenant['name'] }}</strong> has been set-up with the following details:<br>
    Email: {{ $email }}<br>
    Password: {{ $password }}

<x-mail::button align="right" style="margin-bottom:0;" :url="$domain">
    Visit
</x-mail::button>
</x-mail::panel>

// Temporary Email, to replace with auto-logging in

@endsection
