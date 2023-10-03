<tr data-bs-name="{{ $data->name }}" class="border-b company-item">
    <td class="p-4">
        <a href="{{ route('companyDetail', $data->id) }}" class="detail underline">
            {{ $data->name }}
        </a>
    </td>
</tr>
