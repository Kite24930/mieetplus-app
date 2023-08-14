<x-dashboard-template title="企業アカウント">
    <x-dashboard.admin-header>

    </x-dashboard.admin-header>
    <main class="w-full py-6 px-4">
        <div class="w-full bg-white">
            <div class="flex justify-between p-4">
                <a href="{{ route('companyAdd') }}" class="text-xs green-btn w-48 text-center">
                    新規登録
                </a>
                <div class="search-box w-96 flex items-center h-8">
                    <button id="search" type="button" class="flex-center-box h-full w-8 rounded hover:bg-gray-200">
                        <i class="bi bi-search"></i>
                    </button>
                    <x-search-box id="search-input" class="flex-grow h-3.5 bg-transparent border-none text-xs px-1" placeholder="検索" />
                </div>
            </div>
            <div class="text-right pb-4 pr-4 text-sm text-grey-500">
                {{ $count }}件中 <span id="applicable" class="text-base">{{ $count }}件</span>表示中
            </div>
            <hr class="w-full">
            <div>
                <table class="w-full">
                    <thead class="back-grey-50 border-b">
                        <tr class="text-left">
                            <th class="p-4">ID</th>
                            <th class="p-4">企業名</th>
                            <th class="p-4">業種</th>
                            <th class="p-4">表示設定</th>
                            <th class="p-4">登録日</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $company)
                            <x-dashboard.company-item :data="$company" />
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    @vite(['resources/js/dashboard/companyList.js'])
</x-dashboard-template>
