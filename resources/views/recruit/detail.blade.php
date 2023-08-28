<x-recruit.template :title="$company->name">
    <div id="loading" class="w-full h-full fixed top-0 left-0 flex justify-center items-center z-1000">
        <div class="ring absolute">
            loading
            <span></span>
        </div>
    </div>
    <div class="fixed top-0 left-0 z-510 p-2 h-[60px] flex items-center">
        <a href="{{ url()->previous() }}">
            <i class="bi bi-caret-left-fill"></i>戻る
        </a>
    </div>
    <div id="container" class="w-full justify-center bg-mieetcolor hidden">
        <div class="container max-w-[550px] flex flex-col justify-center bg-white">
            <img src="{{ asset('storage/company/'.$company->user_id.'/'.$company->top_img) }}" alt="{{ $company->name }}" class="top-img w-full h-32 object-cover">
            <div class="flex items-center py-2 px-4">
                <img src="@if(isset($company->logo)){{ asset('storage/company/'.$company->user_id.'/'.$company->logo) }}@else{{ asset('storage/company/'.$company->user_id.'/'.$company->top_img) }}@endif" alt="{{ $company->name }}" class="w-16 h-16 rounded-full mieet-border">
                <div class="flex justify-start items-center pl-2">
                    {{ $company->name }}
                </div>
            </div>
            <div class="px-4">
                @if($auth == 'student')
                    @if(in_array($company->user_id, $followed))
                        <button class="follow-btn border rounded px-2 py-1 followed" data-bs-target="{{ $company->user_id }}">
                            <i class="bi bi-balloon-heart-fill"></i>フォロー中
                        </button>
                    @else
                        <button class="follow-btn border rounded px-2 py-1" data-bs-target="{{ $company->user_id }}">
                            <i class="bi bi-balloon-heart-fill"></i>フォローする
                        </button>
                    @endif
                @elseif($auth == 'guest')
                    <button class="border rounded px-2 py-1 not-login" data-bs-target="{{ $company->user_id }}">
                        <i class="bi bi-balloon-heart-fill"></i>フォローする
                    </button>
                @endif
            </div>
            <div class="flex flex-col justify-center items-start gap-2 py-2 px-4">
                <div class="text-grey-500">
                    <i class="bi bi-info-circle"></i>{{ $company->category }}
                </div>
                <div class="text-grey-500">
                    <a href="https://maps.apple.com/?q={{ $company->location_lat }},{{ $company->location_lng }}">
                        <i class="bi bi-geo-alt"></i>{{ $company->location }}
                    </a>
                </div>
                @if(isset($company->url))
                    <div class="text-grey-500">
                        <a href="{{ $company->url }}">
                            <i class="bi bi-link"></i>{{ $company->url }}
                        </a>
                    </div>
                @endif
            </div>
            @if(isset($company->notice))
                <div class="w-full px-4 border border-green-600">
                    <div>
                        [お知らせ]
                    </div>
                    <div id="notice" class="content max-h-32 overflow-y-scroll">

                    </div>
                    <textarea class="viewer-content" data-target="notice">{{ $company->notice }}</textarea>
                </div>
            @endif
            @if($company->movie)
                <div class="w-full border border-green-600">
                    <a href="{{ $company->movie }}" class="movie w-full h-16 flex justify-center items-center roboto" target="_blank">
                        <span class="roboto text-3xl text-white"><i class="bi bi-play-circle-fill text-white"></i> MOVIE</span>
                    </a>
                </div>
            @endif
            <div class="flex justify-start items-center flex-wrap w-full m-0 p-0">
                <div class="content-img profile" data-bs-target="profile">
                    <div class="text-container">
                        <div class="text-white text-center text-lg">
                            会社概要
                        </div>
                    </div>
                </div>
                <div id="profile" tabindex="-1" aria-hidden="true" class="modal fixed top-0 left-0 right-0 z-600 hidden w-full bg-black">
                    <div class="relative w-full h-full max-w-[550px] bg-blend-darken profile">
                        <div class="absolute top-0 right-0 z-700 m-4">
                            <button id="profileClose" type="button" class="p-3 text-3xl">
                                <i class="bi bi-x-lg text-white"></i>
                            </button>
                        </div>
                        <div class="w-full h-full flex flex-col justify-center items-start z-650 p-4">
                            <div class="text-2xl font-bold text-white">
                                【会社概要】
                            </div>
                            <div id="profileContent" class="content text-white p-2 w-full">
                                <ul>
                                    <li>
                                        【勤務地】{{ $company->work_location }}
                                    </li>
                                    <li>
                                        【設立年月】{{ date('Y年m月', strtotime($company->establishment_date)) }}
                                    </li>
                                    <li>
                                        【資本金】{{ $company->capital }}百万円
                                    </li>
                                    @if(isset($company->sales))
                                        <li>
                                            【売上金】{{ $company->sales }}百万円
                                        </li>
                                    @endif
                                    <li>
                                        【従業員数】{{ $company->employee_number }}人
                                    </li>
                                    @if(isset($company->graduated_number))
                                        <li>
                                            【三重大学OB・OG】{{ $company->graduated_number }}人
                                        </li>
                                    @endif
                                    @if(isset($company->faculties))
                                        <li>
                                            【募集学部】{{ $company->faculties }}
                                        </li>
                                    @endif
                                    @if(isset($company->occupations))
                                        <li>
                                            【募集職種】{{ $company->occupations }}
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-img company-content" data-bs-target="companyContent">
                    <div class="text-container">
                        <div class="text-white text-center text-lg">
                            事業内容
                        </div>
                    </div>
                </div>
                <div id="companyContent" tabindex="-1" aria-hidden="true" class="modal fixed top-0 left-0 right-0 z-600 hidden w-full bg-black">
                    <div class="relative w-full h-full max-w-[550px] bg-blend-darken company-content">
                        <div class="absolute top-0 right-0 z-700 m-4">
                            <button id="companyContentClose" type="button" class="p-3 text-3xl">
                                <i class="bi bi-x-lg text-white"></i>
                            </button>
                        </div>
                        <div class="w-full h-full flex flex-col justify-center items-start z-650 p-4">
                            <div class="text-2xl font-bold text-white">
                                【事業内容】
                            </div>
                            <div id="companyContentBox" class="content text-white p-2 w-full">

                            </div>
                            <textarea class="viewer-content" data-target="companyContentBox">{{ $company->content }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="content-img job-description" data-bs-target="jobDescription" @if(isset($company->tellers_img_1)) style="background-image: url({{ asset('storage/company/'.$company->user_id.'/'.$company->tellers_img_1) }})" @endif>
                    <div class="text-container">
                        <div class="text-white text-center text-lg">
                            実際の
                            <br>
                            仕事内容
                        </div>
                    </div>
                </div>
                <div id="jobDescription" tabindex="-1" aria-hidden="true" class="modal fixed top-0 left-0 right-0 z-600 hidden w-full bg-black">
                    <div class="relative w-full h-full max-w-[550px] bg-blend-darken job-description" @if(isset($company->tellers_img_1)) style="background-image: url({{ asset('storage/company/'.$company->user_id.'/'.$company->tellers_img_1) }})" @endif>
                        <div class="absolute top-0 right-0 z-700 m-4">
                            <button id="jobDescriptionClose" type="button" class="p-3 text-3xl">
                                <i class="bi bi-x-lg text-white"></i>
                            </button>
                        </div>
                        <div class="w-full h-full flex flex-col justify-center items-start z-650 p-4">
                            <div class="text-2xl font-bold text-white">
                                【実際の仕事内容】
                            </div>
                            <div id="jobDescriptionContent" class="content text-white p-2 w-full">

                            </div>
                            <textarea class="viewer-content" data-target="jobDescriptionContent">@if(isset($company->job_description)){{ $company->job_description }}@else{{ $company->job_description_tellers }}@endif</textarea>
                        </div>
                    </div>
                </div>
                <div class="content-img culture" data-bs-target="culture" @if(isset($company->tellers_img_2)) style="background-image: url({{ asset('storage/company/'.$company->user_id.'/'.$company->tellers_img_2) }})" @endif>
                    <div class="text-container">
                        <div class="text-white text-center text-lg">
                            社内の雰囲気
                            <br>
                            社風
                        </div>
                    </div>
                </div>
                <div id="culture" tabindex="-1" aria-hidden="true" class="modal fixed top-0 left-0 right-0 z-600 hidden w-full bg-black">
                    <div class="relative w-full h-full max-w-[550px] bg-blend-darken culture" @if(isset($company->tellers_img_2)) style="background-image: url({{ asset('storage/company/'.$company->user_id.'/'.$company->tellers_img_2) }})" @endif>
                        <div class="absolute top-0 right-0 z-700 m-4">
                            <button id="cultureClose" type="button" class="p-3 text-3xl">
                                <i class="bi bi-x-lg text-white"></i>
                            </button>
                        </div>
                        <div class="w-full h-full flex flex-col justify-center items-start z-650 p-4">
                            <div class="text-2xl font-bold text-white">
                                【社内の雰囲気・社風】
                            </div>
                            <div id="cultureContent" class="content text-white p-2 w-full">

                            </div>
                            <textarea class="viewer-content" data-target="cultureContent">@if(isset($company->culture)){{ $company->culture }}@else{{ $company->culture_tellers }}@endif</textarea>
                        </div>
                    </div>
                </div>
                <div class="content-img environment" data-bs-target="environment" @if(isset($company->tellers_img_3)) style="background-image: url({{ asset('storage/company/'.$company->user_id.'/'.$company->tellers_img_3) }})" @endif>
                    <div class="text-container">
                        <div class="text-white text-center text-lg">
                            労働環境
                        </div>
                    </div>
                </div>
                <div id="environment" tabindex="-1" aria-hidden="true" class="modal fixed top-0 left-0 right-0 z-600 hidden w-full bg-black">
                    <div class="relative w-full h-full max-w-[550px] bg-blend-darken environment" @if(isset($company->tellers_img_3)) style="background-image: url({{ asset('storage/company/'.$company->user_id.'/'.$company->tellers_img_3) }})" @endif>
                        <div class="absolute top-0 right-0 z-700 m-4">
                            <button id="environmentClose" type="button" class="p-3 text-3xl">
                                <i class="bi bi-x-lg text-white"></i>
                            </button>
                        </div>
                        <div class="w-full h-full flex flex-col justify-center items-start z-650 p-4">
                            <div class="text-2xl font-bold text-white">
                                【労働環境】
                            </div>
                            <div id="environmentContent" class="content text-white p-2 w-full">

                            </div>
                            <textarea class="viewer-content" data-target="environmentContent">@if(isset($company->culture)){{ $company->environment }}@else{{ $company->environment_tellers }}@endif</textarea>
                        </div>
                    </div>
                </div>
                <div class="content-img feature" data-bs-target="feature">
                    <div class="text-container">
                        <div class="text-white text-center text-lg">
                            他社と比べた
                            <br>
                            強み・弱み
                        </div>
                    </div>
                </div>
                <div id="feature" tabindex="-1" aria-hidden="true" class="modal fixed top-0 left-0 right-0 z-600 hidden w-full bg-black">
                    <div class="relative w-full h-full max-w-[550px] bg-blend-darken feature">
                        <div class="absolute top-0 right-0 z-700 m-4">
                            <button id="featureClose" type="button" class="p-3 text-3xl">
                                <i class="bi bi-x-lg text-white"></i>
                            </button>
                        </div>
                        <div class="w-full h-full flex flex-col justify-center items-start z-650 p-4">
                            <div class="text-2xl font-bold text-white">
                                【他社と比べた強み・弱み】
                            </div>
                            <div id="featureContent" class="content text-white p-2 w-full">

                            </div>
                            <textarea class="viewer-content" data-target="featureContent">{{ $company->feature }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="content-img career-path" data-bs-target="careerPath">
                    <div class="text-container">
                        <div class="text-white text-center text-lg">
                            キャリアパス
                        </div>
                    </div>
                </div>
                <div id="careerPath" tabindex="-1" aria-hidden="true" class="modal fixed top-0 left-0 right-0 z-600 hidden w-full bg-black">
                    <div class="relative w-full h-full max-w-[550px] bg-blend-darken career-path">
                        <div class="absolute top-0 right-0 z-700 m-4">
                            <button id="careerPathClose" type="button" class="p-3 text-3xl">
                                <i class="bi bi-x-lg text-white"></i>
                            </button>
                        </div>
                        <div class="w-full h-full flex flex-col justify-center items-start z-650 p-4">
                            <div class="text-2xl font-bold text-white">
                                【キャリアパス】
                            </div>
                            <div id="careerPathContent" class="content text-white p-2 w-full">

                            </div>
                            <textarea class="viewer-content" data-target="careerPathContent">{{ $company->career_path }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="content-img desired-person" data-bs-target="desiredPerson">
                    <div class="text-container">
                        <div class="text-white text-center text-lg">
                            求める人物像
                        </div>
                    </div>
                </div>
                <div id="desiredPerson" tabindex="-1" aria-hidden="true" class="modal fixed top-0 left-0 right-0 z-600 hidden w-full bg-black">
                    <div class="relative w-full h-full max-w-[550px] bg-blend-darken career-path">
                        <div class="absolute top-0 right-0 z-700 m-4">
                            <button id="desiredPersonClose" type="button" class="p-3 text-3xl">
                                <i class="bi bi-x-lg text-white"></i>
                            </button>
                        </div>
                        <div class="w-full h-full flex flex-col justify-center items-start z-650 p-4">
                            <div class="text-2xl font-bold text-white">
                                【求める人物像】
                            </div>
                            <div id="desiredPersonContent" class="content text-white p-2 w-full">

                            </div>
                            <textarea class="viewer-content" data-target="desiredPersonContent">{{ $company->desired_person }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="content-img transfer" data-bs-target="transfer">
                    <div class="text-container">
                        <div class="text-white text-center text-lg">
                            異動・転勤
                        </div>
                    </div>
                </div>
                <div id="transfer" tabindex="-1" aria-hidden="true" class="modal fixed top-0 left-0 right-0 z-600 hidden w-full bg-black">
                    <div class="relative w-full h-full max-w-[550px] bg-blend-darken transfer">
                        <div class="absolute top-0 right-0 z-700 m-4">
                            <button id="transferClose" type="button" class="p-3 text-3xl">
                                <i class="bi bi-x-lg text-white"></i>
                            </button>
                        </div>
                        <div class="w-full h-full flex flex-col justify-center items-start z-650 p-4">
                            <div class="text-2xl font-bold text-white">
                                【異動・転勤】
                            </div>
                            <div id="transferContent" class="content text-white p-2 w-full">

                            </div>
                            <textarea class="viewer-content" data-target="transferContent">{{ $company->transfer }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-recruit.navbar></x-recruit.navbar>
    </div>
    @vite(['resources/js/recruit/companyDetail.js'])
</x-recruit.template>
