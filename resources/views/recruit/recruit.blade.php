<x-recruit.template title="Mieet Plus 就活部">
    <script>
        window.Laravel = {};
        window.Laravel.tellers_list = @json($tellers_companies_list);
        window.Laravel.posts_list = @json($posts_companies_list);
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
    <div id="container" class="w-full justify-center bg-mieetcolor hidden">
        <div class="container max-w-[550px] flex flex-col justify-center bg-white">
            {{-- テラーズ表示範囲 start --}}
            <div id="tellers" class="swiper mySwiper container z-0 bg-white">
                <div class="swiper-wrapper">
                    @foreach($tellers_companies as $i => $company)
                        <div class="swiper-slide flex flex-col">
                            <div class="teller-btn flex flex-col justify-center items-center" data-bs-target="{{ $i }}">
                                <img src="@if(isset($company->logo)){{ asset('storage/company/'.$company->user_id.'/'.$company->logo) }}@else{{ asset('storage/company/'.$company->user_id.'/'.$company->top_img) }}@endif" alt="{{ $company->name }}" class="rounded-full">
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
                <div class="relative w-full h-full max-w-screen-sm">
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
                                                <img src="@if(isset($company->logo)){{ asset('storage/company/'.$company->user_id.'/'.$company->logo) }}@else{{ asset('storage/company/'.$company->user_id.'/'.$company->top_img) }}@endif" alt="{{ $company->name }}" class="company-img rounded-full">
                                                <div class="company-name px-2">
                                                    {{ $company->name }}
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                @if($auth == 'student')
                                                    @if(in_array($company->user_id, $followed))
                                                        <button class="follow-btn border rounded px-2 py-1 followed" data-bs-target="{{ $company->user_id }}" data-bs-student="{{ $user->id }}">
                                                            <i class="bi bi-balloon-heart-fill text-white"></i>フォロー中
                                                        </button>
                                                    @else
                                                        <button class="follow-btn border rounded px-2 py-1" data-bs-target="{{ $company->user_id }}" data-bs-student="{{ $user->id }}">
                                                            <i class="bi bi-balloon-heart-fill"></i>フォローする
                                                        </button>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="insideSwiper w-full h-full">
                                        <div class="relative w-5/6 swiper-wrapper">
                                            <div class="swiper-slide flex flex-col justify-center items-center" style="background-image: url('@if(isset($company->tellers_img_1)){{ asset('storage/company/'.$company->user_id.'/'.$company->tellers_img_1) }}@else{{ asset('storage/office.jpg') }}@endif')">
                                                <div class="w-5/6 content-container">
                                                    <div class="title text-3xl my-4 font-bold">
                                                        [実際の仕事内容]
                                                    </div>
                                                    <div id="job_{{ $company->user_id }}" class="content">

                                                    </div>
                                                    <textarea class="viewer-content hidden" data-target="job_{{ $company->user_id }}">{{ $company->job_description_tellers }}</textarea>
                                                </div>
                                            </div>
                                            <div class="swiper-slide flex flex-col justify-center items-center" style="background-image: url('@if(isset($company->tellers_img_2)){{ asset('storage/company/'.$company->user_id.'/'.$company->tellers_img_2) }}@else{{ asset('storage/meeting_room.jpg') }}@endif')">
                                                <div class="w-5/6 content-container">
                                                    <div class="title text-3xl my-4 font-bold">
                                                        [社内の雰囲気・社風]
                                                    </div>
                                                    <div id="culture_{{ $company->user_id }}" class="content">

                                                    </div>
                                                    <textarea class="viewer-content hidden" data-target="culture_{{ $company->user_id }}">{{ $company->culture_tellers }}</textarea>
                                                </div>
                                            </div>
                                            <div class="swiper-slide flex flex-col justify-center items-center" style="background-image: url('@if(isset($company->tellers_img_3)){{ asset('storage/company/'.$company->user_id.'/'.$company->tellers_img_3) }}@else{{ asset('storage/building.jpg') }}@endif')">
                                                <div class="w-5/6 content-container">
                                                    <div class="title text-3xl my-4 font-bold">
                                                        [労働環境]
                                                    </div>
                                                    <div id="environment_{{ $company->user_id }}" class="content">

                                                    </div>
                                                    <textarea class="viewer-content hidden" data-target="environment_{{ $company->user_id }}">{{ $company->environment_tellers }}</textarea>
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
                    <div class="absolute bottom-0 left-0 right-0 w-full z-700 flex justify-between text-4xl p-4 text-mieetcolor">
                        <i id="modalLeft" class="bi bi-arrow-left-circle-fill"></i>
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
                            <a href="{{ route('companyDetailPage', $company->user_id) }}" class="items-center inline-flex">
                                <img src="@if(isset($company->logo)){{ asset('storage/company/'.$company->user_id.'/'.$company->logo) }}@else{{ asset('storage/company/'.$company->user_id.'/'.$company->top_img) }}@endif" alt="{{ $company->name }}" class="logo rounded-full w-[36px] h-[36px]">
                                <div class="ml-3">
                                    {{ $company->name }}
                                </div>
                            </a>
                        </div>
                        <div class="posts-body w-full flex flex-col">
                            <div class="posts-img-container relative">
                                <img src="{{ asset('storage/company/'.$company->user_id.'/'.$company->top_img) }}" alt="{{ $company->name }}" class="posts-img w-full h-full absolute top-0 left-0">
                            </div>
                            <div class="flex justify-between items-center p-3 text-sm">
                                @if(isset($followed))
                                    @if(in_array($company->user_id, $followed))
                                        <button class="follow-btn border rounded px-2 py-1 followed" data-bs-target="{{ $company->user_id }}" data-bs-student="{{ $user->id }}">
                                            <i class="bi bi-balloon-heart-fill text-white"></i>フォロー中
                                        </button>
                                    @else
                                        <button class="follow-btn border rounded px-2 py-1" data-bs-target="{{ $company->user_id }}" data-bs-student="{{ $user->id }}">
                                            <i class="bi bi-balloon-heart-fill"></i>フォローする
                                        </button>
                                    @endif
                                @else
                                    <button class="border rounded px-2 py-1 not-login" data-bs-target="{{ $company->user_id }}" data-bs-student="{{ $user->id }}">
                                        <i class="bi bi-balloon-heart-fill"></i>フォローする
                                    </button>
                                @endif
                            </div>
                            <div class="text-sm">
                                <div id="posts-content-{{ $company->user_id }}" class="posts-content content folded px-3">

                                </div>
                                <textarea class="viewer-content hidden" data-target="posts-content-{{ $company->user_id }}">@if(isset($company->pr)){{ $company->pr }}@else{{ $company->content }}@endif</textarea>
                                <div class="p-3 text-grey-500">
                                    <button type="button" class="posts-expand" data-bs-target="posts-content-{{ $company->user_id }}">
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
