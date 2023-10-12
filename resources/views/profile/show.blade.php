<x-recruit.template title="My Page" css="profile/studentProfile.css">
    <div id="loading" style="width: 100dvw; height: 100dvh; position: fixed; top: 0; left: 0; z-index: 1000; display: flex; justify-content: center; align-items: center; background-color: black;">
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
                    <a href="{{ route('profile.edit') }}" class="px-4 py-2 rounded bg-gray-100">アカウントを編集</a>
                </div>
            </div>
            <div class="w-full border-t py-2 px-4">
                <div class="text-grey-500 text-sm">[性別]</div>
                <div class="pl-2">
                    @switch($account->sex)
                        @case(0) 男性 @break
                        @case(1) 女性 @break
                        @case(2) その他 @break
                        @case(3) 非回答 @break
                    @endswitch
                </div>
            </div>
            <div class="w-full border-t py-2 px-4">
                <div class="text-grey-500 text-sm">[誕生日]</div>
                <div class="pl-2">
                    {{ date('Y年m月d日', strtotime($account->birthday)) }}
                </div>
            </div>
            <div class="w-full border-t py-2 px-4">
                <div class="text-grey-500 text-sm">[学部・学年]</div>
                <div class="pl-2">
                    {{ $account->faculty }}  {{ $account->grade }}年
                </div>
            </div>
            <div class="w-full border-t py-2 px-4">
                <div class="text-grey-500 text-sm">[登録メールアドレス]</div>
                <div class="pl-2">
                    @if(isset($account->univ_email))
                        {{ $account->univ_email }}
                    @else
                        {{ $account->email }}
                    @endif
                </div>
            </div>
            <div class="w-full border-t py-2 px-4 hidden">
                <div class="text-grey-500 text-sm">[メールアドレス認証]</div>
                @if($request->session()->has('status'))
                    <div class="text-xs text-grey-500 pl-2">
                        {{ $request->session()->get('status') }}
                    </div>
                @endif
                <div class="pl-2 flex items-center gap-4">
                    @if(isset($account->email_verified_at))
                        認証済み
                    @elseif(isset($account->univ_email))
                        未認証
                        <form action="{{ route('verification.send') }}" method="POST">
                            @csrf
                            <a href="{{ route('verification.send') }}" class="my-3" onclick="event.preventDefault();this.closest('form').submit();">
                                <div class="flex justify-start items-center link rounded p-2 bg-greencolor">
                                    認証用メールを送信
                                </div>
                            </a>
                        </form>
                    @else
                        登録メールアドレスを学籍メールに変更してください。
                    @endif
                </div>
            </div>
            <div class="w-full border-t py-2 px-4">
                <div class="text-grey-500 text-sm">[表示名]</div>
                <div class="pl-2">
                    @if(isset($account->screen_name))
                        {{ $account->screen_name }}
                    @else
                        {{ $account->name }}
                    @endif
                </div>
            </div>
            <div class="w-full border-t py-2 px-4">
                <div class="text-grey-500 text-sm">[通知メールの許可]</div>
                <div class="pl-2">
                    @if($account->notice == 0)
                        許可しない
                    @else
                        許可する
                    @endif
                </div>
            </div>
            <div class="w-full border-t py-2 px-4">
                <div class="text-grey-500 text-sm">[閲覧履歴データの利用]</div>
                <div class="pl-2">
                    @if($account->history == 0)
                        許可しない
                    @else
                        許可する
                    @endif
                </div>
            </div>
            <div class="w-full border-t py-2 px-4 flex justify-center">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <a href="{{ route('logout') }}" class="my-3" onclick="event.preventDefault();this.closest('form').submit();">
                        <div class="flex justify-start items-center link rounded p-2 bg-greencolor">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 21C4.45 21 3.979 20.804 3.587 20.412C3.195 20.02 2.99934 19.5493 3 19V5C3 4.45 3.196 3.979 3.588 3.587C3.98 3.195 4.45067 2.99934 5 3H11C11.2833 3 11.521 3.096 11.713 3.288C11.905 3.48 12.0007 3.71733 12 4C12 4.28333 11.904 4.521 11.712 4.713C11.52 4.905 11.2827 5.00067 11 5H5V19H11C11.2833 19 11.521 19.096 11.713 19.288C11.905 19.48 12.0007 19.7173 12 20C12 20.2833 11.904 20.521 11.712 20.713C11.52 20.905 11.2827 21.0007 11 21H5ZM17.175 13H10C9.71667 13 9.479 12.904 9.287 12.712C9.095 12.52 8.99934 12.2827 9 12C9 11.7167 9.096 11.479 9.288 11.287C9.48 11.095 9.71734 10.9993 10 11H17.175L15.3 9.125C15.1167 8.94167 15.025 8.71667 15.025 8.45C15.025 8.18333 15.1167 7.95 15.3 7.75C15.4833 7.55 15.7167 7.44567 16 7.437C16.2833 7.42834 16.525 7.52433 16.725 7.725L20.3 11.3C20.5 11.5 20.6 11.7333 20.6 12C20.6 12.2667 20.5 12.5 20.3 12.7L16.725 16.275C16.525 16.475 16.2873 16.571 16.012 16.563C15.7367 16.555 15.4993 16.4507 15.3 16.25C15.1167 16.05 15.029 15.8123 15.037 15.537C15.045 15.2617 15.141 15.0327 15.325 14.85L17.175 13Z" fill="#586C61"/>
                            </svg>
                            <div class="ms-3">
                                ログアウト
                            </div>
                        </div>
                    </a>
                </form>
            </div>
        </div>
        <x-recruit.navbar></x-recruit.navbar>
    </div>
    @vite(['resources/js/profile/studentProfile.js'])
</x-recruit.template>
