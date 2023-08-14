<x-dashboard-template title="企業アカウント">
    <x-dashboard.admin-header>

    </x-dashboard.admin-header>
    <main class="w-full py-6 px-4 flex justify-center">
        <div class="w-full max-w-xl px-4 py-8 rounded-3xl bg-white flex-center-box flex-col">
            <h1 class="text-4xl">企業アカウント発行</h1>
            <div class="my-8">
                @if($msg == 'ok')
                    <div class="text-center">企業アカウントの発行が完了しました。</div>
                <div>
                    <a href="mailto:{{ $email }}?cc=contact@mie-projectm.com&subject=【Mieet Plus 就活部】企業アカウント発行のお知らせ&body={{ $body }}" class="green-btn">登録完了メールを送る</a>
                </div>
                @else
                    <div>
                        <p class="text-center">企業アカウントの発行に失敗しました。</p>
                        <p>{{ $err }}</p>
                    </div>
                    <div>
                        <a href="{{ route('companyAdd') }}" class="green-btn">戻る</a>
                    </div>
                @endif
            </div>
        </div>
    </main>
    @vite(['resources/js/dashboard/companyAdd.js'])
</x-dashboard-template>
