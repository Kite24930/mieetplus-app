<tr data-bs-name="{{ $data->name }}" class="border-b company-item">
    <td class="p-4">{{ $data->id }}</td>
    <td class="p-4">{{ $data->name }}</td>
    <td class="p-4">{{ $data->category }}</td>
    <td class="p-4">
        @if($data->status == 1)
            表示
        @else
            非表示
        @endif
    </td>
    <td class="p-4">{{ explode(' ', $data->created_at)[0] }}</td>
    <td class="p-4">
        <a href="{{ route('adminCompanyDetail', $data->id) }}" class="detail underline">
            詳細
        </a>
    </td>
</tr>
