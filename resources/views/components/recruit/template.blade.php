<!DOCTYPE html>
<html lang="ja">
<x-head :title="$title">
    @vite(['resources/css/'.$css])
</x-head>
<body>
<x-recruit.header>

</x-recruit.header>
{{ $slot }}
</body>
</html>
