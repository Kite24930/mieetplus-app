<x-dashboard-template title="企業アカウント" css="dashboard/dashboard.css">
    <x-dashboard.admin-header>

    </x-dashboard.admin-header>
    <main class="w-full py-6 px-4 flex justify-center">
        <div class="w-full max-w-xl px-4 py-8 rounded-3xl bg-white flex-center-box flex-col">
            <h1 class="text-4xl">企業アカウント発行</h1>
            <div class="my-8">
                @if($msg == 'ok')
                    <div class="text-center">企業アカウントの発行が完了しました。</div>
                </div>
                <div class="m-8 w-full text-center flex-center-box">
                    <a href="mailto:{{ $email }}?cc=contact@mie-projectm.com&subject=【Mieet Plus 就活部】企業アカウント発行のお知らせ&body={{ $body }}" class="green-btn w-full">登録完了メールを送る</a>
                @else
                    <div>
                        <p class="text-center">企業アカウントの発行に失敗しました。</p>
                        <p>{{ $err }}</p>
                    </div>
                </div>
                <div class="m-8 flex-center-box text-center">
                    <a href="{{ route('companyAdd') }}" class="green-btn w-full">戻る</a>
                @endif
            </div>
        </div>
    </main>
    @vite(['resources/js/dashboard/companyAdd.js'])
</x-dashboard-template>
