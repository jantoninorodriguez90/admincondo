@extends('layouts.app')

@section('content')
<x-card>
    <x-slot:title>FORM MENU</x-slot:title>
    <form class="form-horizontal form-false" method="POST" action="#" id="form-create-seccion">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label for="value_seccion" class="col-sm-2 col-form-label">MENU</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="value_seccion" name="value_seccion" placeholder="">
                    <div id="message_error_value_seccion" class="invalid-feedback"></div>
                </div>
            </div>  
            <div class="form-group row">
                <label for="icon_seccion" class="col-sm-2 col-form-label">ICON</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="icon_seccion" name="icon_seccion" placeholder="">
                    <div class="row">
                        <div class="col-sm-6" id="div_show_icon_seccion"></div>
                        <div class="col-sm-6">
                            <div class="float-right">
                                <small><i><a href="https://fontawesome.com/v4/icons/" target="_blank">fontawesome</a></i></small>
                            </div>
                        </div>                        
                    </div>
                    <div id="message_error_icon_seccion" class="invalid-feedback"></div>
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

<x-card>
    <x-slot:title>FORM MODULOS</x-slot:title>
    <form class="form-horizontal form-false" method="POST" action="#" id="form-create-modulo">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label for="sis_seccion_id" class="col-sm-2 col-form-label">LIST MENU</label>
                <div class="col-sm-10">
                    <select class="custom-select form-control-border border-width-2" id="sis_seccion_id" name="sis_seccion_id">
                        <option value="">choose one...</option>
                        @foreach ($secciones_activos as $item)  
                            <option value="{{ $item->id }}">{{ $item->value }}</option>
                        @endforeach
                    </select>                    
                    <div id="message_error_sis_seccion_id" class="invalid-feedback"></div>
                </div>
            </div> 
            <div class="form-group row">
                <label for="value_modulo" class="col-sm-2 col-form-label">VALUE</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="value_modulo" name="value_modulo" placeholder="">
                    <div id="message_error_value_modulo" class="invalid-feedback"></div>
                </div>
            </div>  
            <div class="form-group row">
                <label for="icon_modulo" class="col-sm-2 col-form-label">ICON</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="icon_modulo" name="icon_modulo" placeholder="">
                    <div class="row">
                        <div class="col-sm-6" id="div_show_icon_modulo"></div>
                        <div class="col-sm-6">
                            <div class="float-right">
                                <small><i><a href="https://fontawesome.com/v4/icons/" target="_blank">fontawesome</a></i></small>
                            </div>
                        </div>                        
                    </div>
                    <div id="message_error_icon_modulo" class="invalid-feedback"></div>
                </div>
            </div>  
            <div class="form-group row">
                <label for="ruta" class="col-sm-2 col-form-label">ROUTE</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ruta" name="ruta" placeholder="">
                    <div id="message_error_ruta" class="invalid-feedback"></div>
                </div>
            </div>  
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="button" class="btn btn-info float-right" onclick="btn_create_modulo()" id="btnCreateModulo">CREATE</button>
            <button type="button" class="btn btn-info float-right" onclick="btn_update_modulo()" id="btnUpdateModulo">UPDATE</button>
            {{-- <button type="button" class="btn btn-default float-right">Cancel</button> --}}
        </div>
        <!-- /.card-footer -->
    </form>

    <div id="datatable-modulo-list" class="mt-2">     
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
                        <button type="button" class="btn btn-xs btn-info" onclick="btn_edit_modulo({{ $item->id }})"><i class="fa fa-pencil-alt" aria-hidden="true"></i></button>
                        {{-- <x-modal type="lg" class="btn btn-xs btn-info" onclick="btn_assign({{ $item->id }})">
                            <x-slot:button><i class="fa fa-user-secret" aria-hidden="true"></i></x-slot:button>    
                            <x-slot:title><strong>USER: </strong></x-slot:title>                    
                            <x-slot:button_success>
                                <button type="button" class="btn btn-primary" onclick="btn_assign_role({{ $item->id }})" id="btnCreate">ASSIGN</button>
                            </x-slot:button_success>
                        </x-modal> --}}
                        @if ($item->status_alta == 1)
                            <button type="button" class="btn btn-xs btn-success" onclick="btn_delete_modulo({{ $item->id }})"><i class="fa fa-check" aria-hidden="true"></i></button>
                        @else
                            <button type="button" class="btn btn-xs btn-danger" onclick="btn_delete_modulo({{ $item->id }})"><i class="fa fa-times" aria-hidden="true"></i></button>
                        @endif                        
                    </td>
                </tr>
            @endforeach
        </x-data-table>
    </div>
</x-card>

