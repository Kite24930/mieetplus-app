<x-auth-template title="企業会員 新規登録">
    <div id="container" class="w-full flex-center-box my-12 px-4">
        <div class="w-full max-w-xl px-4 sm:px-16 py-8 sm:py-11 rounded-3xl bg-white flex-center-box flex-col">
            <a href="{{ route('index') }}">
                <img src="{{ asset('storage/mieet_plus_logo.png') }}" alt="Mieet Plus" class="w-72">
            </a>
            <div class="w-full mt-3">
                この度はご登録いただきありがとうございます。
                <br>
                初めてのログインとなりますので、初期パスワードからの変更をお願い致します。
            </div>
            @if(isset($error))
                <div>
                    <x-input-error :messages="$error" class="mt-2" />
                </div>
            @endif
            <form method="POST" action="{{ route('companyFirstLoginPost') }}" class="w-full">
                @csrf
                <!-- Name -->
                <div class="my-8">
                    <label for="name" class="text-xs text-green-500">企業名</label>
                    <x-text-input id="name" class="block mt-1 w-full h-12 disabled" placeholder="氏名" type="text" name="name" :value="$user->name" disabled autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="my-8">
                    <label for="email" class="text-xs text-green-500">メールアドレス</label>
                    <x-text-input id="email" class="block mt-1 w-full h-12 disabled" placeholder="メールアドレス" type="email" name="email" :value="$user->email" disabled autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="my-8">
                    <x-text-input id="password" class="block mt-1 w-full" placeholder="パスワード"
                                  type="password"
                                  name="password"
                                  required autocomplete="new-password" />
                    <label for="email" class="text-xs text-green-500">※半角英数字8文字以上</label>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="my-8">
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" placeholder="パスワード確認用"
                                  type="password"
                                  name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <x-primary-button class="mb-9">
                    {{ __('パスワード更新') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-auth-template>
