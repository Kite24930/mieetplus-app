<tr data-bs-name="{{ $data->name }}" class="border-b company-item">
    <td class="p-4">{{ $data->id }}</td>
    <td class="p-4">{{ $data->name }}</td>
    <td class="p-4">{{ $data->faculty }}</td>
    <td class="p-4">{{ $data->glade }}</td>
    <td class="p-4">{{ explode(' ', $data->created_at)[0] }}</td>
    <td class="p-4">
        <a href="{{ route('adminCompanyDetail', $data->id) }}" class="detail underline">
            編集
        </a>
    </td>
</tr>
