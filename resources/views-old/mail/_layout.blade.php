@use('App\EmailSignatures')
@use('App\Helpers\Conversions')

<x-mail::message>

# {{ $subject }}

@yield('content')

{!! nl2br(Conversions::replace_placeholders(
    \config('settings.email.sign-off'),
    [
        // 'company_name'  => \config('settings.company.name'),
        // 'software_name' => \config('settings.company.software'),
        // 'user_name'     => \Auth::user()->name ?? 'The '.\config('settings.company.name'). ' Team',
    ]
)) !!}

<x-mail::subcopy>
    <br>
    <p>This is an automated service email from... {{-- config('settings.company.name') }} regarding your project and/or
    {{ config('settings.company.software') }} account.</p>
    <p>If you have any questions or need further assistance, feel free to contact your account manager.</p>--}}
</x-mail::subcopy>
</x-mail::message>
