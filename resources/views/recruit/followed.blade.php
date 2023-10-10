<x-recruit.template title="フォローリスト" css="recruit/followed.css">
    <div id="loading" style="width: 100dvw; height: 100dvh; position: fixed; top: 0; left: 0; z-index: 1000; display: flex; justify-content: center; align-items: center; background-color: black;">
        <div class="ring absolute">
            loading
            <span></span>
        </div>
    </div>
    <div class="fixed top-0 left-0 z-510 p-2 h-[60px] flex items-center">
        <a href="{{ route('recruit') }}">
            <i class="bi bi-caret-left-fill"></i><i class="bi bi-house"></i>HOME
        </a>
    </div>
    <div id="container" class="w-full justify-center bg-mieetcolor hidden">
        <div class="container max-w-[550px] flex flex-col justify-center bg-white">
            <div class="w-full flex flex-col">
                @foreach($followed as $follow)
                    <div class="w-full flex justify-between items-center py-2 px-4">
                        <a href="{{ route('companyDetailPage', $follow->company_id) }}" class="flex gap-2 items-center company-link">
                            <img src="@if(isset($follow->logo)){{ asset('storage/company/'.$follow->company_id.'/'.$follow->logo) }}@else{{ asset('storage/company/'.$follow->company_id.'/'.$follow->top_img) }}@endif" alt="{{ $follow->company_name }}" class="w-12 h-12 mieet-border rounded-full object-cover">
                            <div>
                                {{ $follow->company_name }}
                            </div>
                        </a>
                        <button class="follow-btn border rounded px-2 py-1 followed" data-bs-target="{{ $follow->company_id }}" data-bs-student="{{ $user->id }}">
                            <i class="bi bi-balloon-heart-fill text-white"></i>フォロー中
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
        <x-recruit.navbar></x-recruit.navbar>
    </div>
    @vite(['resources/js/recruit/followed.js'])
</x-recruit.template>
