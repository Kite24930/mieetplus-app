<x-dashboard-template title="企業アカウント">
    <x-dashboard.company-header>

    </x-dashboard.company-header>
    <main class="w-full py-6 px-4">
        <div class="w-full bg-white p-2">
            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                    @foreach($companies as $company)
                        <li class="mr-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="company-{{ $company->id }}-tab" data-tabs-target="#company-{{ $company->id }}" type="button" role="tab" aria-controls="company-{{ $company->id }}" aria-selected="false">
                                {{ $company->name }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div id="myTabContent">
                @foreach($companies as $company)
                    <div class="hidden w-full" id="company-{{ $company->id }}" role="tabpanel" aria-labelledby="company-{{ $company->id }}-tab">
                        <div class="p-3 bg-green-50 hidden">
                            <span class="text-lg">絞り込む</span>
                            <div class="flex justify-start p-4">
                                <div class="search-box w-96 flex items-center h-8">

                                    <button id="search" type="button" class="flex-center-box h-full w-8 rounded hover:bg-gray-200">
                                        <i class="bi bi-search"></i>
                                    </button>
                                    <x-search-box id="search-input" class="flex-grow h-3.5 bg-transparent border-none text-xs px-1" placeholder="検索" />
                                </div>
                            </div>
                        </div>
                        <div class="text-right pb-4 pr-4 text-sm text-grey-500">
                            {{ $count[$company->id] }}件中 <span id="applicable" class="text-base">{{ $count[$company->id] }}件</span>表示中
                        </div>
                        <hr class="w-full">
                        <div>
                            <table class="w-full">
                                <thead class="back-grey-50 border-b">
                                <tr class="text-left">
                                    <th class="p-4">名前</th>
                                    <th class="p-4">学部</th>
                                    <th class="p-4">学年</th>
                                    <th class="p-4">フォロー日</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($followers[$company->id] as $follower)
                                    <x-dashboard.followers-item :data="$follower" />
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Profile tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                    <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                    <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
                </div>
            </div>
        </div>
    </main>
    @vite(['resources/js/dashboard/company/followersList.js'])
</x-dashboard-template>
