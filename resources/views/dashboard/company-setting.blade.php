<x-dashboard-template title="企業アカウント 設定画面">
    <x-dashboard.company-header>

    </x-dashboard.company-header>
    <input type="hidden" id="id" value="{{ $company->user_id }}">
    <main class="w-full py-6 px-4">
        <div class="w-full bg-white rounded flex flex-col">
            <div class="w-full font-bold text-lg p-4 border-b">各種設定</div>
            <div class="w-full flex">
                <div class="w-[300px] bg-gray-50 p-4">
                    通知メールの許可
                </div>
                <div class="p-4 flex items-center">
                    <span class="font-medium">許可しない</span>
                    <label class="relative inline-flex items-center mx-2 cursor-pointer">
                        <input id="mailPermission" type="checkbox" value="mail_permission" class="sr-only peer" @if($company->mail_permission == 1) checked @endif>
                        <div id="mailToggle" class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-green-300 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                    </label>
                    <span class="font-medium">許可する</span>
                </div>
            </div>
        </div>
        <div class="w-full bg-white rounded flex flex-col my-9">
            <form method="POST" action="{{ route('companyPasswordUpdate') }}">
                @csrf
                @method('put')
                <div class="w-full font-bold text-lg p-4 border-b">パスワード変更</div>
                <div class="w-full flex border-b">
                    <div class="w-[300px] bg-gray-50 p-4 flex items-center">
                        現在のパスワード
                    </div>
                    <div class="p-4 flex items-center w-full">
                        <!-- Current Password -->
                        <x-text-input hidden="current_password" class="block mt-1 w-full" type="password" name="current_password" required autocomplete="current_password" placeholder="現在のパスワード" />
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                    </div>
                </div>
                <div class="w-full flex border-b">
                    <div class="w-[300px] bg-gray-50 p-4 flex items-center">
                        新しいパスワード
                    </div>
                    <div class="p-4 flex items-center w-full">
                        <!-- Password -->
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="新しいパスワード" />
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                    </div>
                </div>
                <div class="w-full flex border-b">
                    <div class="w-[300px] bg-gray-50 p-4 flex items-center">
                        新しいパスワード確認用
                    </div>
                    <div class="p-4 flex items-center w-full">
                        <!-- Confirm Password -->
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="新しいパスワード確認用" />
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>
                <div class="w-full flex justify-center">
                    <div class="p-4">
                        <x-primary-button class="px-5">
                            {{ __('パスワード再設定') }}
                        </x-primary-button>
                        @if(session('status') === 'password-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 5000)"
                                class="text-sm text-gray-600"
                            >{{ __('パスワードが更新されました。') }}</p>
                        @endif
                    </div>
                </div>
            </form>
        </div>
        <div class="w-full bg-white rounded flex flex-col my-9">
            <div class="w-full font-bold text-lg p-4 border-b">解約申込</div>
            <div class="w-full flex">
                <div class="w-full p-4 flex justify-center items-center">
                    <a href="https://docs.google.com/forms/d/e/1FAIpQLScbek4EJSo6G0GCL1kDX5KSuExHzXA3EaXCGCjW0GPSSEH5WA/viewform?usp=sf_link" class="green-btn px-5">
                        ご解約フォーム
                    </a>
                </div>
            </div>
        </div>
    </main>
    @vite(['resources/js/dashboard/company/companySetting.js'])
</x-dashboard-template>
