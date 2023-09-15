<x-template title="Mieet Plus">
    <header class="fixed top-0 left-0 right-0 w-full h-[80px] flex justify-center items-center px-2.5">
        <div class="w-full max-w-[1200px] h-[60px] flex justify-between items-center">
            <div class="h-[40px] flex justify-center items-center">
                <a href="https://www.mie-projectm.com" target="_blank" class="h-full flex items-center bg-gray-50 md:p-4 rounded">
                    <img src="{{ asset('storage/logo.png') }}" alt="Project M, Inc." class="w-10 h-10 object-cover">
                    <span class="hidden md:inline">Project M, Inc.</span>
                </a>
            </div>
            <div class="h-[40px] flex justify-center items-center gap-9">
{{--                @if($auth === 'guest')--}}
{{--                    <a href="{{ route('login') }}" class="mieet-btn rounded w-[100px] md:w-[150px] h-full text-white text-sm md:text-base flex justify-center items-center">ログイン</a>--}}
{{--                    <a href="{{ route('register') }}" class="mieet-btn rounded w-[100px] md:w-[150px] h-full text-white text-sm md:text-base flex justify-center items-center">新規登録</a>--}}
{{--                @else--}}
{{--                    <a href="{{ route('dashboard') }}" class="mieet-btn rounded w-[100px] md:w-[150px] h-full text-white text-sm md:text-base flex justify-center items-center"><i class="bi bi-person-circle text-white"></i> {{ $user->name }}</a>--}}
{{--                @endif--}}
            </div>
        </div>
    </header>
    <main>
        <div id="main-visual" class="w-full h-[100dvh] flex justify-center items-end md:items-center pb-12 md:pb-0">
            <div class="flex flex-col md:flex-row justify-between items-center max-w-[80dvw] gap-5 md:gap-16">
                <div class="flex flex-col justify-center items-center gap-9">
                    <img src="{{ asset('storage/mieet-plus-logo.png') }}" alt="Mieet Plus" class="w-full md:max-w-[680px]">
                    <div class="text-white py-2.5 px-9 bg-mieet-green text-sm md:text-base">
                        三重大生が開発・運営する三重大生向け情報サイト
                    </div>
                </div>
                <img src="{{ asset('storage/top-visual.png') }}" alt="top-visual" class="w-11/12 max-w-[540px]">
            </div>
        </div>
        <div id="whats-mieet" class="w-full px-4 md:px-16 pt-40 pb-24">
            <div class="w-full flex flex-col justify-center items-center md:items-start">
                <div class="flex items-center">
                    <svg width="15" height="19" viewBox="0 0 15 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 9.5L-8.15666e-07 18.1603L-5.85621e-08 0.839745L15 9.5Z" fill="#4F5E57"/>
                    </svg>
                    <span class="px-2">Mieet Plusとは</span>
                </div>
                <div class="roboto-serif text-4xl md:text-6xl">
                    What's Mieet Plus?
                </div>
                <div class="pt-24 w-full flex flex-col md:flex-row-reverse justify-center items-center gap-9 md:gap-32">
                    <div class="flex flex-col">
                        <div class="catch-text pl-6 text-xl md:text-2xl font-bold">
                            <p class="roboto-serif">Limitless Campus</p>
                            <p class="ml-6">あなたの「」がここから始まる</p>
                        </div>
                        <div class="max-w-[450px] flex flex-col gap-6">
                            <div>
                                Mieet Plusは、三重大生が開発・運営する三重大生向け情報サイトです。
                                <br>
                                企業情報を掲載する「就活部」や、学生団体の情報を掲載する「サークル部」など、様々な情報を掲載しています。
                            </div>
                            <div>
                                <div class="text-center text-lg font-bold">
                                    "<span class="roboto-serif">Limitless Campus</span>"
                                    <br>
                                    "あなたの「」がここから始まる"
                                </div>
                                この二つをコンセプトに掲げ、三重大生が踏み出す一歩を後押しする力になるサービスを目指します！
                            </div>
                        </div>
                    </div>
                    <img src="{{ asset('storage/whats-mieet.png') }}" alt="What's Mieet Plus?" class="w-full md:max-w-[400px] h-full max-h-[300px] md:max-h-[400px] object-cover">
                </div>
            </div>
        </div>
        <div id="mieet-contents" class="w-full px-4 md:px-16 pt-40 pb-24">
            <div class="w-full flex flex-col justify-center items-center md:items-start">
                <div class="flex items-center">
                    <svg width="15" height="19" viewBox="0 0 15 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 9.5L-8.15666e-07 18.1603L-5.85621e-08 0.839745L15 9.5Z" fill="#4F5E57"/>
                    </svg>
                    <span class="px-2">Mieet Plusのコンテンツ</span>
                </div>
                <div class="roboto-serif text-4xl md:text-6xl">
                    Contents
                </div>
                <div class="w-full flex flex-col justify-center items-center">
                    <div class="w-full flex flex-col md:flex-row justify-center items-center py-9 px-7 md:px-12 gap-9">
                        <img src="{{ asset('storage/'.$top_service->img) }}" alt="Mieet Plus 就活部" class="w-full max-w-[400px] h-full max-h-[300px] md:max-h-[400px]">
                        <div class="flex flex-col w-full max-w-[680px]">
                            <div class="w-full flex flex-col justify-center items-center gap-9">
                                <div class="flex flex-col gap-9">
                                    <div>
                                        <span class="py-1 px-8 bg-mieet-green text-white">
                                            {{ $top_service->name }}
                                        </span>
                                    </div>
                                    <div>
                                        {!! nl2br(e($top_service->description)) !!}
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <a href="{{ route('recruit') }}" class="mieet-btn w-[250px] p-2.5 rounded-full h-10 flex justify-center items-center text-white">
                                        就活部サイト<span class="bg-white rounded-full w-6 h-6 text-center ml-2"><i class="bi bi-caret-right-fill text-mieet-green"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="w-full">
                    <div class="w-full flex flex-wrap justify-center items-start gap-9 hidden">
                        @foreach($services as $service)
                            <div class="w-full max-w-[380px] flex flex-col justify-center items-center gap-9 py-9 px-7 border-b">
                                <img src="{{ asset('storage/'.$service->img) }}" alt="{{ $service->name }}">
                                <div class="flex flex-col gap-8 justify-start items-center">
                                    <div class="flex flex-col gap-6">
                                        <div>
                                            <span class="py-1 px-8 bg-mieet-green text-white">
                                                {{ $service->name }}
                                            </span>
                                        </div>
                                        <div>
                                            {!! nl2br(e($service->description)) !!}
                                        </div>
                                    </div>
                                    <a href="{{ route($service->route) }}" class="mieet-btn w-[250px] p-2.5 rounded-full h-10 flex justify-center items-center text-white">
                                        {{ $service->btn }}へ
                                        <span class="bg-white rounded-full w-6 h-6 text-center ml-2"><i class="bi bi-caret-right-fill text-mieet-green"></i></span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div id="instagram" class="w-full px-4 md:px-16 pt-40 pb-24 hidden">
            <div class="w-full flex flex-col justify-center items-center md:items-start">
                <div class="flex items-center">
                    <svg width="15" height="19" viewBox="0 0 15 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 9.5L-8.15666e-07 18.1603L-5.85621e-08 0.839745L15 9.5Z" fill="#4F5E57"/>
                    </svg>
                    <span class="px-2">Mieet Plusの最新情報はこちら</span>
                </div>
                <div class="roboto-serif text-4xl md:text-6xl">
                    Instagram
                </div>
                <div class="pt-24 w-full flex flex-col md:flex-row-reverse justify-center items-center gap-9 md:gap-32">
                    <div id="instagram-post" class="flex flex-wrap justify-center items-center w-full max-w-[850px] gap-2">
                        @for($i = 0; $i < 12; $i++)
                            <img src="{{ asset('storage/mieet-recruit.png') }}" alt="" class="w-[150px] md:w-[200px] h-[150px] md:h-[200px] object-cover rounded">
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        <div id="company" class="w-full px-4 md:px-16 py-24">
            <div class="w-full flex flex-col justify-center items-center">
                <div class="flex items-center">
                    <svg width="15" height="19" viewBox="0 0 15 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 9.5L-8.15666e-07 18.1603L-5.85621e-08 0.839745L15 9.5Z" fill="#4F5E57"/>
                    </svg>
                    <span class="px-2">運営企業</span>
                </div>
                <div class="roboto-serif text-4xl md:text-6xl">
                    Company
                </div>
                <div class="w-full flex flex-col justify-center items-center">
                    <div class="w-full flex flex-col md:flex-row justify-center items-center py-9 px-7 md:px-12 gap-9">
                        <img src="{{ asset('storage/logo-orange.png') }}" alt="Mieet Plus 就活部" class="w-full max-w-[400px] h-full max-h-[400px]">
                        <div class="flex flex-col w-full max-w-[680px]">
                            <div class="w-full flex flex-col justify-center items-center gap-9">
                                <div class="flex flex-col gap-9">
                                    <div class="font-bold text-xl">
                                        株式会社プロジェクトM
                                    </div>
                                    <div>
                                        メンバーのほとんどが現役三重大生で構成される三重大学発学生ベンチャー企業です。
                                        <br>
                                        自社内でWeb開発やシステム開発を行っており、Mieet Plusの開発・運営も行っています。
                                        <br>
                                        学生らしい発想を活かして、新たな価値観を生み出すことを目指しています。
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <a href="{{ __('https://www.mie-projectm.com') }}" class="mieet-btn w-[250px] p-2.5 rounded-full h-10 flex justify-center items-center text-white" target="_blank">
                                        プロジェクトM HP<span class="bg-white rounded-full w-6 h-6 text-center ml-2"><i class="bi bi-caret-right-fill text-mieet-green"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="w-full pt-12 pb-6 px-4 md:px-16 flex justify-between items-start">
        <div>

        </div>
        <div class="flex gap-6">
            <div>
                <ul>
                    <li><a href="{{ route('recruit') }}">就活部</a></li>
                    @foreach($services as $service)
                        <li class="hidden"><a href="{{ route($service->route) }}">{{ $service->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <ul>
                    <li><a href="{{ __('https://www.mie-projectm.com') }}">運営企業</a></li>
                    <li><a href="{{ route('terms') }}">利用規約</a></li>
                    <li><a href="{{ route('privacyPolicy') }}">プライバシーポリシー</a></li>
                </ul>
            </div>
        </div>
    </footer>
    @vite(['resources/js/index.js'])
</x-template>
