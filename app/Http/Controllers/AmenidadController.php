<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Amenidad;
use DB;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AmenidadController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Amenidad::all();
        
        return view('systems.amenidades.index', compact('data'));
    }

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
        $response = ['message' => '', 'next' => false];

        $this->validate($request, [
            'name' => 'required|unique:cat_amenidades,name'
        ]);
        
        if(Amenidad::create(['name' => $request->input('name')])){
            $response['message'] = 'This amenidad name <strong>'.$request->input('name').'</strong> was created successfully.';
            $response['next'] = true;
            $response['view'] = view('systems.amenidades.ajax.table_amenidad_list', ['data' => Amenidad::all()])->render();
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
        $response = ['message' => 'This amenidad does not found.', 'next' => false];

        $encontrado = Amenidad::find($id);
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
        $response = ['message' => 'There was a problem saving the amenidad', 'next' => false];
        
        $this->validate($request, [
            'name' => 'required|unique:cat_amenidades,name'
        ]);

        if(Amenidad::where('id', $id)->update(['name' => $request->input('name')])){
            $response['message'] = 'The registry was updated successfully.';
            $response['next'] = true;
            $response['view'] = view('systems.amenidades.ajax.table_amenidad_list', ['data' => Amenidad::all()])->render();
        }

        return json_encode($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) 
    {
        $response = ['message' => 'It is not possible to desactivate this register.', 'next' => false];
        
        if($id != ""){
            $amenidad = Amenidad::find($id);
            $new_status = 0;
            $new_message = "";
            switch ($amenidad->status_alta) {
                case 0:
                    $new_status = 1;
                    $new_message = "This register was actived.";
                    break;
                case 1:
                    $new_status = 0;
                    $new_message = "This register was deactivate.";
                    break;
            }
            if(Amenidad::where('id', $id)->update(['status_alta' => $new_status])){
                $response['message'] = $new_message;
                $response['next'] = true;
                $response['view'] = view('systems.amenidades.ajax.table_amenidad_list', ['data' => Amenidad::all()])->render();
            }
        }

        return json_encode($response);
    }
}
