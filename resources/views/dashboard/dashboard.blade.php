<x-dashboard-template title="管理画面">
    @can('admin')
        <x-dashboard.admin-header>

        </x-dashboard.admin-header>
        <main class="w-full flex py-9 px-12 gap-9">
            <div class="bg-white w-80 rounded-lg text-sm">
                <div class="p-4">
                    最近登録した学生ユーザー
                </div>
                <hr class="w-full">
                <ul class="mx-4">
                    @foreach($students as $student)
                        <x-dashboard.recently-student :data="$student" />
                    @endforeach
                </ul>
            </div>
            <div class="bg-white flex-grow rounded-lg flex-center-box flex-col h-60">
                <div class="flex-center-box p-4">
                    <div class="text-sm">
                        Summary
                    </div>
                </div>
                <hr class="w-full">
                <div class="flex justify-evenly items-center w-full p-16">
                    <div class="flex-center-box flex-col flex-1 flex-grow">
                        <div class="text-3xl font-bold">
                            {{ $student_count }}人
                        </div>
                        <div class="text-sm">
                            学生ユーザー総数
                        </div>
                    </div>
                    <div class="flex-center-box flex-col flex-1 flex-grow">
                        <div class="text-3xl font-bold">
                            {{ $company_count }}社
                        </div>
                        <div class="text-sm">
                            企業アカウント総数
                        </div>
                    </div>
                    <div class="flex-center-box flex-col flex-1 flex-grow">
                        <div class="text-3xl font-bold">
                            {{ $today_followed_count }}回
                        </div>
                        <div class="text-sm">
                            今日学生がフォローした総数
                        </div>
                    </div>
                </div>
            </div>
        </main>
    @elsecan('company')
        <x-dashboard.company-header>

        </x-dashboard.company-header>
        <main class="w-full flex py-9 px-12 gap-9">
            <div class="bg-white w-80 rounded-lg text-sm">
                <div class="p-4">
                    最近登録した学生ユーザー
                </div>
                <hr class="w-full">
                <ul class="mx-4">
                    @foreach($students as $student)
                        <x-dashboard.recently-student :data="$student" />
                    @endforeach
                </ul>
            </div>
            <div class="bg-white flex-grow rounded-lg flex-center-box flex-col h-60">
                <div class="flex-center-box p-4">
                    <div class="text-sm">
                        Summary
                    </div>
                </div>
                <hr class="w-full">
                <div class="flex justify-evenly items-center w-full p-16">
                    <div class="flex-center-box flex-col flex-1 flex-grow">
                        <div class="text-3xl font-bold">
                            {{ $student_count }}人
                        </div>
                        <div class="text-sm">
                            学生ユーザー総数
                        </div>
                    </div>
                    <div class="flex-center-box flex-col flex-1 flex-grow">
                        <div class="text-3xl font-bold">
                            {{ $company_count }}社
                        </div>
                        <div class="text-sm">
                            企業アカウント総数
                        </div>
                    </div>
                    <div class="flex-center-box flex-col flex-1 flex-grow">
                        <div class="text-3xl font-bold">
                            {{ $today_followed_count }}回
                        </div>
                        <div class="text-sm">
                            今日学生がフォローした総数
                        </div>
                    </div>
                </div>
            </div>
        </main>
    @endcan
    @vite(['resources/js/dashboard/dashboard.js'])
</x-dashboard-template>
