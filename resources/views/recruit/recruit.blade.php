<x-recruit.template title="Mieet Plus 就活部" >
    <script>
        window.Laravel = {};
        window.Laravel.tellers_list = @json($tellers_companies_list);
        window.Laravel.tellers_num = 10;
        window.Laravel.posts_list = @json($posts_companies_list);
        window.Laravel.posts_num = 10;
        @if(isset($user))
            window.Laravel.user = @json($user);
        @endif
        @if(isset($followed))
            window.Laravel.followed = @json($followed);
        @endif
    </script>
    <div id="loading" class="w-full h-full fixed top-0 left-0 flex justify-center items-center z-1000">
        <div class="ring absolute">
            loading
            <span></span>
        </div>
    </div>
    @if($auth === 'admin' || $auth === 'company')
        <div class="fixed top-0 left-0 z-510 w-auto h-[60px] pl-2 flex justify-center items-center">
            <a href="{{ route('dashboard') }}" class="bg-mieetcolor text-white rounded py-2 px-4">
                ダッシュボード
            </a>
        </div>
    @endif
    <div class="fixed top-0 right-0 z-510 w-[60px] h-[60px] flex justify-center items-center">
        <button id="filterDropdownBtn" data-dropdown-toggle="filter">
            <i class="bi bi-filter-left text-3xl"></i>
        </button>
        <div id="filter" class="w-[100dvw] max-w-[550px] hidden bg-white mieet-border rounded overflow-y-auto">
            <div class="flex flex-col w-full">
                <div class="text-center py-3 text-2xl">
                    企業を絞り込む
                </div>
                <div class="py-2 px-4">
                    <a href="{{ route('recruit', ['filter', 0]) }}" class="inline-block w-full py-2 rounded bg-greencolor text-white text-center">
                        絞り込みを解除
                    </a>
                </div>
                <div class="border w-full flex flex-col">
                    <form action="{{ route('filter') }}" method="POST">
                        @csrf
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
                                        <input type="checkbox" value="{{ $category->name }}" @if(str_contains($request->category, $category->name)) checked @endif class="filter-category">
                                        {{ $category->name }}
                                    </label>
                                    <br>
                                @endforeach
                            </div>
                            <input type="hidden" id="filter_category" name="filter_category" @if(isset($request->category)) value="{{ $request->category }}" @endif>
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
                                        <input type="checkbox" value="{{ $prefecture }}" @if(str_contains($request->location, $prefecture)) checked @endif class="filter-location">
                                        {{ $prefecture }}
                                    </label>
                                    <br>
                                @endforeach
                            </div>
                            <input type="hidden" id="filter_location" name="filter_location" @if(isset($request->locaiton)) value="{{ $request->location }}" @endif>
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
                                        <input type="checkbox" value="{{ $prefecture }}" @if(str_contains($request->work_location, $prefecture)) checked @endif class="filter-work_location">
                                        {{ $prefecture }}
                                    </label>
                                    <br>
                                @endforeach
                            </div>
                            <input type="hidden" id="filter_work_location" name="filter_work_location" @if(isset($request->work_locaiton)) value="{{ $request->work_locaiton }}" @endif>
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
                                <input type="month" id="filter_establishment_date" name="filter_establishment_date" class="mt-1 h-12 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-[150px] inline-block" @if(isset($request->establishment_date)) value="{{ date('Y-m', strtotime($request->establishment_date)) }}" @else value="{{ date('Y-m') }}" @endif>
                                <label class="mx-2">
                                    <input type="radio" id="filter_establishment_type_before" name="filter_establishment_date_type" value="before" @if(isset($request->establishment_date_type)) @if($request->establishment_date_type === 'before') checked @endif @else checked @endif>
                                    以前
                                </label>
                                <label class="mx-2">
                                    <input type="radio" id="filter_establishment_type_after" name="filter_establishment_date_type" value="after" @if(isset($request->establishment_date_type)) @if($request->establishment_date_type === 'after') checked @endif @endif>
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
                                <input type="number" id="filter_capital" name="filter_capital" class="mt-1 h-12 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-[100px] inline-block" @if(isset($request->capital)) value="{{ $request->capital }}" @else value="0" @endif>
                                百万円
                                <label class="mx-2">
                                    <input type="radio" id="filter_capital_type_more" name="filter_capital_type" value="more" @if(isset($request->capital_type)) @if($request->capital_type === 'more') checked @endif @else checked @endif>
                                    以上
                                </label>
                                <label class="mx-2">
                                    <input type="radio" id="filter_capital_type_less" name="filter_capital_type" value="less" @if(isset($request->capital_type)) @if($request->capital_type === 'less') checked @endif @endif>
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
                                <input type="number" id="filter_sales" name="filter_sales" class="mt-1 h-12 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-[100px] inline-block" @if(isset($request->sales)) value="{{ $request->sales }}" @else value="0" @endif>
                                百万円
                                <label class="mx-2">
                                    <input type="radio" id="filter_sales_type_more" name="filter_sales_type" value="more" @if(isset($request->sales_type)) @if($request->sales_type === 'more') checked @endif @else checked @endif>
                                    以上
                                </label>
                                <label class="mx-2">
                                    <input type="radio" id="filter_sales_type_less" name="filter_sales_type" value="less" @if(isset($request->sales_type)) @if($request->sales_type === 'less') checked @endif @endif>
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
                                <input type="number" id="filter_employee_number" name="filter_employee_number" class="mt-1 h-12 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-[100px] inline-block" @if(isset($request->employee_number)) value="{{ $request->employee_number }}" @else value="0" @endif>
                                人
                                <label class="mx-2">
                                    <input type="radio" id="filter_employee_number_type_more" name="filter_employee_number_type" value="more" @if(isset($request->employee_number_type)) @if($request->employee_number_type === 'more') checked @endif @else checked @endif>
                                    以上
                                </label>
                                <label class="mx-2">
                                    <input type="radio" id="filter_employee_number_type_less" name="filter_employee_number_type" value="less" @if(isset($request->employee_number_type)) @if($request->employee_number_type === 'less') checked @endif @endif>
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
                                <input type="number" id="filter_graduated_number" name="filter_graduated_number" class="mt-1 h-12 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-[100px] inline-block" @if(isset($request->graduated_number)) value="{{ $request->graduated_number }}" @else value="0" @endif>
                                人
                                <label class="mx-2">
                                    <input type="radio" id="filter_graduated_number_type_more" name="filter_graduated_number_type" value="more" @if(isset($request->graduated_number_type)) @if($request->graduated_number_type === 'more') checked @endif @else checked @endif>
                                    以上
                                </label>
                                <label class="mx-2">
                                    <input type="radio" id="filter_graduated_number_type_less" name="filter_graduated_number_type" value="less" @if(isset($request->graduated_number_type)) @if($request->graduated_number_type === 'less') checked @endif @endif>
                                    以下
                                </label>
                            </div>
                        </div>
                        <div class="py-2 px-4">
                            <div class="text-sm text-grey-500">
                                対象学部
                                <label class="ml-3">
                                    <input type="checkbox" id="faculty_activate" name="faculty_activate" @if(isset($request->faculty)) checked @endif>
                                    有効化
                                </label>
                            </div>
                            <div class="h-28 w-full overflow-y-auto p-3 border">
                                @foreach($faculties as $faculty => $faculty_en)
                                    <label>
                                        <input type="checkbox" value="{{ $faculty }}" @if(str_contains($request->faculties, $faculty)) checked @endif class="filter-faculty">
                                        {{ $faculty }}
                                    </label>
                                    <br>
                                @endforeach
                            </div>
                            <input type="hidden" id="filter_faculty" name="filter_faculty" @if(isset($request->faculty)) value="{{ $request->faculty }}" @endif>
                        </div>
                        @if($auth === 'student')
                            <div class="py-2 px-4 flex justify-center items-center">
                                <label>
                                    <input type="checkbox" id="save" name="save">
                                    この絞り込み条件を保存する
                                </label>
                            </div>
                        @endif
                        <div class="py-2 px-4">
                            <button id="filterBtn" class="w-full py-2 rounded bg-greencolor text-white" type="submit">
                                絞り込む
                            </button>
                        </div>
                        <div class="py-2 px-4 text-sm text-grey-500">
                            絞り込み条件を保存すると、ホーム画面を開くと初期状態からこの条件で絞り込まれます。
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="container" class="w-full justify-center bg-mieetcolor hidden">
        <div class="container max-w-[550px] flex flex-col justify-center bg-white">
            {{-- テラーズ表示範囲 start --}}
            <div id="tellers" class="swiper mySwiper container z-0 bg-white pt-2">
                <div class="swiper-wrapper">
                    @foreach($tellers_companies as $i => $company)
                        <div class="swiper-slide flex flex-col">
                            <div class="teller-btn flex flex-col justify-center items-center" data-bs-target="{{ $i }}">
                                <img src="@if(isset($company->logo)){{ asset('storage/company/'.$company->id.'/'.$company->logo) }}@else{{ asset('storage/company/'.$company->id.'/'.$company->top_img) }}@endif" alt="{{ $company->name }}" class="rounded-full">
                                <div class="company-name text-center">
                                    {{ $company->name }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div id="more" class="swiper-slide flex flex-col">
                        <div class="flex flex-col justify-center items-center" data-bs-target="more">
                            <div class="rounded-full w-[58px] h-[58px] flex justify-center items-center border">
                                <i class="bi bi-three-dots"></i>
                            </div>
                            <div class="company-name text-center">
                                more
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="modalEl" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-600 hidden justify-center w-full p-0 overflow-x-hidden overflow-y-auto text-white">
                <div class="relative w-full h-full max-w-[550px]">
                    <div class="absolute top-0 left-0 w-full z-700 flex flex-col mt-3">
                        <div class="progress-wrapper w-full flex justify-evenly">
                            <div id="progress-1" class="progress-bar mx-1"></div>
                            <div id="progress-2" class="progress-bar mx-1"></div>
                            <div id="progress-3" class="progress-bar mx-1"></div>
                        </div>
                        <div class="flex justify-end">
                            <button id="modalClose" type="button" class="p-3 text-3xl">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    </div>
                    <div id="tellerSwiper" class="swiper tellerSwiper w-full h-full relative z-650">
                        <div class="swiper-wrapper">
                            @foreach($tellers_companies as $company)
                                <div class="company-wrapper w-full h-full swiper-slide">
                                    <div class="company-header w-full absolute left-0 flex justify-between z-750 mt-7 ml-2">
                                        <div class="company-info flex flex-col items-center">
                                            <div class="flex items-center">
                                                <img src="@if(isset($company->logo)){{ asset('storage/company/'.$company->id.'/'.$company->logo) }}@else{{ asset('storage/company/'.$company->id.'/'.$company->top_img) }}@endif" alt="{{ $company->name }}" class="company-img rounded-full">
                                                <div class="company-name px-2">
                                                    {{ $company->name }}
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                @if($auth == 'student')
                                                    @if(in_array($company->id, $followed))
                                                        <button class="follow-btn border rounded px-2 py-1 followed" data-bs-target="{{ $company->id }}" data-bs-student="{{ $user->id }}">
                                                            <i class="bi bi-balloon-heart-fill text-white"></i>フォロー中
                                                        </button>
                                                    @else
                                                        <button class="follow-btn border rounded px-2 py-1" data-bs-target="{{ $company->id }}" data-bs-student="{{ $user->id }}">
                                                            <i class="bi bi-balloon-heart-fill"></i>フォローする
                                                        </button>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="company-footer w-full absolute left-0 bottom-8 flex justify-center z-750">
                                        <a href="{{ route('companyDetailPage', $company->id) }}" class="py-2 px-4 bg-white rounded-full">企業ページへ</a>
                                    </div>
                                    <div class="insideSwiper w-full h-full">
                                        <div class="relative w-5/6 swiper-wrapper">
                                            <div class="swiper-slide flex flex-col justify-center items-center" style="background-image: url('@if(isset($company->tellers_img_1)){{ asset('storage/company/'.$company->id.'/'.$company->tellers_img_1) }}@else{{ asset('storage/office.jpg') }}@endif')">
                                                <div class="w-5/6 content-container">
                                                    <div class="title text-3xl my-4 font-bold">
                                                        [実際の仕事内容]
                                                    </div>
                                                    <div id="job_{{ $company->id }}" class="content">

                                                    </div>
                                                    <textarea class="viewer-content hidden" data-target="job_{{ $company->id }}">{{ $company->job_description_tellers }}</textarea>
                                                </div>
                                            </div>
                                            <div class="swiper-slide flex flex-col justify-center items-center" style="background-image: url('@if(isset($company->tellers_img_2)){{ asset('storage/company/'.$company->id.'/'.$company->tellers_img_2) }}@else{{ asset('storage/meeting_room.jpg') }}@endif')">
                                                <div class="w-5/6 content-container">
                                                    <div class="title text-3xl my-4 font-bold">
                                                        [社内の雰囲気・社風]
                                                    </div>
                                                    <div id="culture_{{ $company->id }}" class="content">

                                                    </div>
                                                    <textarea class="viewer-content hidden" data-target="culture_{{ $company->id }}">{{ $company->culture_tellers }}</textarea>
                                                </div>
                                            </div>
                                            <div class="swiper-slide flex flex-col justify-center items-center" style="background-image: url('@if(isset($company->tellers_img_3)){{ asset('storage/company/'.$company->id.'/'.$company->tellers_img_3) }}@else{{ asset('storage/building.jpg') }}@endif')">
                                                <div class="w-5/6 content-container">
                                                    <div class="title text-3xl my-4 font-bold">
                                                        [労働環境]
                                                    </div>
                                                    <div id="environment_{{ $company->id }}" class="content">

                                                    </div>
                                                    <textarea class="viewer-content hidden" data-target="environment_{{ $company->id }}">{{ $company->environment_tellers }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-pagination">

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="absolute bottom-0 left-0 w-auto z-700 flex justify-center text-4xl p-4 text-mieetcolor">
                        <i id="modalLeft" class="bi bi-arrow-left-circle-fill"></i>
                    </div>
                    <div class="absolute bottom-0 right-0 w-auto z-700 flex justify-center text-4xl p-4 text-mieetcolor">
                        <i id="modalRight" class="bi bi-arrow-right-circle-fill"></i>
                    </div>
                </div>
            </div>
            {{-- テラーズ表示範囲 end --}}
            {{-- 投稿範囲 start --}}
            <div id="posts" class="flex flex-col py-4 gap-5">
                @foreach($posts_companies as $company)
                    <div class="w-full flex flex-col">
                        <div class="posts-header w-full px-2 py-1">
                            <a href="{{ route('companyDetailPage', $company->id) }}" class="items-center inline-flex">
                                <img src="@if(isset($company->logo)){{ asset('storage/company/'.$company->id.'/'.$company->logo) }}@else{{ asset('storage/company/'.$company->id.'/'.$company->top_img) }}@endif" alt="{{ $company->name }}" class="logo rounded-full w-[36px] h-[36px]">
                                <div class="ml-3">
                                    {{ $company->name }}
                                </div>
                            </a>
                        </div>
                        <div class="posts-body w-full flex flex-col">
                            <div class="posts-img-container relative">
                                <img src="{{ asset('storage/company/'.$company->id.'/'.$company->top_img) }}" alt="{{ $company->name }}" class="posts-img w-full h-full absolute top-0 left-0">
                            </div>
                            <div class="flex justify-between items-center p-3 text-sm">
                                @if(isset($followed))
                                    @if(in_array($company->id, $followed))
                                        <button class="follow-btn border rounded px-2 py-1 followed" data-bs-target="{{ $company->id }}" data-bs-student="{{ $user->id }}">
                                            <i class="bi bi-balloon-heart-fill text-white"></i>フォロー中
                                        </button>
                                    @else
                                        <button class="follow-btn border rounded px-2 py-1" data-bs-target="{{ $company->id }}" data-bs-student="{{ $user->id }}">
                                            <i class="bi bi-balloon-heart-fill"></i>フォローする
                                        </button>
                                    @endif
                                @else
                                    <button class="border rounded px-2 py-1 not-login" data-bs-target="{{ $company->id }}">
                                        <i class="bi bi-balloon-heart-fill"></i>フォローする
                                    </button>
                                @endif
                            </div>
                            <div class="text-sm">
                                <div class="font-bold">
                                    @if(isset($company->notice))
                                        【お知らせ】
                                    @elseif(isset($company->pr))
                                        【PR】
                                    @elseif(isset($company->content))
                                        【事業内容】
                                    @endif
                                </div>
                                <div id="posts-content-{{ $company->id }}" class="posts-content content folded px-3 h-10">

                                </div>
                                <textarea class="viewer-content hidden" data-target="posts-content-{{ $company->id }}">@if(isset($company->notice)){{ $company->notice }}@elseif(isset($company->pr)){{ $company->pr }}@elseif(isset($company->content)){{ $company->content }}@endif</textarea>
                                <div class="p-3 text-grey-500">
                                    <button type="button" class="posts-expand" data-bs-target="posts-content-{{ $company->id }}">
                                        続きを読む
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- 投稿範囲 end --}}
            {{-- ナビバー --}}
            <x-recruit.navbar></x-recruit.navbar>
        </div>
    </div>
    @vite(['resources/js/recruit/recruit.js'])
</x-recruit.template>
