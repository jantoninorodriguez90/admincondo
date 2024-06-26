<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\Foundation\Validation\ValidatesRequests;

class RoleController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        
    }

    public function index()
    {
        $data = Role::all();        
        $permission = Permission::orderBy('name')->where('status_alta', 1)->get();
                
        return view('systems.roles.index', ['data' => $data, 'permission' => $permission, 'rolePermissions' => []]);
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
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $permissionsID = array_map(
            function($value) { return (int)$value; },
            $request->input('permission')
        );
        
        $role = Role::create(['name' => $request->input('name'), 'guard_name' => 'web']);
        if($role != ""){
            $role->syncPermissions($permissionsID);
            $response['message'] = 'This role name <strong>'.$request->input('name').'</strong> was created successfully.';
            $response['next'] = true;
            $response['view'] = view('systems.roles.ajax.table_role_list', ['data' => Role::all()])->render();
        }

        return json_encode($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = ['message' => 'This role does not found with its permisses.', 'next' => false];
        
        $role = Role::find($id);
        if(!empty($role)){
            $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
            $response['data'] = $role;
            $response['next'] = true;
            $response['view'] = view('systems.roles.modal.show', compact('role','rolePermissions'))->render();
        }
        
        return json_encode($response);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $response = ['message' => 'This role does not found.', 'next' => false];

        $encontrado = Role::find($id);
        $permission = Permission::get();
        if(!empty($encontrado)){
            $response['next'] = true;
            $response['data'] = $encontrado;
            $response['permissions'] = Permission::where('status_alta', 1)->get();
            $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)            
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();        
            $response['rolePermissions'] = [];
            if(!empty($rolePermissions)){
                foreach ($rolePermissions as $value) {
                    $response['rolePermissions'][] = $value;
                }
            }
        }
        
        return json_encode($response);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $response = ['message' => 'There was a problem saving the role.', 'next' => false];

        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        if(!empty($role)){
            $role->name = $request->input('name');
            $role->save();

            $permissionsID = array_map(
                function($value) { return (int)$value; },
                $request->input('permission')
            );            
            $role->syncPermissions($permissionsID);
            
            $response['message'] = 'The rgistry was updated successfully.';
            $response['next'] = true;
            $response['view'] = view('systems.roles.ajax.table_role_list', ['data' => Role::all()])->render();
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
            $permission = Role::find($id);
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
            if(Role::where('id', $id)->update(['status_alta' => $new_status])){
                $response['message'] = $new_message;
                $response['next'] = true;
                $response['view'] = view('systems.roles.ajax.table_role_list', ['data' => Role::all()])->render();
            }
        }

        return json_encode($response);
    }
}