<x-recruit.template title="My Page" css="profile/studentProfile.css">
    <div class="fixed top-0 left-0 z-510 p-2 h-[60px] flex items-center">
        <a href="{{ route('profile.show') }}">
            <i class="bi bi-caret-left-fill"></i><i class="bi bi-person-circle"></i>アカウント
        </a>
    </div>
    <div id="container" class="w-full justify-center bg-mieetcolor flex">
        <div class="container max-w-[550px] flex flex-col justify-center bg-white">
            @if($request->session()->has('error'))
                <div class="p-4 text-xl text-red-500">
                    {{ $request->session()->get('error') }}
                </div>
            @endif
            <form id="form" name="postForm" action="{{ route('profile.edit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="w-full flex flex-col py-2 px-4">
                    <div class="text-sm">氏名</div>
                    <div>
                        <x-text-input id="name" class="block mt-1 w-full h-12 disabled" placeholder="氏名" type="text" name="name" :value="$account->name" readonly />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                </div>
                <div class="w-full flex flex-col py-2 px-4">
                    <div class="text-sm">学籍メール</div>
                    <div>
                        @if(isset($account->univ_email) && str_contains($account->univ_email, '@m.mie-u.ac.jp'))
                            <x-text-input id="email" class="block mt-1 w-full h-12 disabled" placeholder="学籍メール" type="text" name="email" :value="$account->univ_email" required autocomplete="email" readonly />
                        @else
                            <div class="text-xs text-grey-500 pl-2">@m.mie-u.ac.jpのアドレスを登録していただけると全機能がご利用できます。</div>
                            <x-text-input id="email" class="block mt-1 w-full h-12" placeholder="学籍メール" type="text" name="email" :value="$account->univ_email" required autocomplete="email" />
                        @endif
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>
                <div class="w-full flex flex-col py-2 px-4">
                    <div class="text-sm">性別</div>
                    <div class="text-xs text-grey-500 pl-2">変更できません。</div>
                    <div>
                        @switch($account->sex)
                            @case(0)
                                <x-text-input class="block mt-1 w-full h-12 disabled" type="text" value="男性" readonly />
                                @break
                            @case(1)
                                <x-text-input class="block mt-1 w-full h-12 disabled" type="text" value="女性" readonly />
                                @break
                            @case(2)
                                <x-text-input class="block mt-1 w-full h-12 disabled" type="text" value="その他" readonly />
                                @break
                            @case(3)
                                <x-text-input class="block mt-1 w-full h-12 disabled" type="text" value="非回答" readonly />
                                @break
                        @endswitch
                    </div>
                </div>
                <div class="w-full flex flex-col py-2 px-4">
                    <div class="text-sm">誕生日</div>
                    <div class="text-xs text-grey-500 pl-2">変更できません。</div>
                    <div>
                        <x-text-input class="block mt-1 w-full h-12 disabled" type="text" :value="$account->birthday" readonly />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                </div>
                <div class="w-full flex flex-col py-2 px-4">
                    <div class="text-sm">学部</div>
                    <div>
                        <x-input-select id="faculty" class="block mt-1 w-full h-12" placeholder="学部" name="faculty" required>
                            @foreach($faculties as $faculty => $faculty_en)
                                <option value="{{ $faculty }}" @if($account->faculty == $faculty) selected @endif>{{ $faculty }}</option>
                            @endforeach
                        </x-input-select>
                        <x-input-error :messages="$errors->get('faculty')" class="mt-2" />
                    </div>
                </div>
                <div class="w-full flex flex-col py-2 px-4">
                    <div class="text-sm">学年</div>
                    <div>
                        <x-input-select id="grade" class="block mt-1 w-full h-12" placeholder="学年" name="grade" required>
                            @foreach($grades as $grade)
                                <option value="{{ $grade }}" @if($account->grade == $grade) selected @endif>{{ $grade }}年</option>
                            @endforeach
                        </x-input-select>
                        <x-input-error :messages="$errors->get('grade')" class="mt-2" />
                    </div>
                </div>
                <div class="w-full flex flex-col py-2 px-4">
                    <div class="text-sm">表示名</div>
                    <div class="text-xs text-grey-500 pl-2">企業から見える表示名を設定できます(未設定の場合は氏名が表示されます)</div>
                    <div>
                        @if(isset($account->screen_name))
                            <x-text-input id="screen_name" class="block mt-1 w-full h-12" placeholder="表示名" type="text" name="screen_name" :value="$account->screen_name" />
                        @else
                            <x-text-input id="screen_name" class="block mt-1 w-full h-12" placeholder="表示名" type="text" name="screen_name" :value="$account->name" />
                        @endif
                        <x-input-error :messages="$errors->get('screen_name')" class="mt-2" />
                    </div>
                </div>
                <div class="w-full flex flex-col py-2 px-4">
                    <div class="text-sm">TOP画像</div>
                    <div class="flex items-center">
                        <img id="topImg" src="@if(isset($account->img)){{ asset('storage/student/'.$account->user_id.'/'.$account->img) }}@else{{ asset('storage/account_default.png') }}@endif" alt="{{ $account->name }}" class="w-16 h-16 object-cover rounded-full mieet-border">
                        <div class="py-3 pl-4">
                            <input id="img" name="img" type="file" accept="image/jpeg,image/png" class="hidden">
                            <div>
                                <label for="img" class="bg-greencolor text-white px-3 py-2 rounded cursor-pointer">ファイルを選択</label>
                                <br>
                                <div id="img_file" class="ml-3 omission w-80 inline-block mt-4">ファイルが選択されていません</div>
                            </div>
                        </div>
                    </div>

                    <x-input-error :messages="$errors->get('img')" class="mt-2" />
                </div>
                <div class="w-full flex flex-col py-2 px-4">
                    <div class="text-sm">通知メールの許可</div>
                    <div class="py-2 px-4 flex items-center">
                        <span class="font-medium">許可しない</span>
                        <label class="relative inline-flex items-center mx-2 cursor-pointer">
                            <input id="notice" name="notice" type="checkbox" value="notice" class="sr-only peer" @if($account->notice == 1) checked @endif>
                            <div id="noticeToggle" class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-green-300 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                        </label>
                        <span class="font-medium">許可する</span>
                        <x-input-error :messages="$errors->get('notice')" class="mt-2" />
                    </div>
                </div>
                <div class="w-full flex flex-col py-2 px-4">
                    <div class="text-sm">閲覧履歴の利用許可</div>
                    <div class="py-2 px-4 flex items-center">
                        <span class="font-medium">許可しない</span>
                        <label class="relative inline-flex items-center mx-2 cursor-pointer">
                            <input id="history" name="history" type="checkbox" value="history" class="sr-only peer" @if($account->history == 1) checked @endif>
                            <div id="historyToggle" class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-green-300 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                        </label>
                        <span class="font-medium">許可する</span>
                        <x-input-error :messages="$errors->get('history')" class="mt-2" />
                    </div>
                </div>
                <div class="w-full flex flex-col pt-4 px-4 pb-6">
                    <button id="submit" class="w-full bg-greencolor text-white text-lg rounded py-2">
                        更新
                    </button>
                </div>
            </form>
        </div>
        <x-recruit.navbar></x-recruit.navbar>
    </div>
    @vite(['resources/js/profile/studentProfileEdit.js'])
</x-recruit.template>
