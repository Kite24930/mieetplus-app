<x-auth-template title="パスワード再設定">
    <div id="container" class="w-full flex-center-box my-12 px-4">
        <div class="w-full max-w-xl px-4 sm:px-16 py-8 sm:py-11 rounded-3xl bg-white flex-center-box flex-col">
            <a href="{{ route('index') }}">
                <img src="{{ asset('storage/mieet_plus_logo.png') }}" alt="Mieet Plus" class="w-72">
            </a>
            <div class="w-full mt-9 mb-4">
                <div class="text-center text-2xl font-bold mb-4">
                    {{ __('パスワード再設定') }}
                </div>
            </div>
            <div class="mb-4 text-sm text-gray-600">
                {{ __('パスワードをお忘れですか？') }}
                <br>
                {{ __('ご登録のメールアドレスを入力してください。') }}
                <br>
                {{ __('パスワード再設定用のリンクを送信します。') }}
            </div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="w-full">
                @csrf

                <!-- Email Address -->
                <div class="my-9">
                    <x-text-input id="email" class="block mt-1 w-full h-12" placeholder="ご登録のメールアドレス" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button>
                        {{ __('パスワード再設定リンクを送信') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

</x-auth-template>
