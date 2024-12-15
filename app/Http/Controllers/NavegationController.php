<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\SYSSeccion;
use App\Models\SYSModulo;
use App\Models\SYSModuloUsuario;
use App\Models\User;

class NavegationController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $secciones = SYSSeccion::all();
        $secciones_activos = SYSSeccion::where('status_alta', 1)->get();
        $modulos = SYSModulo::all();
        $modulos_activos = SYSModulo::with('seccion')->where('status_alta', 1)->get(); 
        $usuarios = User::where('status_alta', 1)->get();
        $modulos_usuarios = SYSModuloUsuario::with('modulo')->with('user')->get();
        
        return view('systems.navegations.index', [
            'secciones' => $secciones, 'secciones_activos' => $secciones_activos,
            'modulos'   => $modulos,
            'modulos_activos'   => $modulos_activos,
            'usuarios'  => $usuarios,
            'modulos_usuarios'   => $modulos_usuarios
        ]);
    }
    // ################################################################################
    // ################################################################################
    // FUNCIONES DE SECCIONES
    public function store_seccion(Request $request){
        $response = ['message' => 'It had a problem to create this section.', 'next' => false];                
        $input = [];
        $this->validate($request, [
            'value_seccion' => 'required',
            'icon_seccion'  => 'required',
            'sistema'  => 'required'
        ]);        
        // LIMPIAREMOS EL ARREGLO ANTES DE GUARDAR        
        $input = [
            'value' => $request->input('value_seccion'),
            'icon' => $request->input('icon_seccion'),
            'sistema' => $request->input('sistema'),
        ];
      
        if(SYSSeccion::create($input)){
            $response['next'] = true;
            $response['message'] = 'The menu '.$request->input('value').' was created successfully.';
            $response['view'] = view('systems.navegations.ajax.table_seccion_list', ['secciones' => SYSSeccion::all()])->render();
        }
        return json_encode($response);
    }

    public function edit_seccion(string $id){
        $response = ['message' => 'This menu does not found.', 'next' => false];

        $encontrado = SYSSeccion::find($id);
        if(!empty($encontrado)){
            $response['data'] = $encontrado;
            $response['next'] = true;
        }
        
        return json_encode($response);
    }

    public function update_seccion(Request $request, string $id){
        $response = ['message' => 'There was a problem saving this menu.', 'next' => false];
        $input = [];
        $this->validate($request, [
            'value_seccion' => 'required',
            'icon_seccion'  => 'required',
            'sistema'  => 'required'
        ]);        
        // LIMPIAREMOS EL ARREGLO ANTES DE GUARDAR        
        $input = [
            'value' => $request->input('value_seccion'),
            'icon' => $request->input('icon_seccion'),
            'sistema' => $request->input('sistema'),
        ];
        
        if(SYSSeccion::where('id', $id)->update($input)){
            $response['message'] = 'The registry was updated successfully.';
            $response['next'] = true;
            $response['view'] = view('systems.navegations.ajax.table_seccion_list', ['secciones' => SYSSeccion::all()])->render();
        }

        return json_encode($response);
    }

    public function destroy_seccion(string $id){
        $response = ['message' => 'It is not possible to deactivate this register.', 'next' => false];
        
        if($id != ""){
            $user = SYSSeccion::find($id);
            $new_status = 0;
            $new_message = "";
            switch ($user->status_alta) {
                case 0:
                    $new_status = 1;
                    $new_message = "This register was actived.";
                    break;
                case 1:
                    $new_status = 0;
                    $new_message = "This register was deactivate.";
                    break;
            }
            if(SYSSeccion::where('id', $id)->update(['status_alta' => $new_status])){
                $response['message'] = $new_message;
                $response['next'] = true;
                $response['view'] = view('systems.navegations.ajax.table_seccion_list', ['secciones' => SYSSeccion::all()])->render();
            }
        }

        return json_encode($response);
    }
    // ################################################################################
    // ################################################################################
    // FUNCIONES DE MODULOS
    public function store_modulo(Request $request){
        $response = ['message' => 'It had a problem to create this module.', 'next' => false];        
        $input = [];
        $this->validate($request, [
            'sis_seccion_id' => 'required',
            'value_modulo' => 'required',
            'icon_modulo'  => 'required',
            'ruta'  => 'required'
        ]);        
        // LIMPIAREMOS EL ARREGLO ANTES DE GUARDAR        
        $input = [
            'sis_seccion_id'    => $request->input('sis_seccion_id'),
            'value' => $request->input('value_modulo'),
            'icon' => $request->input('icon_modulo'),
            'ruta' => $request->input('ruta'),
        ];
            
        if(SYSModulo::create($input)){
            $response['next'] = true;
            $response['message'] = 'The module '.$input['value'].' was created successfully.';
            $response['view'] = view('systems.navegations.ajax.table_modulo_list', ['modulos' => SYSModulo::all()])->render();
        }
        return json_encode($response);
    }

    public function edit_modulo(string $id){
        $response = ['message' => 'This module does not found.', 'next' => false];

        $encontrado = SYSModulo::find($id);
        if(!empty($encontrado)){
            $response['data'] = $encontrado;
            $response['next'] = true;
        }
        
        return json_encode($response);
    }

    public function update_modulo(Request $request, string $id){
        $response = ['message' => 'There was a problem saving this module.', 'next' => false];
        $input = [];
        $this->validate($request, [
            'sis_seccion_id' => 'required',
            'value_modulo' => 'required',
            'icon_modulo'  => 'required',
            'ruta'  => 'required'
        ]);        
        // LIMPIAREMOS EL ARREGLO ANTES DE GUARDAR        
        $input = [
            'sis_seccion_id'    => $request->input('sis_seccion_id'),
            'value' => $request->input('value_modulo'),
            'icon' => $request->input('icon_modulo'),
            'ruta' => $request->input('ruta'),
        ];
        
        if(SYSModulo::where('id', $id)->update($input)){
            $response['message'] = 'The registry was updated successfully.';
            $response['next'] = true;
            $response['view'] = view('systems.navegations.ajax.table_modulo_list', ['modulos' => SYSModulo::all()])->render();
        }

        return json_encode($response);
    }

    public function destroy_modulo(string $id){
        $response = ['message' => 'It is not possible to deactivate this register.', 'next' => false];
        
        if($id != ""){
            $user = SYSModulo::find($id);
            $new_status = 0;
            $new_message = "";
            switch ($user->status_alta) {
                case 0:
                    $new_status = 1;
                    $new_message = "This register was actived.";
                    break;
                case 1:
                    $new_status = 0;
                    $new_message = "This register was deactivate.";
                    break;
            }
            if(SYSModulo::where('id', $id)->update(['status_alta' => $new_status])){
                $response['message'] = $new_message;
                $response['next'] = true;
                $response['view'] = view('systems.navegations.ajax.table_modulo_list', ['modulos' => SYSModulo::all()])->render();
            }
        }

        return json_encode($response);
    }
    // ################################################################################
    // ################################################################################
    // FUNCIONES QUE SE UTILIZARAS PARA LA ASIGNACION DE LOS PERMISOS A LOS USUARIOS
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = ['message' => 'It had a problem to create this assign to user.', 'next' => false];        
        $this->validate($request, [
            'usuario_id' => 'required',
            'sis_modulo_id' => 'required'
        ]);
            
        if(SYSModuloUsuario::create($request->all())){
            $response['next'] = true;
            $response['message'] = 'The modulo was assigned to this user '.$request->input('usuario_id').' was updated successfully.';
            $response['view'] = view('systems.navegations.ajax.table_modulo_user_list', ['modulos_usuarios' => SYSModuloUsuario::all()])->render();
        }
        return json_encode($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $response = ['message' => 'This register does not found.', 'next' => false];

        $encontrado = SYSModuloUsuario::find($id);
        if(!empty($encontrado)){
            $response['data'] = $encontrado;
            $response['next'] = true;
        }
        
        return json_encode($response);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $response = ['message' => 'There was a problem saving this assign.', 'next' => false];        
        $this->validate($request, [
            'usuario_id' => 'required',
            'sis_modulo_id' => 'required'
        ]);
        
        $request->except('_token');
        if(SYSModuloUsuario::where('id', $id)->update($request->except(['_token']))){
            $response['message'] = 'The registry was updated successfully.';
            $response['next'] = true;
            $response['view'] = view('systems.navegations.ajax.table_modulo_user_list', ['modulos_usuarios' => SYSModuloUsuario::with('modulo')->with('user')->get()])->render();
        }

        return json_encode($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = ['message' => 'It is not possible to deactivate this register.', 'next' => false];
        
        if($id != ""){
            $user = SYSModuloUsuario::find($id);
            $new_status = 0;
            $new_message = "";
            switch ($user->status_alta) {
                case 0:
                    $new_status = 1;
                    $new_message = "This register was actived.";
                    break;
                case 1:
                    $new_status = 0;
                    $new_message = "This register was deactivate.";
                    break;
            }
            if(SYSModuloUsuario::where('id', $id)->update(['status_alta' => $new_status])){                
                $response['message'] = $new_message;
                $response['next'] = true;
                $response['view'] = view('systems.navegations.ajax.table_modulo_user_list', ['modulos_usuarios' => SYSModuloUsuario::with('modulo')->with('user')->get()])->render();
            }
        }

        return json_encode($response);
    }
}