<x-card>
    <x-slot:title>FORM USER ASSGIGN TO MODULE</x-slot:title>
    <form class="form-horizontal form-false" method="POST" action="#" id="form-create-modulo-user">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label for="usuario_id" class="col-sm-2 col-form-label">LIST USERS</label>
                <div class="col-sm-10">
                    <select class="custom-select form-control-border border-width-2" id="usuario_id" name="usuario_id">
                        <option value="">choose one...</option>
                        @foreach ($usuarios as $item)  
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>                    
                    <div id="message_error_usuario_id" class="invalid-feedback"></div>
                </div>
            </div> 
            <div class="form-group row">
                <label for="sis_modulo_id" class="col-sm-2 col-form-label">LIST MODULES</label>
                <div class="col-sm-10">
                    <select class="custom-select form-control-border border-width-2" id="sis_modulo_id" name="sis_modulo_id">
                        <option value="">choose one...</option>
                        @foreach ($modulos_activos as $item)  
                            <option value="{{ $item->id }}">{{ $item->value }}</option>
                        @endforeach
                    </select>                    
                    <div id="message_error_sis_modulo_id" class="invalid-feedback"></div>
                </div>
            </div> 
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="button" class="btn btn-info float-right" onclick="btn_create_modulo_user()" id="btnCreateModuloUser">CREATE</button>
            <button type="button" class="btn btn-info float-right" onclick="btn_update_modulo_user()" id="btnUpdateModuloUser">UPDATE</button>
            {{-- <button type="button" class="btn btn-default float-right">Cancel</button> --}}
        </div>
        <!-- /.card-footer -->
    </form>

    <div id="datatable-modulo-user-list" class="mt-2">     
        <x-data-table id="datatable-modulo-user">            
            <x-slot:title>modulo list</x-slot:title>
            <x-slot:thead>
                <tr>
                    <th>ID</th>
                    <th>USUARIO_ID</th>
                    <th>SIS_MODULO_ID</th>
                    <th>ACTIONS</th>
                </tr>
            </x-slot:thead>
            @foreach ($modulos_usuarios as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->usuario_id }}</td>
                    <td>{{ $item->sis_modulo_id }}</td>
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
    </div>
</x-card>
@endsection

