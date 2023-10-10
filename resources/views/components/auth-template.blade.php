<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<x-head :title="$title">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/auth.css'])
</x-head>
<body class="green-background">
{{ $slot }}
@vite(['resources/js/auth.js'])
</body>
</html>
