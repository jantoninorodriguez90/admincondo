@extends('layouts.app')

@section('content')
<x-card>
    <x-slot:title>FORM ROLE</x-slot:title>
    <form class="form-horizontal form-false" method="POST" action="#" id="form-create">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">ROLE</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="ROLE NAME">
                    <div id="message_error_name" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <div id="div_checkbox_permission">
                        @foreach($permission as $value)
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="permission[{{$value->id}}]" value="{{$value->id}}" {{ in_array($value->id, $rolePermissions) ? 'checked' : ''}}>
                                <label class="form-check-label" for="exampleCheck2"> {{ $value->name }}</label>
                            </div>
                        @endforeach
                    </div>
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
        <x-slot:title>roles list</x-slot:title>
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
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->updated_at }}</td>
                <td>{{ $item->created_at }}</td>
                <td class="text-center">
                    <button type="button" class="btn btn-xs btn-info" onclick="btn_edit({{ $item->id }})"><i class="fa fa-pencil-alt" aria-hidden="true"></i></button>
                    <x-modal type="lg" class="btn btn-xs btn-info" onclick="btn_show({{ $item->id }})">
                        <x-slot:button><i class="fa fa-eye" aria-hidden="true"></i></x-slot:button>    
                        <x-slot:title>PERMISSION</x-slot:title>                              
                    </x-modal>
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
        localstorage_function('remove', 'LS_ROLE_DATA');
        $('#btnUpdate').css('display', 'none');

        input_validation({
            item: ['name']
        });

        // $.LoadingOverlay("show");       
    });

    function btn_create(){
        let _next = form_validation({
            item: ['name']
        });

        if(_next){
            ajax_function_object({
                method: 'POST',
                route: `{{ route('roles.store') }}`,
                data: {
                    form: $('#form-create')
                },
                function: (_response) => {
                    if(_response.next){
                        bootbox_alert({
                            title: 'informative',
                            message: _response.message,
                            type: 'success'
                        });
                        $('#datatable-list').html(_response.view);                    
                        form_clear('form-create');        
                    }
                }
            });
        }        
    }    

    function btn_edit(_id){
        ajax_function_object({
            method: 'GET',
            route: `roles/${_id}/edit`,
            data: {},
            function: (_response) => {
                if(_response.next){
                    localstorage_function('set', 'LS_ROLE_DATA', _response.data.id);
                    $('#btnCreate').css('display', 'none');
                    $('#btnUpdate').css('display', 'inline');

                    $('#name').val(_response.data.name);
                    let _list_html_permissions = '';                    
                    _response.permissions.forEach((element) => {
                        let _checked = (_response.rolePermissions.includes(element.id))?'checked':'';
                        _list_html_permissions += '<div class="form-check" id="icheckbox">';
                            _list_html_permissions += '<input type="checkbox" class="form-check-input" name="permission['+element.id+']" value="'+element.id+'" '+_checked+'>';
                            _list_html_permissions += '<label class="form-check-label" for="exampleCheck2">'+element.name+'</label>';
                        _list_html_permissions += '</div>';
                    });
                    console.log(_list_html_permissions);
                    $('#div_checkbox_permission').html(_list_html_permissions);
                }
            }
        });
    }

    function btn_update(){
        let _ls_id = localstorage_function('get', 'LS_ROLE_DATA');
        let _next = form_validation({
            item: ['name']
        });

        if(_next){
            ajax_function_object({
                method: 'PUT',
                route: `roles/${_ls_id}`,
                data: {
                    form: $('#form-create')
                },
                function: (_response) => {
                    if(_response.next){
                        localstorage_function('remove', 'LS_ROLE_DATA');
                        $('#btnCreate').css('display', 'inline');
                        $('#btnUpdate').css('display', 'none');
                    
                        bootbox_alert({
                            title: 'informative',
                            message: _response.message,
                            type: 'success'
                        });

                        $('#datatable-list').html(_response.view);                    
                        form_clear('form-create');                    
                    }
                }
            });
        }

    }

    function btn_delete(_id){        
        ajax_function_object({
            method: 'DELETE',
            route: `roles/${_id}`,
            data: { form: $('#form-create') },
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

    function btn_show(_id){
        ajax_function_object({
            method: 'GET',
            route: `roles/${_id}`,
            data: { },
            function: (_response) => {
                if(_response.next){   
                    $('.modal-title').html('ROLE NAME: '+_response.data.name.toUpperCase());
                    $('.modal-body').html(_response.view);                    
                }else{
                    bootbox_alert({
                        title: 'informative',
                        message: _response.message,
                        type: 'info'
                    });
                }            
            }
        });
        
    }
</script>
@endsection