<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Foundation\Validation\ValidatesRequests;

class PermissionController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Permission::all();
        
        return view('systems.permissions.index', compact('data'));
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
            'name' => 'required|unique:permissions,name'
        ]);
        
        if(Permission::create(['name' => $request->input('name')])){
            $response['message'] = 'This permission name <strong>'.$request->input('name').'</strong> was created successfully.';
            $response['next'] = true;
            $response['view'] = view('systems.permissions.ajax.table_permission_list', ['data' => Permission::all()])->render();
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
        $response = ['message' => 'This permission does not found.', 'next' => false];

        $encontrado = Permission::find($id);
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
        $response = ['message' => 'There was a problem saving the permiss.', 'next' => false];
        
        $this->validate($request, [
            'name' => 'required|unique:permissions,name'
        ]);

        if(Permission::where('id', $id)->update(['name' => $request->input('name')])){
            $response['message'] = 'The rgistry was updated successfully.';
            $response['next'] = true;
            $response['view'] = view('systems.permissions.ajax.table_permission_list', ['data' => Permission::all()])->render();
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
            $permission = Permission::find($id);
            $new_status = 0;
            $new_message = "";
            switch ($permission->status_alta) {
                case 0:
                    $new_status = 1;
                    $new_message = "This register was actived.";
                    break;
                case 1:
                    $new_status = 0;
                    $new_message = "This register was deactivate.";
                    break;
            }
            if(Permission::where('id', $id)->update(['status_alta' => $new_status])){
                $response['message'] = $new_message;
                $response['next'] = true;
                $response['view'] = view('systems.permissions.ajax.table_permission_list', ['data' => Permission::all()])->render();
            }
        }

        return json_encode($response);
    }
}