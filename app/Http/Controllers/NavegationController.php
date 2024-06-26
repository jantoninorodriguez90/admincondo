<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\SysSeccion;

class NavegationController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $secciones = SysSeccion::all();
        
        return view('systems.navegations.index', ['secciones' => $secciones]);
    }

    public function store_seccion(Request $request){
        $response = ['message' => 'It had a problem to create this user.', 'next' => false];        
        $this->validate($request, [
            'value' => 'required|unique',
            'icon' => 'required',
            'sistema' => 'required'
        ]);
    
            
        if(SysSeccion::create($request->all())){
            $response['next'] = true;
            $response['message'] = 'The menu '.$request->input('value').' was created successfully.';
            $response['view'] = view('systems.navegations.ajax.table_seccion_list', ['secciones' => SysSeccion::all()])->render();
        }
        return json_encode($response);
    }

    public function edit_seccion(string $id){
        $response = ['message' => 'This menu does not found.', 'next' => false];

        $encontrado = SysSeccion::find($id);
        if(!empty($encontrado)){
            $response['data'] = $encontrado;
            $response['next'] = true;
        }
        
        return json_encode($response);
    }

    public function update_seccion(Request $request, string $id){
        $response = ['message' => 'There was a problem saving this menu.', 'next' => false];
        
        if(SysSeccion::where('id', $id)->update($request->except(['_token']))){
            $response['message'] = 'The registry was updated successfully.';
            $response['next'] = true;
            $response['view'] = view('systems.navegations.ajax.table_seccion_list', ['secciones' => SysSeccion::all()])->render();
        }

        return json_encode($response);
    }

    public function destroy_seccion(string $id){
        $response = ['message' => 'It is not possible to deactivate this register.', 'next' => false];
        
        if($id != ""){
            $user = SysSeccion::find($id);
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
            if(SysSeccion::where('id', $id)->update(['status_alta' => $new_status])){
                $response['message'] = $new_message;
                $response['next'] = true;
                $response['view'] = view('systems.navegations.ajax.table_seccion_list', ['secciones' => SysSeccion::all()])->render();
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