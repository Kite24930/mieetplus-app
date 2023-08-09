<x-auth-template title="メールアドレス確認">
    <div id="container" class="w-full flex-center-box my-12 px-4">
        <div class="w-full max-w-xl px-4 sm:px-16 py-8 sm:py-11 rounded-3xl bg-white flex-center-box flex-col">
            <a href="{{ route('index') }}">
                <img src="{{ asset('storage/mieet_plus_logo.png') }}" alt="Mieet Plus" class="w-72">
            </a>
            <div class="w-full mt-9 mb-4">
                <div class="text-center text-2xl font-bold mb-4">
                    {{ __('メールアドレス確認') }}
                </div>
            </div>
            <div class="mb-4 text-sm text-gray-600">
                {{ __('ご登録いただきありがとうございます。') }}
                <br>
                {{ __('先ほどメールでお送りしたリンクをクリックして、メールアドレスを確認していただけますか？') }}
                <br>
                {{ __('メールが届かない場合は、下部のメールリンク再送信のボタンをクリックしてください。') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('新しい確認リンクが、登録時に指定した電子メール アドレスに送信されました。') }}
                </div>
            @endif

            <div class="mt-4 flex flex-col items-center justify-center w-full">
                <form method="POST" action="{{ route('verification.send') }}" class="w-full">
                    @csrf

                    <div>
                        <x-primary-button>
                            {{ __('メールリンク再送信') }}
                        </x-primary-button>
                    </div>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="mt-9">
                    @csrf

                    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('ログアウト') }}
                    </button>
                </form>
            </div>
        </div>
    </div>



</x-auth-template>
