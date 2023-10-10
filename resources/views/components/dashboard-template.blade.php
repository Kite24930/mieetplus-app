<!DOCTYPE html>
<html lang="ja">
<x-head :title="$title">
    @vite(['resources/css/'.$css])
</x-head>
<body>
{{ $slot }}
</body>
</html>
