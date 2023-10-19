<tr data-bs-name="{{ $data->name }}" class="border-b company-item justify-between">
    <td class="border-r">
        <div class="p-4 flex items-center">
            <span class="font-medium">非表示</span>
            <label class="relative inline-flex items-center mx-2 cursor-pointer">
                <input id="departmentStatus-{{ $data->id }}" type="checkbox" value="mail_permission" class="sr-only peer statusToggle" data-target-id="{{ $data->id }}" @if($data->status === 1) checked data-status="1" @else data-status="0" @endif>
                <div id="statusToggle-{{ $data->id }}" class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-green-300 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
            </label>
            <span class="font-medium">表示</span>
        </div>
    </td>
    <td class="p-4">
        <a href="{{ route('companyDetail', $data->id) }}" class="detail underline">
            {{ $data->name }}
        </a>
    </td>
</tr>
