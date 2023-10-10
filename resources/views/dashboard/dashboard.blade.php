<x-dashboard-template title="管理画面" css="dashboard/dashboard.css">
    @can('admin')
        <x-dashboard.admin-header>

        </x-dashboard.admin-header>
        <main class="w-full flex py-9 px-12 gap-9">
            <div class="bg-white w-80 min-w-[20rem] rounded-lg text-sm">
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
        <main class="w-full py-9 px-12">
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
                        <div class="flex gap-9">
                            <div class="w-80">
                                <div class="bg-white w-full rounded-lg text-sm">
                                    <div class="p-4">
                                        最近フォローされた学生ユーザー
                                    </div>
                                    <hr>
                                    <ul class="mx-4">
                                        @foreach($students[$company->id] as $student)
                                            <x-dashboard.recently-student :data="$student" />
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="flex flex-col justify-start items-center flex-grow gap-6">
                                <div class="bg-white rounded-lg flex-center-box flex-col h-60 w-full">
                                    <div class="flex-center-box p-4">
                                        <div class="text-sm">
                                            Summary
                                        </div>
                                    </div>
                                    <hr class="w-full">
                                    <div class="flex justify-evenly items-center w-full p-16">
                                        <div class="flex-center-box flex-col flex-1 flex-grow">
                                            <div class="text-3xl font-bold">
                                                {{ $all_followers[$company->id] }}人
                                            </div>
                                            <div class="text-sm">
                                                フォロワー総数
                                            </div>
                                        </div>
                                        <div class="flex-center-box flex-col flex-1 flex-grow">
                                            <div class="text-3xl font-bold">
                                                {{ $monthly_followers[$company->id] }}人
                                            </div>
                                            <div class="text-sm">
                                                最近1ヶ月でフォローされた数
                                            </div>
                                        </div>
                                        <div class="flex-center-box flex-col flex-1 flex-grow">
                                            <div class="text-3xl font-bold">
                                                {{ $weekly_followers[$company->id] }}人
                                            </div>
                                            <div class="text-sm">
                                                最近1週間でフォローされた数
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full bg-white rounded-lg">
                                    <div class="flex-center-box p-4">
                                        <div class="text-sm">
                                            Followers Summary
                                        </div>
                                    </div>
                                    <hr class="w-full">
                                    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="categoryTab" data-tabs-toggle="#categoryTabContent" role="tablist">
                                            <li class="mr-2" role="presentation">
                                                <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="all-{{ $company->id }}-tab" data-tabs-target="#all-{{ $company->id }}" type="button" role="tab" aria-controls="all-{{ $company->id }}" aria-selected="false">
                                                    全体
                                                </button>
                                            </li>
                                            <li class="mr-2" role="presentation">
                                                <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="bachelor-{{ $company->id }}-tab" data-tabs-target="#bachelor-{{ $company->id }}" type="button" role="tab" aria-controls="bachelor-{{ $company->id }}" aria-selected="false">
                                                    学部
                                                </button>
                                            </li>
                                            <li class="mr-2" role="presentation">
                                                <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="master-{{ $company->id }}-tab" data-tabs-target="#master-{{ $company->id }}" type="button" role="tab" aria-controls="master-{{ $company->id }}" aria-selected="false">
                                                    研究科
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                    <div id="categoryTabContent">
                                        <div class="hidden w-full" id="all-{{ $company->id }}" role="tabpanel" aria-labelledby="all-{{ $company->id }}-tab">
                                            <div class="flex justify-evenly items-start w-full pb-4">
                                                <div class="flex flex-col justify-start items-center">
                                                    <div class="flex-center-box flex-col chart">
                                                        <canvas id="sex-{{ $company->id }}"></canvas>
                                                    </div>
                                                    <div class="rounded border border-gray-200">
                                                        <table class="text-sm text-left text-gray-500 dark:text-gray-400">
                                                            @foreach($sex_list as $sex_label)
                                                                <tr class="border-b border-gray-200">
                                                                    <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                                                        {{ $sex_label }}
                                                                    </th>
                                                                    <td class="px-4 py-2">
                                                                        {{ $sex[$company->id][$sex_label] }}人
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col justify-start items-center">
                                                    <div class="flex-center-box flex-col chart">
                                                        <canvas id="faculties-{{ $company->id }}"></canvas>
                                                    </div>
                                                    <div class="rounded border border-gray-200">
                                                        <table class="text-sm text-left text-gray-500 dark:text-gray-400">
                                                            @foreach($faculties_list as $faculty => $faculties_en)
                                                                <tr class="border-b border-gray-200">
                                                                    <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                                                        {{ $faculty }}
                                                                    </th>
                                                                    <td class="px-4 py-2">
                                                                        {{ $faculties[$company->id][$faculty] }}人
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hidden w-full" id="bachelor-{{ $company->id }}" role="tabpanel" aria-labelledby="bachelor-{{ $company->id }}-tab">
                                            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                                                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="bachelorTab" data-tabs-toggle="#bachelorTabContent" role="tablist">
                                                    @foreach($bachelor_list as $bachelor_jp => $bachelor_en)
                                                        <li class="mr-2" role="presentation">
                                                            <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="{{ $bachelor_en }}-{{ $company->id }}-tab" data-tabs-target="#{{ $bachelor_en }}-{{ $company->id }}" type="button" role="tab" aria-controls="{{ $bachelor_en }}-{{ $company->id }}" aria-selected="false">
                                                                {{ $bachelor_jp }}
                                                            </button>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div id="bachelorTabContent">
                                                @foreach($bachelor_list as $bachelor_jp => $bachelor_en)
                                                    <div class="hidden w-full" id="{{ $bachelor_en }}-{{ $company->id }}" role="tabpanel" aria-labelledby="{{ $bachelor_en }}-{{ $company->id }}-tab">
                                                        <div class="flex justify-evenly items-start w-full pb-4">
                                                            <div class="flex flex-col justify-start items-center">
                                                                <div class="flex-center-box flex-col chart">
                                                                    <canvas id="{{ $bachelor_en }}-sex-{{ $company->id }}"></canvas>
                                                                </div>
                                                                <div class="rounded border border-gray-200">
                                                                    <table class="text-sm text-left text-gray-500 dark:text-gray-400">
                                                                        @foreach($sex_list as $sex_label)
                                                                            <tr class="border-b border-gray-200">
                                                                                <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                                                                    {{ $sex_label }}
                                                                                </th>
                                                                                <td class="px-4 py-2">
                                                                                    {{ $faculty_sex[$company->id][$bachelor_jp][$sex_label] }}人
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="flex flex-col justify-start items-center">
                                                                <div class="flex-center-box flex-col chart">
                                                                    <canvas id="{{ $bachelor_en }}-grade-{{ $company->id }}"></canvas>
                                                                </div>
                                                                <div class="rounded border border-gray-200">
                                                                    <table class="text-sm text-left text-gray-500 dark:text-gray-400">
                                                                        @foreach($grades_list as $grade)
                                                                            <tr class="border-b border-gray-200">
                                                                                <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                                                                    {{ $grade }}
                                                                                </th>
                                                                                <td class="px-4 py-2">
                                                                                    {{ $faculty_grades[$company->id][$bachelor_jp][$grade] }}人
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="hidden w-full" id="master-{{ $company->id }}" role="tabpanel" aria-labelledby="master-{{ $company->id }}-tab">
                                            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                                                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center w-[600px]" id="bachelorTab" data-tabs-toggle="#bachelorTabContent" role="tablist">
                                                    @foreach($master_list as $master_jp => $master_en)
                                                        <li class="mr-2" role="presentation">
                                                            <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="{{ $master_en }}-{{ $company->id }}-tab" data-tabs-target="#{{ $master_en }}-{{ $company->id }}" type="button" role="tab" aria-controls="{{ $master_en }}-{{ $company->id }}" aria-selected="false">
                                                                {{ $master_jp }}
                                                            </button>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div id="bachelorTabContent">
                                                @foreach($master_list as $master_jp => $master_en)
                                                    <div class="hidden w-full" id="{{ $master_en }}-{{ $company->id }}" role="tabpanel" aria-labelledby="{{ $master_en }}-{{ $company->id }}-tab">
                                                        <div class="flex justify-evenly items-start w-full pb-4">
                                                            <div class="flex flex-col justify-start items-center">
                                                                <div class="flex-center-box flex-col chart">
                                                                    <canvas id="{{ $master_en }}-sex-{{ $company->id }}"></canvas>
                                                                </div>
                                                                <div class="rounded border border-gray-200">
                                                                    <table class="text-sm text-left text-gray-500 dark:text-gray-400">
                                                                        @foreach($sex_list as $sex_label)
                                                                            <tr class="border-b border-gray-200">
                                                                                <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                                                                    {{ $sex_label }}
                                                                                </th>
                                                                                <td class="px-4 py-2">
                                                                                    {{ $faculty_sex[$company->id][$master_jp][$sex_label] }}人
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="flex flex-col justify-start items-center">
                                                                <div class="flex-center-box flex-col chart">
                                                                    <canvas id="{{ $master_en }}-grade-{{ $company->id }}"></canvas>
                                                                </div>
                                                                <div class="rounded border border-gray-200">
                                                                    <table class="text-sm text-left text-gray-500 dark:text-gray-400">
                                                                        @foreach($grades_list as $grade)
                                                                            <tr class="border-b border-gray-200">
                                                                                <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap bg-gray-50">
                                                                                    {{ $grade }}
                                                                                </th>
                                                                                <td class="px-4 py-2">
                                                                                    {{ $faculty_grades[$company->id][$master_jp][$grade] }}人
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>
        <script>
            window.Laravel = {};
            window.Laravel.companies = @json($companies);
            window.Laravel.all_followers_count = @json($all_followers_count);
            window.Laravel.sex = @json($sex);
            window.Laravel.faculties = @json($faculties);
            window.Laravel.faculty_grades = @json($faculty_grades);
            window.Laravel.faculty_sex = @json($faculty_sex);
            window.Laravel.sex_list = @json($sex_list);
            window.Laravel.faculties_list = @json($faculties_list);
            window.Laravel.grades_list = @json($grades_list);
            window.Laravel.bachelor_list = @json($bachelor_list);
            window.Laravel.master_list = @json($master_list);
        </script>
    @endcan
    @vite(['resources/js/dashboard/dashboard.js'])
</x-dashboard-template>
