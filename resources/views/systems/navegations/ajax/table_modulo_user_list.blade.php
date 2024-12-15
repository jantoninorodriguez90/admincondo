<x-data-table id="datatable-modulo-user">            
    <x-slot:title>modulo list</x-slot:title>
    <x-slot:thead>
        <tr>
            <th>ID</th>
            <th>USUARIO</th>
            <th>MODULO</th>
            <th>ACTIONS</th>
        </tr>
    </x-slot:thead>
    @foreach ($modulos_usuarios as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->user->name }}</td>
            <td>{{ $item->modulo->value }}</td>
            <td class="text-center">
                <button type="button" class="btn btn-xs btn-info" onclick="btn_edit_modulo_user({{ $item->id }})"><i class="fa fa-pencil-alt" aria-hidden="true"></i></button>
                {{-- <x-modal type="lg" class="btn btn-xs btn-info" onclick="btn_assign({{ $item->id }})">
                    <x-slot:button><i class="fa fa-user-secret" aria-hidden="true"></i></x-slot:button>    
                    <x-slot:title><strong>USER: </strong></x-slot:title>                    
                    <x-slot:button_success>
                        <button type="button" class="btn btn-primary" onclick="btn_assign_role({{ $item->id }})" id="btnCreate">ASSIGN</button>
                    </x-slot:button_success>
                </x-modal> --}}
                @if ($item->status_alta == 1)
                    <button type="button" class="btn btn-xs btn-success" onclick="btn_delete_modulo_user({{ $item->id }})"><i class="fa fa-check" aria-hidden="true"></i></button>
                @else
                    <button type="button" class="btn btn-xs btn-danger" onclick="btn_delete_modulo_user({{ $item->id }})"><i class="fa fa-times" aria-hidden="true"></i></button>
                @endif                        
            </td>
        </tr>
    @endforeach
</x-data-table>