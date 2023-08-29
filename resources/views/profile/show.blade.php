<x-recruit.template title="My Page">
    <div id="loading" class="w-full h-full fixed top-0 left-0 flex justify-center items-center z-1000">
        <div class="ring absolute">
            loading
            <span></span>
        </div>
    </div>
    <div class="fixed top-0 left-0 z-510 p-2 h-[60px] flex items-center">
        <a href="{{ route('recruit') }}">
            <i class="bi bi-caret-left-fill"></i><i class="bi bi-house"></i>HOME
        </a>
    </div>
    <div id="container" class="w-full justify-center bg-mieetcolor hidden">
        <div class="container max-w-[550px] flex flex-col justify-center bg-white">
            <div class="w-full flex justify-center items-center gap-10 py-4">
                <img src="@if(isset($account->img)){{ asset('storage/student/'.$account->user_id.'/'.$account->img) }}@else{{ asset('storage/account_default.png') }}@endif" alt="{{ $account->name }}" class="w-16 h-16 object-cover rounded-full mieet-border">
                <div class="flex flex-col justify-center items-start gap-3">
                    <div class="pl-2">{{ $account->name }}</div>
                    <a href="{{ route('profile.edit') }}" class="px-4 py-2 rounded bg-gray-50">アカウントを編集</a>
                </div>
            </div>
            <div class="w-full border-t py-2 px-4">
                <div class="text-grey-500 text-sm">[学部・学年]</div>
                <div class="pl-2">{{ $account->faculty }}  {{ $account->glade }}年</div>
            </div>
            <div class="w-full border-t py-2 px-4">
                <div class="text-grey-500 text-sm">[登録メールアドレス]</div>
                <div class="pl-2">@if(isset($as->univ_email)){{ $account->univ_email }}@else{{ $account->email }}@endif</div>
            </div>
            <div class="w-full border-t py-2 px-4">
                <div class="text-grey-500 text-sm">[表示名]</div>
                <div class="pl-2">@if(isset($account->screen_name)){{ $account->screen_name }}@else{{ $account->name }}@endif</div>
            </div>
            <div class="w-full border-t py-2 px-4">
                <div class="text-grey-500 text-sm">[通知メールの許可]</div>
                <div class="pl-2">@if($account->notice == 0) 許可しない @else 許可する @endif</div>
            </div>
            <div class="w-full border-t py-2 px-4">
                <div class="text-grey-500 text-sm">[閲覧履歴データの利用]</div>
                <div class="pl-2">@if($account->history == 0) 許可しない @else 許可する @endif</div>
            </div>
        </div>
        <x-recruit.navbar></x-recruit.navbar>
    </div>
    @vite(['resources/js/profile/studentProfile.js'])
</x-recruit.template>