@section('jquery')
<script>
    $(document).ready(function (){
        localstorage_function('remove', 'LS_NAVIGATION_DATA');    
        $('#btnUpdate, #btnUpdateModulo, #btnUpdateModuloUser').css('display', 'none');

        input_validation({
            item: ['value_seccion', 'icon_seccion', 'sistema', 'sis_seccion_id', 'value_modulo', 'icon_modulo', 'ruta', 'sis_modulo_id', 'usuario_id']
        });
        
        show_icon({
            item: ['seccion', 'modulo']
        });

        // $('#icon').on("input", function () {
        //     $('#div_show_icon').html('<i class="ml-1 '+$(this).val()+'" aria-hidden="true"></i>');
        // });
    });
    // ##########################################################################################
    // ##########################################################################################
    // FUNCIONES DE SECCIONES
    function btn_create_seccion(){
        let _next = form_validation({
            item: ['value_seccion', 'icon_seccion', 'sistema']
        });

        if(_next){
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
                        $('#div_show_icon_seccion').html("");
                        $('#datatable-menu-list').html(_response.view);       
                    }
                }
            });
        }        
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

                    $('#value_seccion').val(_response.data.value);
                    $('#value_seccion').attr('readonly', 'readonly');
                    $('#icon_seccion').val(_response.data.icon);
                    $('#div_show_icon_seccion').html('<i class="ml-1 '+_response.data.icon+'" aria-hidden="true"></i>');
                    $('#sistema').val(_response.data.sistema);
                }
            }
        });
    }

    function btn_update_seccion(){
        let _ls_id = localstorage_function('get', 'LS_NAVIGATION_DATA');
        let _next = form_validation({
            item: ['value_seccion', 'icon_seccion', 'sistema']
        });

        if(_next != ""){
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
                        $('#div_show_icon_seccion').html(""); 
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
    // ##########################################################################################
    // ##########################################################################################
    // FUNCIONES DE MODULOS
    function btn_create_modulo(){
        let _next = form_validation({
            item: ['value_modulo', 'icon_modulo', 'sis_seccion_id', 'ruta']
        });

        if(_next){
            ajax_function_object({
                method: 'POST',
                route: `{{ route('navegations.modulo.store') }}`,
                data: {
                    form: $('#form-create-modulo')
                },
                function: (_response) => {
                    if(_response.next){
                        bootbox_alert({
                            title: 'informative',
                            message: _response.message,
                            type: 'success'
                        });
                                            
                        form_clear('form-create-modulo');        
                        $('#div_show_icon_modulo').html("");
                        $('#datatable-modulo-list').html(_response.view);       
                    }
                }
            });
        }        
    } 

    function btn_edit_modulo(_id){
        ajax_function_object({
            method: 'GET',
            route: `${_id}/modulo/edit`,
            data: {},
            function: (_response) => {
                if(_response.next){
                    localstorage_function('set', 'LS_NAVIGATION_DATA', _response.data.id);
                    $('#btnCreateModulo').css('display', 'none');
                    $('#btnUpdateModulo').css('display', 'inline');

                    $('#value_modulo').val(_response.data.value);
                    $('#value_modulo').attr('readonly', 'readonly');
                    $('#icon_modulo').val(_response.data.icon);
                    $('#div_show_icon_modulo').html('<i class="ml-1 '+_response.data.icon+'" aria-hidden="true"></i>');
                    $('#ruta').val(_response.data.ruta);
                    $('#sis_seccion_id').val(_response.data.sis_seccion_id);
                }
            }
        });
    }

    function btn_update_modulo(){
        let _ls_id = localstorage_function('get', 'LS_NAVIGATION_DATA');
        let _next = form_validation({
            item: ['value_modulo', 'icon_modulo', 'sis_seccion_id', 'ruta']
        });

        if(_next != ""){
            ajax_function_object({
                method: 'PUT',
                route: `${_ls_id}/modulo`,
                data: {
                    form: $('#form-create-modulo')
                },
                function: (_response) => {
                    if(_response.next){
                        localstorage_function('remove', 'LS_NAVIGATION_DATA');
                        $('#btnCreateModulo').css('display', 'inline');
                        $('#btnUpdateModulo').css('display', 'none');
                    
                        bootbox_alert({
                            title: 'informative',
                            message: _response.message,
                            type: 'success'
                        });

                        $('#datatable-modulo-list').html(_response.view);                    
                        form_clear('form-create-modulo');                 
                        $('#value_modulo').removeAttr('readonly');  
                        $('#div_show_icon_modulo').html(""); 
                    }
                }
            });
        }

    }

    function btn_delete_modulo(_id){        
        ajax_function_object({
            method: 'DELETE',
            route: `${_id}/modulo`,
            data: { form: $('#form-create-modulo') },
            function: (_response) => {
                if(_response.next){                    
                    bootbox_alert({
                        title: 'informative',
                        message: _response.message,
                        type: 'warning'
                    });

                    $('#datatable-modulo-list').html(_response.view);       
                }                
            }
        });
    }
     // ##########################################################################################
    // ##########################################################################################
    // FUNCIONES DE MODULOS USUARIOS
    function btn_create_modulo_user(){
        let _next = form_validation({
            item: ['usuario_id', 'sis_modulo_id']
        });

        if(_next){
            ajax_function_object({
                method: 'POST',
                route: `{{ route('navegations.store') }}`,
                data: {
                    form: $('#form-create-modulo-user')
                },
                function: (_response) => {
                    if(_response.next){
                        bootbox_alert({
                            title: 'informative',
                            message: _response.message,
                            type: 'success'
                        });
                                            
                        form_clear('form-create-modulo-user');     
                        $('#datatable-modulo-user-list').html(_response.view);       
                    }
                }
            });
        }        
    } 

    function btn_edit_modulo_user(_id){
        ajax_function_object({
            method: 'GET',
            route: `${_id}/edit`,
            data: {},
            function: (_response) => {
                if(_response.next){
                    localstorage_function('set', 'LS_NAVIGATION_DATA', _response.data.id);
                    $('#btnCreateModuloUser').css('display', 'none');
                    $('#btnUpdateModuloUser').css('display', 'inline');

                    $('#usuario_id').val(_response.data.usuario_id);
                    $('#sis_modulo_id').val(_response.data.sis_modulo_id);
                }
            }
        });
    }

    function btn_update_modulo_user(){
        let _ls_id = localstorage_function('get', 'LS_NAVIGATION_DATA');
        let _next = form_validation({
            item: ['usuario_id', 'sis_modulo_id']
        });

        if(_next != ""){
            ajax_function_object({
                method: 'PUT',
                route: `${_ls_id}`,
                data: {
                    form: $('#form-create-modulo-user')
                },
                function: (_response) => {
                    if(_response.next){
                        localstorage_function('remove', 'LS_NAVIGATION_DATA');
                        $('#btnCreateModuloUser').css('display', 'inline');
                        $('#btnUpdateModuloUser').css('display', 'none');
                    
                        bootbox_alert({
                            title: 'informative',
                            message: _response.message,
                            type: 'success'
                        });

                        $('#datatable-modulo-user-list').html(_response.view);                    
                        form_clear('form-create-modulo-user');         
                    }
                }
            });
        }

    }

    function btn_delete_modulo_user(_id){        
        ajax_function_object({
            method: 'DELETE',
            route: `${_id}`,
            data: { form: $('#form-create-modulo-user') },
            function: (_response) => {
                if(_response.next){                    
                    bootbox_alert({
                        title: 'informative',
                        message: _response.message,
                        type: 'warning'
                    });

                    $('#datatable-modulo-user-list').html(_response.view);       
                }                
            }
        });
    }
    // ##########################################################################################
    // ##########################################################################################
    // FUNCIONES GENERALES
    function show_icon(data = { item:[] }){
        if (data.item.length > 0) {
            data.item.forEach((element) => {
                $('#icon_' + element).on("input", function () {
                    $('#div_show_icon_' + element).html('<i class="ml-1 '+$('#icon_' + element).val()+'" aria-hidden="true"></i>');
                });
            });
        } else {
            console.log('NESECITA RECIBIR LOS SIGUIENTES PARAMETROS: { item: [] }');
        }
    }
</script>
@endsection