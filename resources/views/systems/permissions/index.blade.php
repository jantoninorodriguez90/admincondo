@extends('layouts.app')

@section('content')
    <x-card>
        <x-slot:title>FORM PERMISSION</x-slot:title>
        <form class="form-horizontal form-false" method="POST" action="#" id="form-permission-create">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">PERMISSION</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="PERMISSION NAME">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="button" class="btn btn-info float-right" onclick="btn_create()" id="btnCreate">CREATE</button>
                <button type="button" class="btn btn-info float-right" onclick="btn_update()" id="btnUpdate">UPDATE</button>
                {{-- <button type="button" class="btn btn-default float-right">Cancel</button> --}}
            </div>
            <!-- /.card-footer -->
        </form>
    </x-card>

    <div id="datatable-list">        
        <x-data-table>            
            <x-slot:title>permisons list</x-slot:title>
            {{-- <x-slot:navigate>
                <a href="{{ route('permissions.create') }}" class="btn btn-info float-right">NEW PERMISSION</a>
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
            @foreach ($permissions as $item)
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
    </div>
@endsection

@section('jquery')
<script>
    $(document).ready(function (){
        localstorage_function('remove', 'LS_PERMISSION_DATA');
        $('#btnUpdate').css('display', 'none');

        // $.LoadingOverlay("show");       
    });

    function btn_create(){
        ajax_function_object({
            method: 'POST',
            route: `{{ route('permissions.store') }}`,
            data: {
                form: $('#form-permission-create')
            },
            function: (_response) => {
                if(_response.next){
                    bootbox_alert({
                        title: 'informative',
                        message: _response.message,
                        type: 'success'
                    });
                    $('#datatable-list').html(_response.view);                    
                    $('#form-permission-create')[0].reset();
                }
            }
        });
    }    

    function btn_edit(_id){
        ajax_function_object({
            method: 'GET',
            route: `permissions/${_id}/edit`,
            data: {},
            function: (_response) => {
                if(_response.next){
                    localstorage_function('set', 'LS_PERMISSION_DATA', _response.data.id);
                    $('#btnCreate').css('display', 'none');
                    $('#btnUpdate').css('display', 'inline');

                    $('#name').val(_response.data.name);
                }
            }
        });
    }

    function btn_update(){
        let _ls_id = localstorage_function('get', 'LS_PERMISSION_DATA');

        if(_ls_id != ""){
            ajax_function_object({
                method: 'PUT',
                route: `permissions/${_ls_id}`,
                data: {
                    form: $('#form-permission-create')
                },
                function: (_response) => {
                    if(_response.next){
                        localstorage_function('remove', 'LS_PERMISSION_DATA');
                        $('#btnCreate').css('display', 'inline');
                        $('#btnUpdate').css('display', 'none');
                    
                        bootbox_alert({
                            title: 'informative',
                            message: _response.message,
                            type: 'success'
                        });

                        $('#datatable-list').html(_response.view);                    
                        $('#form-permission-create')[0].reset();
                    }
                }
            });
        }

    }

    function btn_delete(_id){        
        ajax_function_object({
            method: 'DELETE',
            route: `permissions/${_id}`,
            data: { form: $('#form-permission-create') },
            function: (_response) => {
                if(_response.next){                    
                    bootbox_alert({
                        title: 'informative',
                        message: _response.message,
                        type: 'warning'
                    });

                    $('#datatable-list').html(_response.view);       
                }                
            }
        });
    }
</script>
@endsection