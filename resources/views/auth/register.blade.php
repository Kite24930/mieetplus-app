<x-auth-template title="学生会員 新規登録">
    <div id="container" class="w-full flex-center-box my-12 px-4">
        <div class="w-full max-w-xl px-4 sm:px-16 py-8 sm:py-11 rounded-3xl bg-white flex-center-box flex-col">
            <a href="{{ route('index') }}">
                <img src="{{ asset('storage/mieet_plus_logo.png') }}" alt="Mieet Plus" class="w-72">
            </a>
            <form method="POST" action="{{ route('register') }}" class="w-full">
                @csrf
                <!-- Email Address -->
                <div class="my-8">
                    <x-text-input id="email" class="block mt-1 w-full h-12" placeholder="メールアドレス" type="email" name="email" :value="old('email')" autofocus required autocomplete="username" />
                    <label for="email" class="text-xs text-green-500">※三重大学ドメイン(@m.mie-u.ac.jp)のメールアドレスのみ</label>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Name -->
                <div class="my-8">
                    <x-text-input id="name" class="block mt-1 w-full h-12" placeholder="氏名" type="text" name="name" :value="old('name')" required autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="flex flex-col sm:flex-row justify-between w-full gap-9">
                    <!-- Faculty -->
                    <div>
                        <x-input-select id="faculty" class="select block mt-1 w-full h-12 mr-3" placeholder="学部" name="faculty" :value="old('faculty')" required autofocus autocomplete="faculty" style="color: #ACB6BE">
                            <option value="placeholder" disabled selected class="hidden">学部・学科</option>
                            <optgroup label="学部">
                                <option value="人文学部">人文学部</option>
                                <option value="教育学部">教育学部</option>
                                <option value="医学部">医学部</option>
                                <option value="工学部">工学部</option>
                                <option value="生物資源学部">生物資源学部</option>
                            </optgroup>
                            <optgroup label="大学院">
                                <option value="人文社会科学研究科">人文社会科学研究科</option>
                                <option value="教育学研究科">教育学研究科</option>
                                <option value="医学科研究科">医学科研究科</option>
                                <option value="工学研究科">工学研究科</option>
                                <option value="生物資源学研究科">生物資源学研究科</option>
                                <option value="地域イノベーション学研究科">地域イノベーション学研究科</option>
                            </optgroup>
                        </x-input-select>
                        <x-input-error :messages="$errors->get('faculty')" class="mt-2" />
                    </div>
                    <!-- Grade -->
                    <div>
                        <x-input-select id="glade" class="select block mt-1 w-full h-12 mr-3" placeholder="学年" name="glade" :value="old('glade')" required autofocus autocomplete="glade" style="color: #ACB6BE">
                            <option value="placeholder" disabled selected class="hidden">学年</option>
                            <optgroup label="学部">
                                <option value="1">1年</option>
                                <option value="2">2年</option>
                                <option value="3">3年</option>
                                <option value="4">4年</option>
                                <option value="5">5年</option>
                                <option value="6">6年</option>
                            </optgroup>
                            <optgroup label="大学院">
                                <option value="M1">1年</option>
                                <option value="M2">2年</option>
                                <option value="M3">3年</option>
                                <option value="M4">4年</option>
                            </optgroup>
                        </x-input-select>
                        <x-input-error :messages="$errors->get('glade')" class="mt-2" />
                    </div>
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
                    {{ __('新規登録') }}
                </x-primary-button>
                <div class="flex items-center justify-center mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('登録済みの学生会員の方はこちら') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-auth-template>
