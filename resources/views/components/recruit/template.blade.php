<!DOCTYPE html>
<html lang="ja">
<x-head :title="$title">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/'.$css])
</x-head>
<body>
<x-recruit.header>

</x-recruit.header>
{{ $slot }}
</body>
</html>
