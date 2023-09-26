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
{{--                <li><a href="{{ route('contact') }}">お問い合わせ</a></li>--}}
            </ul>
        </div>
    </div>
</footer>
