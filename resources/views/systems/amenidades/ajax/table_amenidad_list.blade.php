<x-data-table>
    <x-slot:title>permisons list</x-slot:title>
    {{-- <x-slot:navigate>
        <a href="{{ route('amenidades.create') }}" class="btn btn-info float-right">NEW PERMISSION</a>
    </x-slot:navigate> --}}
    <x-slot:thead>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>UPDATED</th>
            <th>CREATED</th>
            <th>ACTIONS</th>
        </tr>
    </x-slot:thead>
    @foreach ($data  as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->updated_at }}</td>
            <td>{{ $item->created_at }}</td>
            <td class="text-center">
                <button type="button" class="btn btn-xs btn-info" onclick="btn_edit({{ $item->id }})"><i class="fa fa-pencil-alt" aria-hidden="true"></i></button>
                @if ($item->status_alta == 1)
                    <button type="button" class="btn btn-xs btn-success" onclick="btn_delete({{ $item->id }})"><i class="fa fa-check" aria-hidden="true"></i></button>
                @else
                    <button type="button" class="btn btn-xs btn-danger" onclick="btn_delete({{ $item->id }})"><i class="fa fa-times" aria-hidden="true"></i></button>
                @endif                        
            </td>
        </tr>
    @endforeach
</x-data-table>