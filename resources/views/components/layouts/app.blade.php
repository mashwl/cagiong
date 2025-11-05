<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ $setting?->favicon }}" type="image/x-icon" />
    {!! \Firefly\FilamentBlog\Facades\SEOMeta::generate() !!}
    {!! $setting?->google_console_code !!}
    {!! $setting?->google_analytic_code !!}
    {!! $setting?->google_adsense_code !!}
    @livewireStyles()
    <x-style />
</head>

<body>
    <x-menu />
    {{ $slot }}
    <livewire:components.footer />

    <livewire:components.floatbutton />
    <livewire:components.script />
@livewireScripts()
</body>

</html>
