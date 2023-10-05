<li>
    <a href="" class="flex justify-between items-center px-4 py-2.5">
        <div class="flex flex-col w-32">
            @if(isset($data->screen_name))
                <div class="text-grey-900 font-bold">{{ $data->screen_name }}</div>
            @else
                <div class="text-grey-900 font-bold">{{ $data->name }}</div>
            @endif
            <div class="text-grey-500 text-xs">{{ $data->faculty }}<br>{{ $data->glade }}年</div>
        </div>
        <div class="rounded-full rounded-badge flex justify-center items-center py-0.5 px-2.5">
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="6" cy="6" r="6" fill="#0E9F6E"/>
            </svg>
            <div class="badge">
                {{ explode(' ', $data->created_at)[0] }}に登録
            </div>
        </div>
    </a>
</li>
<hr class="w-full">
