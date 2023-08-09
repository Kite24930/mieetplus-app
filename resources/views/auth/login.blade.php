<x-auth-template title="ログイン画面">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div id="container" class="w-full flex-center-box my-12 px-4">
        <div class="w-full max-w-xl px-4 sm:px-16 py-8 sm:py-11 rounded-3xl bg-white flex-center-box flex-col">
            <a href="{{ route('index') }}">
                <img src="{{ asset('storage/mieet_plus_logo.png') }}" alt="Mieet Plus" class="w-72 mb-10">
            </a>
            <form method="POST" action="{{ route('login') }}" class="w-full">
                @csrf
                <!-- Email Address -->
                <div class="my-9">
                    <x-text-input id="email" class="block mt-1 w-full h-12" placeholder="メールアドレス" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="my-9">
                    <x-text-input id="password" class="block mt-1 w-full h-12" placeholder="パスワード" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="my-9 flex-center-box">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>
                <x-primary-button class="mb-9">
                    {{ __('ログイン') }}
                </x-primary-button>
                <div class="flex items-center justify-center flex-col">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 m-3" href="{{ route('password.request') }}">
                            {{ __('パスワードを忘れた場合はこちら') }}
                        </a>
                    @endif
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 m-3" href="{{ route('register') }}">
                            学生会員の新規登録はこちら
                        </a>
                </div>
            </form>
        </div>
    </div>

</x-auth-template>
