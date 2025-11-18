<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @php
        use Firefly\FilamentBlog\Models\Setting;
        $setting = Setting::first();
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ Storage::url($setting?->logo) }}" type="image/x-icon" />
    {!! \Firefly\FilamentBlog\Facades\SEOMeta::generate() !!}
    <meta name="description"
        content="{{ 'Cung cấp cá giống toàn miền Bắc với hơn 20 năm kinh nghiệm' ?? $setting?->description }}">
    {!! $setting?->google_console_code !!}
    {!! $setting?->google_analytic_code !!}
    {!! $setting?->google_adsense_code !!}
    @livewireStyles()
    <x-style />
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Organization",
          "name": "{{ $setting?->title }}",
          "url": "{{ url('/') }}",
          "logo": "{{ Storage::url($setting?->logo) }}"
        }
    </script>

</head>

<body>
    <livewire:components.menu />
    {{ $slot }}
    <livewire:components.footer />
    <livewire:components.floatbutton />
    <livewire:components.script />
    @livewireScripts()
</body>

</html>
