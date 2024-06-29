@extends('layouts.app')

@section('content')

<x-card>
    <x-slot:title>FORM USER</x-slot:title>
    <form class="form-horizontal form-false" method="POST" action="#" id="form-create">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">NAME</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="NAME">
                    <div id="message_error_name" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">EMAIL</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="EMAIL">
                    <div id="message_error_email" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">PASSWORD</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" placeholder="PASSWORD">
                    <div id="message_error_password" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">PASSWORD CONFIRMATION</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="PASSWORD CONFIRMATION">
                    <div id="message_error_password_confirmation" class="invalid-feedback"></div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="button" class="btn btn-primary float-right" onclick="btn_create()" id="btnCreate">CREATE</button>
            <button type="button" class="btn btn-primary float-right" onclick="btn_update()" id="btnUpdate">UPDATE</button>
            {{-- <button type="button" class="btn btn-default float-right">Cancel</button> --}}
        </div>
        <!-- /.card-footer -->
    </form>
</x-card>

<div id="datatable-list">     
    <x-data-table>            
        <x-slot:title>users list</x-slot:title>
        <x-slot:thead>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>UPDATED</th>
                <th>CREATED</th>
                <th>ACTIONS</th>
            </tr>
        </x-slot:thead>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->updated_at }}</td>
                <td>{{ $item->created_at }}</td>
                <td class="text-center">
                    <button type="button" class="btn btn-xs btn-info" onclick="btn_edit({{ $item->id }})"><i class="fa fa-pencil-alt" aria-hidden="true"></i></button>
                    <x-modal type="lg" class="btn btn-xs btn-info" onclick="btn_assign({{ $item->id }})">
                        <x-slot:button><i class="fa fa-user-secret" aria-hidden="true"></i></x-slot:button>    
                        <x-slot:title><strong>USER: </strong></x-slot:title>                    
                        <x-slot:button_success>
                            <button type="button" class="btn btn-primary" onclick="btn_assign_role({{ $item->id }})" id="btnCreate">ASSIGN</button>
                        </x-slot:button_success>
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
        localstorage_function('remove', 'LS_USER_DATA');
        $('#btnUpdate').css('display', 'none');

        input_validation({
            item: ['name', 'email', 'password', 'password_confirmation']
        });

        $('#password_confirmation').on("input", function () {
            if ($(this).val() == $('#password').val()) {
                $(this).removeClass("is-invalid").addClass("is-valid");
                $('#message_error_password_confirmation').css('display', 'none');
            } else {
                $(this).addClass('is-invalid');
                $('#message_error_password_confirmation').css('display', 'inline');
                $('#message_error_password_confirmation').html('You must type a the same password.');
            }
        });
    });

    function btn_create(){
        let _next = form_validation({
            item: ['name', 'email', 'password', 'password_confirmation']
        });

        if(_next){
            ajax_function_object({
                method: 'POST',
                route: `{{ route('users.store') }}`,
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
            route: `${_id}/edit`,
            data: {},
            function: (_response) => {
                if(_response.next){
                    localstorage_function('set', 'LS_USER_DATA', _response.data.id);
                    $('#btnCreate').css('display', 'none');
                    $('#btnUpdate').css('display', 'inline');

                    $('#name').val(_response.data.name);
                    $('#email').val(_response.data.email);
                    $('#email').attr('readonly', 'readonly');
                }
            }
        });
    }

    function btn_update(){
        let _ls_id = localstorage_function('get', 'LS_USER_DATA');
        let _next = form_validation({
            item: ['name', 'email', 'password', 'password_confirmation']
        });

        if(_ls_id){
            ajax_function_object({
                method: 'PUT',
                route: `${_ls_id}`,
                data: {
                    form: $('#form-create')
                },
                function: (_response) => {
                    if(_response.next){
                        localstorage_function('remove', 'LS_USER_DATA');
                        $('#btnCreate').css('display', 'inline');
                        $('#btnUpdate').css('display', 'none');
                    
                        bootbox_alert({
                            title: 'informative',
                            message: _response.message,
                            type: 'success'
                        });

                        $('#datatable-list').html(_response.view);                    
                        form_clear('form-create');                 
                        $('#email').removeAttr('readonly');   
                    }
                }
            });
        }

    }

    function btn_delete(_id){        
        ajax_function_object({
            method: 'DELETE',
            route: `${_id}`,
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

    function btn_assign(_id){        
        ajax_function_object({
            method: 'GET',
            route: `${_id}/assign`,
            data: { },
            function: (_response) => {
                if(_response.next){   
                    $('.modal-title').html('<strong>USER: </strong>'+_response.data.name.toUpperCase());
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

    function btn_assign_role(_id){
        if($('#role option:selected').val() != ""){
            ajax_function_object({
                method: 'PUT',
                route: `${_id}/assign`,
                data: {
                    form: $('#form-assign')
                },
                function: (_response) => {
                    if(_response.next){   
                        bootbox_alert({
                            title: 'informative',
                            message: _response.message,
                            type: 'success'
                        });
                            
                        form_clear('form-assign');      
                    }            
                }
            });
        }
        
    }

    // function form_user_validation(){
    //     if($('#name').val() != "" && $('#email').val() != "" && $('#password').val() != ""){            
    //         if($('#password').val() == $('#password_confirmation').val()) return true;                     
    //     }else{
    //         $("#name, #email, #password").removeClass("is-valid").addClass("is-invalid");
    //         $('#message_error_name, #message_error_email, #message_error_password').css('display', 'inline');
    //         $('#message_error_name').html('You must type a name.');
    //         $('#message_error_email').html('You must type an email.');
    //         $('#message_error_password').html('You must type a password.');
    //     }

    //     return false;
    // }
</script>
@endsection