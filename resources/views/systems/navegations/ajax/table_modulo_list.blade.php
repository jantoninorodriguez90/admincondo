<x-data-table id="datatable-modulo">       
    <x-slot:title>modulo list</x-slot:title>
    <x-slot:thead>
        <tr>
            <th>ID</th>
            <th>SIS_SECCION_ID</th>
            <th>VALUE</th>
            <th>ICON</th>
            <th>RUTA</th>
            <th>ACTIONS</th>
        </tr>
    </x-slot:thead>
    @foreach ($modulos as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->sis_seccion_id }}</td>
            <td>{{ $item->value }}</td>
            <td class="text-center"><i class="{{ $item->icon }}" aria-hidden="true"></i></td>
            <td>{{ $item->ruta }}</td>
            <td class="text-center">
                <button type="button" class="btn btn-xs btn-info" onclick="btn_edit_seccion({{ $item->id }})"><i class="fa fa-pencil-alt" aria-hidden="true"></i></button>
                {{-- <x-modal type="lg" class="btn btn-xs btn-info" onclick="btn_assign({{ $item->id }})">
                    <x-slot:button><i class="fa fa-user-secret" aria-hidden="true"></i></x-slot:button>    
                    <x-slot:title><strong>USER: </strong></x-slot:title>                    
                    <x-slot:button_success>
                        <button type="button" class="btn btn-primary" onclick="btn_assign_role({{ $item->id }})" id="btnCreate">ASSIGN</button>
                    </x-slot:button_success>
                </x-modal> --}}
                @if ($item->status_alta == 1)
                    <button type="button" class="btn btn-xs btn-success" onclick="btn_delete_seccion({{ $item->id }})"><i class="fa fa-check" aria-hidden="true"></i></button>
                @else
                    <button type="button" class="btn btn-xs btn-danger" onclick="btn_delete_seccion({{ $item->id }})"><i class="fa fa-times" aria-hidden="true"></i></button>
                @endif                        
            </td>
        </tr>
    @endforeach
</x-data-table>