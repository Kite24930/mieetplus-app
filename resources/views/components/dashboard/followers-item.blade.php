<tr data-bs-name="{{ $data->name }}" class="border-b company-item">
    <td class="p-4">
        @if(isset($data->screen_name))
            {{ $data->screen_name }}
        @else
            {{ $data->name }}
        @endif
    </td>
    <td class="p-4">{{ $data->faculty }}</td>
    <td class="p-4">{{ $data->glade }}</td>
    <td class="p-4">{{ explode(' ', $data->created_at)[0] }}</td>
</tr>
