<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\SYSSeccion;
use App\Models\SYSModulo;

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
        
        return view('systems.navegations.index', [
            'secciones' => $secciones, 'secciones_activos' => $secciones_activos,
            'modulos'   => $modulos
        ]);
    }
    // ################################################################################
    // ################################################################################
    // FUNCIONES DE SECCIONES
    public function store_seccion(Request $request){
        $response = ['message' => 'It had a problem to create this section.', 'next' => false];        
        $this->validate($request, [
            'value' => 'required',
            'icon' => 'required',
            'sistema' => 'required'
        ]);
    
            
        if(SYSSeccion::create($request->all())){
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
        
        if(SYSSeccion::where('id', $id)->update($request->except(['_token']))){
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
        
        if(SYSModulo::where('id', $id)->update($request->except(['_token']))){
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
            if(SYSSeccion::where('id', $id)->update(['status_alta' => $new_status])){
                $response['message'] = $new_message;
                $response['next'] = true;
                $response['view'] = view('systems.navegations.ajax.table_modulo_list', ['modulos' => SYSSeccion::all()])->render();
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}