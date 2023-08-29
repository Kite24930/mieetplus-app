<div id="navbar" class="fixed bottom-0 left-0 w-full flex justify-center z-500">
    <div class="w-full max-w-[550px] bg-white flex flex-1 justify-evenly items-center">
        <a href="{{ route('recruit') }}" class="flex flex-col justify-center items-center w-1/4">
            <div><i class="bi bi-house-door-fill text-2xl"></i></div>
            <div class="text-sm">ホーム</div>
        </a>
        <a href="{{ route('search') }}" class="flex flex-col justify-center items-center w-1/4">
            <div><i class="bi bi-search text-2xl"></i></div>
            <div class="text-sm">検索</div>
        </a>
        <a href="{{ route('followed') }}" class="flex flex-col justify-center items-center w-1/4">
            <div><i class="bi bi-list-stars text-2xl"></i></div>
            <div class="text-sm">フォロー中</div>
        </a>
        <a href="{{ route('profile.show') }}" class="flex flex-col justify-center items-center w-1/4">
            <div><i class="bi bi-person-circle text-2xl"></i></div>
            <div class="text-sm">アカウント</div>
        </a>
    </div>
</div>
