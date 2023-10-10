<x-dashboard-template title="管理画面" css="dashboard/companyDetail.css">
    <x-dashboard.company-header>

    </x-dashboard.company-header>
    <main class="w-full flex flex-col py-6 px-4 mb-10">
        @if(isset($msg))
            <div>
                <h1 class="text-3xl bg-yellow-500 underline p-3 inline-block rounded">{{ $msg }}</h1>
            </div>
        @endif
        @if($errors->count() > 0)
            <div>
                <ul class="text-xl bg-yellow-500 text-red-500 underline p-3 inline-block rounded">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="w-full bg-white">
            <h2 class="text-2xl m-3">企業部門リスト</h2>
            <p class="text-sm ml-6">@if(isset($limit)) {{ $limit->limit }} @else 5 @endif 部門まで登録できます。</p>
            @if(isset($limit))
                @if($limit->limit > $count)
                    <div class="flex justify-between p-4">
                        <a href="{{ route('companyDetailEdit', 0) }}" class="green-btn w-48 text-center">
                            新規登録
                        </a>
                    </div>
                @endif
            @else
                @if(5 > $count)
                    <div class="flex justify-between p-4">
                        <a href="{{ route('companyDetailEdit', 0) }}" class="green-btn w-48 text-center">
                            新規登録
                        </a>
                    </div>
                @endif
            @endif
            <hr>
            <div>
                <table class="w-full">
                    <thead class="back-grey-50 border-b">
                        <tr class="text-left text-sm">
                            <th class="p-4">会社名・部門名</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $company)
                            <x-dashboard.company-department-item :data="$company" />
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    @vite(['resources/js/dashboard/company/companyDetail.js'])
</x-dashboard-template>
