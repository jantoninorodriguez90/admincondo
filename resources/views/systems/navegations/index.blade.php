@extends('layouts.app')

@section('content')
<x-card>
    <x-slot:title>FORM MENU</x-slot:title>
    <form class="form-horizontal form-false" method="POST" action="#" id="form-create-seccion">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label for="value" class="col-sm-2 col-form-label">MENU</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="value" name="value" placeholder="">
                    <div id="message_error_value" class="invalid-feedback"></div>
                </div>
            </div>  
            <div class="form-group row">
                <label for="icon" class="col-sm-2 col-form-label">ICON</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="icon" name="icon" placeholder="">
                    <div class="row">
                        <div class="col-sm-6" id="div_show_icon"></div>
                        <div class="col-sm-6">
                            <div class="float-right">
                                <small><i><a href="https://fontawesome.com/v4/icons/" target="_blank">fontawesome</a></i></small>
                            </div>
                        </div>                        
                    </div>
                    <div id="message_error_icon" class="invalid-feedback"></div>
                </div>
            </div>  
            <div class="form-group row">
                <label for="sistema" class="col-sm-2 col-form-label">SYSTEM</label>
                <div class="col-sm-10">
                    <select class="custom-select form-control-border border-width-2" id="sistema" name="sistema">
                        <option value="">choose one...</option>
                        <option value="web">web</option>
                    </select>                    
                    <div id="message_error_sistema" class="invalid-feedback"></div>
                </div>
            </div>  
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="button" class="btn btn-info float-right" onclick="btn_create_seccion()" id="btnCreate">CREATE</button>
            <button type="button" class="btn btn-info float-right" onclick="btn_update_seccion()" id="btnUpdate">UPDATE</button>
            {{-- <button type="button" class="btn btn-default float-right">Cancel</button> --}}
        </div>
        <!-- /.card-footer -->
    </form>

    <div id="datatable-menu-list" class="mt-2">     
        <x-data-table>            
            <x-slot:title>menu list</x-slot:title>
            <x-slot:thead>
                <tr>
                    <th>ID</th>
                    <th>MENU</th>
                    <th>ICON</th>
                    <th>SYSTEM</th>
                    <th>ACTIONS</th>
                </tr>
            </x-slot:thead>
            @foreach ($secciones as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->value }}</td>
                    <td class="text-center"><i class="{{ $item->icon }}" aria-hidden="true"></i></td>
                    <td>{{ $item->sistema }}</td>
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
    </div>
</x-card>
@endsection

@section('jquery')
<script>
    $(document).ready(function (){
        localstorage_function('remove', 'LS_NAVIGATION_DATA');    
        $('#btnUpdate').css('display', 'none');

        input_validation({
            item: ['value', 'icon', 'sistema']
        });
        
        $('#icon').on("input", function () {
            $('#div_show_icon').html('<i class="ml-1 '+$(this).val()+'" aria-hidden="true"></i>');
        });
    });

    function btn_create_seccion(){
        ajax_function_object({
            method: 'POST',
            route: `{{ route('navegations.seccion.store') }}`,
            data: {
                form: $('#form-create-seccion')
            },
            function: (_response) => {
                if(_response.next){
                    bootbox_alert({
                        title: 'informative',
                        message: _response.message,
                        type: 'success'
                    });
                                        
                    form_clear('form-create-seccion');        
                    $('#div_show_icon').html("");
                    $('#datatable-menu-list').html(_response.view);       
                }
            }
        });
    } 

    function btn_edit_seccion(_id){
        ajax_function_object({
            method: 'GET',
            route: `${_id}/seccion/edit`,
            data: {},
            function: (_response) => {
                if(_response.next){
                    localstorage_function('set', 'LS_NAVIGATION_DATA', _response.data.id);
                    $('#btnCreate').css('display', 'none');
                    $('#btnUpdate').css('display', 'inline');

                    $('#value').val(_response.data.value);
                    $('#value').attr('readonly', 'readonly');
                    $('#icon').val(_response.data.icon);
                    $('#div_show_icon').html('<i class="ml-1 '+_response.data.icon+'" aria-hidden="true"></i>');
                    $('#sistema').val(_response.data.sistema);
                }
            }
        });
    }

    function btn_update_seccion(){
        let _ls_id = localstorage_function('get', 'LS_NAVIGATION_DATA');

        if(_ls_id != ""){
            ajax_function_object({
                method: 'PUT',
                route: `${_ls_id}/seccion`,
                data: {
                    form: $('#form-create-seccion')
                },
                function: (_response) => {
                    if(_response.next){
                        localstorage_function('remove', 'LS_NAVIGATION_DATA');
                        $('#btnCreate').css('display', 'inline');
                        $('#btnUpdate').css('display', 'none');
                    
                        bootbox_alert({
                            title: 'informative',
                            message: _response.message,
                            type: 'success'
                        });

                        $('#datatable-menu-list').html(_response.view);                    
                        form_clear('form-create-seccion');                 
                        $('#value').removeAttr('readonly');  
                        $('#div_show_icon').html(""); 
                    }
                }
            });
        }

    }

    function btn_delete_seccion(_id){        
        ajax_function_object({
            method: 'DELETE',
            route: `${_id}/seccion`,
            data: { form: $('#form-create-seccion') },
            function: (_response) => {
                if(_response.next){                    
                    bootbox_alert({
                        title: 'informative',
                        message: _response.message,
                        type: 'warning'
                    });

                    $('#datatable-menu-list').html(_response.view);       
                }                
            }
        });
    }

    function form_validation(){
        if($('#name').val() != "" && $('#email').val() != "" && $('#password').val() != ""){            
            if($('#password').val() == $('#password_confirmation').val()) return true;                     
        }else{
            $("#name, #email, #password").removeClass("is-valid").addClass("is-invalid");
            $('#message_error_name, #message_error_email, #message_error_password').css('display', 'inline');
            $('#message_error_name').html('You must type a name.');
            $('#message_error_email').html('You must type an email.');
            $('#message_error_password').html('You must type a password.');
        }

        return false;
    }
</script>
@endsection