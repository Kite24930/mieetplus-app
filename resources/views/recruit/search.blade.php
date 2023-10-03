<x-recruit.template title="検索">
    <div id="loading" class="w-full h-full fixed top-0 left-0 flex justify-center items-center z-1000">
        <div class="ring absolute">
            loading
            <span></span>
        </div>
    </div>
    <div class="fixed top-0 left-0 z-510 p-2 h-[60px] flex items-center">
        <button type="button" onclick="history.back()">
            <i class="bi bi-caret-left-fill"></i>戻る
        </button>
    </div>
    <div id="searchBox" class="fixed w-full z-450 h-[60px] flex justify-center items-center bg-mieetcolor">
        <div class="w-full max-w-[550px] flex justify-between items-center bg-white py-2 px-4">
            <form action="{{ route('searchPost') }}" method="POST" class="w-full flex items-center pr-4">
                @csrf
                <input type="hidden" name="search" value="1">
                <input type="hidden" name="free_word_activate" value="true">
                <input type="text" id="search_free_word" name="free_word" class="w-full h-12 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500  shadow-sm rounded-l-md" placeholder="フリーワード検索" @if(isset($request->free_word)) value="{{ $request->free_word }}" @endif>
                <button class="px-2 h-12 bg-blue-700 rounded-r-md flex justify-center items-center">
                    <i class="bi bi-search text-2xl text-white"></i>
                </button>
            </form>
            <button id="filterDropdownBtn" data-dropdown-toggle="filter" type="button">
                <i class="bi bi-filter-left text-3xl"></i>
            </button>
            <div id="filter" class="w-[100dvw] max-w-[550px] hidden bg-white mieet-border rounded overflow-y-auto">
                <div class="flex flex-col w-full">
                    <div class="text-center py-3 text-2xl">
                        検索条件を指定
                    </div>
                    <div class="py-2 px-4">
                        <a href="{{ route('search', ['search', 0]) }}" class="inline-block w-full py-2 rounded bg-greencolor text-white text-center">
                            条件をリセット
                        </a>
                    </div>
                    <div class="border w-full flex flex-col">
                        <form action="{{ route('searchPost') }}" method="POST">
                            @csrf
                            <input type="hidden" name="search" value="1">
                            <div class="py-2 px-4">
                                <div class="text-sm text-grey-500">
                                    フリーワード
                                    <label class="ml-3">
                                        <input type="checkbox" id="free_word_activate" name="free_word_activate" @if(isset($request->free_word)) checked @endif>
                                        有効化
                                    </label>
                                </div>
                                <div class="w-full p-3">
                                    <input type="text" id="free_word" name="free_word" class="mt-1 h-12 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm inline-block w-full" @if(isset($request->free_word)) value="{{ $request->free_word }}" @endif>
                                </div>
                            </div>
                            <div class="py-2 px-4">
                                <div class="text-sm text-grey-500">
                                    会社名
                                    <label class="ml-3">
                                        <input type="checkbox" id="name_activate" name="name_activate" @if(isset($request->name)) checked @endif>
                                        有効化
                                    </label>
                                </div>
                                <div class="w-full p-3">
                                    <input type="text" id="name" name="name" class="mt-1 h-12 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm inline-block w-full" @if(isset($request->name)) value="{{ $request->name }}" @endif>
                                </div>
                            </div>
                            <div class="py-2 px-4">
                                <div class="text-sm text-grey-500">
                                    業種
                                    <label class="ml-3">
                                        <input type="checkbox" id="category_activate" name="category_activate" @if(isset($request->category)) checked @endif>
                                        有効化
                                    </label>
                                </div>
                                <div class="h-28 w-full overflow-y-auto p-3 border">
                                    @foreach($categories as $category)
                                        <label>
                                            <input type="checkbox" value="{{ $category->name }}" @if(str_contains($request->category, $category->name)) checked @endif class="search-category">
                                            {{ $category->name }}
                                        </label>
                                        <br>
                                    @endforeach
                                </div>
                                <input type="hidden" id="category" name="category" @if(isset($request->category)) value="{{ $request->category }}" @endif>
                            </div>
                            <div class="py-2 px-4">
                                <div class="text-sm text-grey-500">
                                    本社所在地
                                    <label class="ml-3">
                                        <input type="checkbox" id="location_activate" name="location_activate" @if(isset($request->location)) checked @endif>
                                        有効化
                                    </label>
                                </div>
                                <div class="h-28 w-full overflow-y-auto p-3 border">
                                    @foreach($prefectures as $prefecture)
                                        <label>
                                            <input type="checkbox" value="{{ $prefecture }}" @if(str_contains($request->location, $prefecture)) checked @endif class="search-location">
                                            {{ $prefecture }}
                                        </label>
                                        <br>
                                    @endforeach
                                </div>
                                <input type="hidden" id="location" name="location" @if(isset($request->locaiton)) value="{{ $request->location }}" @endif>
                            </div>
                            <div class="py-2 px-4">
                                <div class="text-sm text-grey-500">
                                    勤務地
                                    <label class="ml-3">
                                        <input type="checkbox" id="work_location_activate" name="work_location_activate" @if(isset($request->work_location)) checked @endif>
                                        有効化
                                    </label>
                                </div>
                                <div class="h-28 w-full overflow-y-auto p-3 border">
                                    @foreach($prefectures as $prefecture)
                                        <label>
                                            <input type="checkbox" value="{{ $prefecture }}" @if(str_contains($request->work_location, $prefecture)) checked @endif class="search-work_location">
                                            {{ $prefecture }}
                                        </label>
                                        <br>
                                    @endforeach
                                </div>
                                <input type="hidden" id="work_location" name="work_location" @if(isset($request->work_locaiton)) value="{{ $request->work_locaiton }}" @endif>
                            </div>
                            <div class="py-2 px-4">
                                <div class="text-sm text-grey-500">
                                    設立年月
                                    <label class="ml-3">
                                        <input type="checkbox" id="establishment_activate" name="establishment_activate" @if(isset($request->establishment_date)) checked @endif>
                                        有効化
                                    </label>
                                </div>
                                <div class="w-full overflow-y-auto px-3">
                                    <input type="month" id="establishment_date" name="establishment_date" class="mt-1 h-12 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-[150px] inline-block" @if(isset($request->establishment_date)) value="{{ date('Y-m', strtotime($request->establishment_date)) }}" @else value="{{ date('Y-m') }}" @endif>
                                    <label class="mx-2">
                                        <input type="radio" id="establishment_type_before" name="establishment_date_type" value="before" @if(isset($request->establishment_date_type)) @if($request->establishment_date_type === 'before') checked @endif @else checked @endif>
                                        以前
                                    </label>
                                    <label class="mx-2">
                                        <input type="radio" id="establishment_type_after" name="establishment_date_type" value="after" @if(isset($request->establishment_date_type)) @if($request->establishment_date_type === 'after') checked @endif @endif>
                                        以降
                                    </label>
                                </div>
                            </div>
                            <div class="py-2 px-4">
                                <div class="text-sm text-grey-500">
                                    資本金
                                    <label class="ml-3">
                                        <input type="checkbox" id="capital_activate" name="capital_activate" @if(isset($request->capital)) checked @endif>
                                        有効化
                                    </label>
                                </div>
                                <div class="w-full overflow-y-auto px-3">
                                    <input type="number" id="capital" name="capital" class="mt-1 h-12 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-[100px] inline-block" @if(isset($request->capital)) value="{{ $request->capital }}" @else value="0" @endif>
                                    百万円
                                    <label class="mx-2">
                                        <input type="radio" id="capital_type_more" name="capital_type" value="more" @if(isset($request->capital_type)) @if($request->capital_type === 'more') checked @endif @else checked @endif>
                                        以上
                                    </label>
                                    <label class="mx-2">
                                        <input type="radio" id="capital_type_less" name="capital_type" value="less" @if(isset($request->capital_type)) @if($request->capital_type === 'less') checked @endif @endif>
                                        以下
                                    </label>
                                </div>
                            </div>
                            <div class="py-2 px-4">
                                <div class="text-sm text-grey-500">
                                    売上金
                                    <label class="ml-3">
                                        <input type="checkbox" id="sales_activate" name="sales_activate" @if(isset($request->sales)) checked @endif>
                                        有効化
                                    </label>
                                </div>
                                <div class="w-full overflow-y-auto px-3">
                                    <input type="number" id="sales" name="sales" class="mt-1 h-12 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-[100px] inline-block" @if(isset($request->sales)) value="{{ $request->sales }}" @else value="0" @endif>
                                    百万円
                                    <label class="mx-2">
                                        <input type="radio" id="sales_type_more" name="sales_type" value="more" @if(isset($request->sales_type)) @if($request->sales_type === 'more') checked @endif @else checked @endif>
                                        以上
                                    </label>
                                    <label class="mx-2">
                                        <input type="radio" id="sales_type_less" name="sales_type" value="less" @if(isset($request->sales_type)) @if($request->sales_type === 'less') checked @endif @endif>
                                        以下
                                    </label>
                                </div>
                            </div>
                            <div class="py-2 px-4">
                                <div class="text-sm text-grey-500">
                                    従業員数
                                    <label class="ml-3">
                                        <input type="checkbox" id="employee_activate" name="employee_activate" @if(isset($request->employee_number)) checked @endif>
                                        有効化
                                    </label>
                                </div>
                                <div class="w-full overflow-y-auto px-3">
                                    <input type="number" id="employee_number" name="employee_number" class="mt-1 h-12 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-[100px] inline-block" @if(isset($request->employee_number)) value="{{ $request->employee_number }}" @else value="0" @endif>
                                    人
                                    <label class="mx-2">
                                        <input type="radio" id="employee_number_type_more" name="employee_number_type" value="more" @if(isset($request->employee_number_type)) @if($request->employee_number_type === 'more') checked @endif @else checked @endif>
                                        以上
                                    </label>
                                    <label class="mx-2">
                                        <input type="radio" id="employee_number_type_less" name="employee_number_type" value="less" @if(isset($request->employee_number_type)) @if($request->employee_number_type === 'less') checked @endif @endif>
                                        以下
                                    </label>
                                </div>
                            </div>
                            <div class="py-2 px-4">
                                <div class="text-sm text-grey-500">
                                    三重大学生OB・OG数
                                    <label class="ml-3">
                                        <input type="checkbox" id="graduated_activate" name="graduated_activate" @if(isset($request->graduated_number)) checked @endif>
                                        有効化
                                    </label>
                                </div>
                                <div class="w-full overflow-y-auto px-3">
                                    <input type="number" id="graduated_number" name="graduated_number" class="mt-1 h-12 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-[100px] inline-block" @if(isset($request->graduated_number)) value="{{ $request->graduated_number }}" @else value="0" @endif>
                                    人
                                    <label class="mx-2">
                                        <input type="radio" id="graduated_number_type_more" name="graduated_number_type" value="more" @if(isset($request->graduated_number_type)) @if($request->graduated_number_type === 'more') checked @endif @else checked @endif>
                                        以上
                                    </label>
                                    <label class="mx-2">
                                        <input type="radio" id="graduated_number_type_less" name="graduated_number_type" value="less" @if(isset($request->graduated_number_type)) @if($request->graduated_number_type === 'less') checked @endif @endif>
                                        以下
                                    </label>
                                </div>
                            </div>
                            <div class="py-2 px-4">
                                <div class="text-sm text-grey-500">
                                    対象学部
                                    <label class="ml-3">
                                        <input type="checkbox" id="faculty_activate" name="faculty_activate" @if(isset($request->faculties)) checked @endif>
                                        有効化
                                    </label>
                                </div>
                                <div class="h-28 w-full overflow-y-auto p-3 border">
                                    @foreach($faculties as $faculty)
                                        <label>
                                            <input type="checkbox" value="{{ $faculty }}" @if(str_contains($request->faculties, $faculty)) checked @endif class="search-faculty">
                                            {{ $faculty }}
                                        </label>
                                        <br>
                                    @endforeach
                                </div>
                                <input type="hidden" id="faculty" name="faculty" @if(isset($request->faculty)) value="{{ $request->faculty }}" @endif>
                            </div>
                            <div class="py-2 px-4">
                                <button id="searchBtn" class="w-full py-2 rounded bg-greencolor text-white" type="submit">
                                    検索する
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="container" class="w-full justify-center bg-mieetcolor hidden">
        <div class="container max-w-[550px] flex flex-col justify-center bg-white">
            <div class="w-full flex flex-wrap justify-start items-center m-0 p-0">
                @foreach($companies as $company)
                    <a href="{{ route('companyDetailPage', $company->id) }}" class="content-img relative" style="background-image: url({{ asset('storage/company/'.$company->id.'/'.$company->top_img) }})">
                        <div class="w-full h-full flex justify-center items-center text-sm p-2 text-center">
                            <span class="font-bold">
                                {{ $company->name }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <x-recruit.navbar></x-recruit.navbar>
    </div>
    @vite(['resources/js/recruit/search.js'])
</x-recruit.template>
