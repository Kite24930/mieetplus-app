<x-template title="Mieet Plus お問い合わせ">
    <x-header></x-header>
    <main class="w-full flex flex-col items-center justify-center">
        <div class="w-full max-w-4xl p-4 flex flex-col items-start justify-center">
            <h2 class="text-3xl font-bold mb-2">お問い合わせ</h2>
            <div class="w-full flex bg-white rounded-xl p-4 flex-col justify-center items-center">
                <div>
                    <p class="text-xl font-bold">お問い合わせありがとうございました。</p>
                    <p class="text-xl font-bold">担当者よりご連絡させていただきます。</p>
                </div>
                <a href="{{ route('index') }}" class="green-btn px-4 my-4">Mieet Plus HPに戻る</a>
            </div>
        </div>
    </main>
    <hr class="w-full px-2 md:px-4">
    <x-footer :services="$services"></x-footer>
    @vite(['resources/js/contact-success.js'])
</x-template>
