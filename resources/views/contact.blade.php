<x-template title="Mieet Plus お問い合わせ">
    <x-header></x-header>
    <main class="w-full flex flex-col items-center justify-center">
        <div class="w-full max-w-4xl p-4 flex flex-col items-start justify-center">
            <h2 class="text-3xl font-bold mb-2">お問い合わせ</h2>
            <div class="w-full flex bg-white rounded-xl px-2">
                <form method="POST" action="{{ route('contactPost') }}" class="w-full">
                    @csrf
                    <!-- Types -->
                    <div class="my-4">
                        <div class="text-sm flex items-center">
                            <span class="badge bg-red text-white px-1 rounded mr-1">必須</span>種別
                        </div>
                        <div class="px-2 py-1 flex gap-5 items-center">
                            <div>
                                <x-text-input id="corporation" name="types" value="corporation" type="radio" checked />
                                <label for="corporation">法人</label>
                            </div>
                            <div>
                                <x-text-input id="individual" name="types" value="individual" type="radio" />
                                <label for="individual">個人</label>
                            </div>
                        </div>
                    </div>
                    <hr class="corporate">
                    <!-- Corporate Name -->
                    <div class="my-4 corporate required" data-target="corporate_name">
                        <div class="text-sm flex items-center">
                            <span class="badge bg-red text-white px-1 rounded mr-1">必須</span>企業名
                        </div>
                        <div class="px-2 py-1 h-12">
                            <x-text-input id="corporate_name" name="corporate_name" class="mt-1 w-full h-full" placeholder="企業名" type="text" required />
                            <x-input-error :messages="$errors->get('corporate_name')" class="mt-2" />
                        </div>
                    </div>
                    <hr class="corporate">
                    <!-- Corporate HP -->
                    <div class="my-4 corporate" data-target="corporate_hp">
                        <div class="text-sm flex items-center">
                            <span class="badge bg-gray-500 text-white px-1 rounded mr-1">任意</span>企業HP
                        </div>
                        <div class="px-2 py-1 h-12">
                            <x-text-input id="corporate_hp" name="corporate_hp" class="mt-1 w-full h-full" placeholder="企業HP" type="url" />
                            <x-input-error :messages="$errors->get('corporate_hp')" class="mt-2" />
                        </div>
                    </div>
                    <hr class="corporate">
                    <!-- Corporate Parson -->
                    <div class="my-4 corporate required" data-target="corporate_parson">
                        <div class="text-sm flex items-center">
                            <span class="badge bg-red text-white px-1 rounded mr-1">必須</span>担当者名
                        </div>
                        <div class="px-2 py-1 h-12">
                            <x-text-input id="corporate_parson" name="corporate_parson" class="mt-1 w-full h-full" placeholder="担当者名" type="text" required />
                            <x-input-error :messages="$errors->get('corporate_parson')" class="mt-2" />
                        </div>
                    </div>
                    <hr class="corporate">
                    <!-- Corporate Ruby -->
                    <div class="my-4 corporate required" data-target="corporate_ruby">
                        <div class="text-sm flex items-center">
                            <span class="badge bg-red text-white px-1 rounded mr-1">必須</span>担当者名ふりがな
                        </div>
                        <div class="px-2 py-1 h-12">
                            <x-text-input id="corporate_ruby" name="corporate_ruby" class="mt-1 w-full h-full" placeholder="担当者名ふりがな" type="text" required />
                            <x-input-error :messages="$errors->get('corporate_ruby')" class="mt-2" />
                        </div>
                    </div>
                    <hr class="individual hidden">
                    <!-- Individual Name -->
                    <div class="my-4 individual required hidden" data-target="individual_name">
                        <div class="text-sm flex items-center">
                            <span class="badge bg-red text-white px-1 rounded mr-1">必須</span>氏名
                        </div>
                        <div class="px-2 py-1 h-12">
                            <x-text-input id="individual_name" name="individual_name" class="mt-1 w-full h-full" placeholder="氏名" type="text" />
                            <x-input-error :messages="$errors->get('individual_name')" class="mt-2" />
                        </div>
                    </div>
                    <hr class="individual hidden">
                    <!-- Individual Ruby -->
                    <div class="my-4 individual required hidden" data-target="individual_ruby">
                        <div class="text-sm flex items-center">
                            <span class="badge bg-red text-white px-1 rounded mr-1">必須</span>氏名ふりがな
                        </div>
                        <div class="px-2 py-1 h-12">
                            <x-text-input id="individual_ruby" name="individual_ruby" class="mt-1 w-full h-full" placeholder="氏名ふりがな" type="text" />
                            <x-input-error :messages="$errors->get('individual_ruby')" class="mt-2" />
                        </div>
                    </div>
                    <hr>
                    <!-- Address -->
                    <div class="my-4">
                        <div class="text-sm flex items-center">
                            <span class="badge bg-red text-white px-1 rounded mr-1">必須</span>住所(市町村まで)
                        </div>
                        <div class="px-2 py-1 h-12">
                            <x-text-input id="address" name="address" class="mt-1 w-full h-full" placeholder="住所(市町村まで)" type="text" required />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>
                    </div>
                    <hr>
                    <!-- Tel -->
                    <div class="my-4">
                        <div class="text-sm flex items-center">
                            <span class="badge bg-gray-500 text-white px-1 rounded mr-1">任意</span>電話番号(ハイフンなし)
                        </div>
                        <div class="px-2 py-1 h-12">
                            <x-text-input id="tel" name="tel" class="mt-1 w-full h-full" placeholder="電話番号(ハイフンなし)" type="tel" />
                            <x-input-error :messages="$errors->get('tel')" class="mt-2" />
                        </div>
                    </div>
                    <hr>
                    <!-- Email -->
                    <div class="my-4">
                        <div class="text-sm flex items-center">
                            <span class="badge bg-red text-white px-1 rounded mr-1">必須</span>メールアドレス
                        </div>
                        <div class="px-2 py-1 h-12">
                            <x-text-input id="email" name="email" class="mt-1 w-full h-full" placeholder="メールアドレス" type="email" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>
                    <hr>
                    <!-- Content -->
                    <div class="my-4">
                        <div class="text-sm flex items-center">
                            <span class="badge bg-red text-white px-1 rounded mr-1">必須</span>お問い合わせ内容
                        </div>
                        <div class="px-2 py-1">
                            <textarea name="contents" id="contents" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" rows="10" required></textarea>
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                    </div>
                    <hr>
                    <div class="my-4 flex flex-col justify-center items-center">
                        <div class="text-sm mb-2">
                            送信された内容は担当者が確認後、入力していただいたメールアドレスにより返信いたします。
                        </div>
                        <button class="green-btn px-4">問い合わせを送信する</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <hr class="w-full px-2 md:px-4">
    <x-footer :services="$services"></x-footer>
    @vite(['resources/js/contact.js'])
</x-template>
