<x-recruit.template title="Mieet Plus 就活部">
    <div class="w-full flex justify-center">
        <div class="container max-w-screen-sm flex flex-col justify-center">
            {{-- テラーズ表示範囲 start --}}
            <div id="tellers" class="swiper mySwiper container relative z-0">
                <div class="swiper-wrapper">
                    @foreach($companies as $i => $company)
                        <div class="swiper-slide flex flex-col">
                            <div class="teller-btn flex flex-col justify-center items-center" data-bs-target="{{ $i }}">
                                <img src="https://via.placeholder.com/72x72" alt="{{ $company['company_name'] }}" class="rounded-full">
                                <div class="company-name text-center">
                                    {{ $company['company_name'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div id="modalEl" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-10 hidden justify-center w-full p-0 overflow-x-hidden overflow-y-auto text-white">
                <div class="relative w-full h-full max-w-screen-sm">
                    <div class="absolute top-0 left-0 w-full z-50 flex flex-col mt-3">
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
                    <div id="tellerSwiper" class="swiper tellerSwiper w-full h-full relative z-40">
                        <div class="swiper-wrapper">
                            @foreach($companies as $company)
                                <div class="company-wrapper w-full h-full swiper-slide">
                                    <div class="company-header w-full absolute left-0 flex justify-between z-50 mt-7 ml-2">
                                        <div class="company-info flex-col items-center">
                                            <div class="flex items-center">
                                                <img src="https://via.placeholder.com/72x72" alt="test" class="company-img rounded-full">
                                                <div class="company-name px-2">
                                                    {{ $company['company_name'] }}
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <button class="follow-btn border rounded px-2 py-1 @if($company['followed']) followed @endif" data-bs-target="{{ $company['id'] }}">
                                                    <i class="bi bi-balloon-heart-fill"></i>
                                                    @if($company['followed'])
                                                        フォロー済
                                                    @else
                                                        フォローする
                                                    @endif
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="insideSwiper w-full h-full">
                                        <div class="relative w-5/6 swiper-wrapper">
                                            <div class="swiper-slide flex flex-col justify-center items-center" style="background-image: url('{{ $company['photo1'] }}')">
                                                <div class="w-5/6">
                                                    <div class="title text-5xl my-4">
                                                        [業務内容]
                                                    </div>
                                                    <div class="content">
                                                        {{ $company['business_details'] }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide flex flex-col justify-center items-center" style="background-image: url('{{ $company['photo2'] }}')">
                                                <div class="w-5/6">
                                                    <div class="title text-5xl my-4">
                                                        [企業PR]
                                                    </div>
                                                    <div class="content">
                                                        {{ $company['company_pr'] }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="swiper-slide flex flex-col justify-center items-center" style="background-image: url('{{ $company['photo3'] }}')">
                                                <div class="w-5/6">
                                                    <div class="title text-5xl my-4">
                                                        [事業内容]
                                                    </div>
                                                    <div class="content">
                                                        {{ $company['business_description'] }}
                                                    </div>
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
                    <div class="absolute bottom-0 left-0 right-0 w-full z-50 flex justify-between text-4xl p-4 text-mieetcolor">
                        <i id="modalLeft" class="bi bi-arrow-left-circle-fill"></i>
                        <i id="modalRight" class="bi bi-arrow-right-circle-fill"></i>
                    </div>
                </div>
            </div>
            {{-- テラーズ表示範囲 end --}}
            {{-- 投稿範囲 start --}}

            {{-- 投稿範囲 end --}}
        </div>
    </div>
    @vite(['resources/js/recruit/recruit.js'])
</x-recruit.template>
