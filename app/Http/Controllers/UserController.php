<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Hash;
use DB;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();
        return view('systems.users.index', compact('data'));
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
        $response = ['message' => 'It had a problem to create this user.', 'next' => false];        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
            
        if(User::create($input)){
            $response['next'] = true;
            $response['message'] = 'The user '.$input['email'].' was created successfully.';
            $response['view'] = view('systems.users.ajax.table_user_list', ['data' => User::all()])->render();
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
        $response = ['message' => 'This user does not found.', 'next' => false];

        $encontrado = User::find($id);
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
        $response = ['message' => 'There was a problem saving this user.', 'next' => false];
        $input = [];

        $input['name'] = $request->input('name');
        if($request->input('password') != "") $input['password'] = Hash::make($request->input('password'));
        
        if(User::where('id', $id)->update($input)){
            $response['message'] = 'The rgistry was updated successfully.';
            $response['next'] = true;
            $response['view'] = view('systems.users.ajax.table_user_list', ['data' => User::all()])->render();
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
            $user = User::find($id);
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
            if(User::where('id', $id)->update(['status_alta' => $new_status])){
                $response['message'] = $new_message;
                $response['next'] = true;
                $response['view'] = view('systems.users.ajax.table_user_list', ['data' => User::all()])->render();
            }
        }

        return json_encode($response);
    }

    public function form_assign(string $id){
        $response = ['message' => 'It is not possible to find this user.', 'next' => false];
        
        $user = User::find($id);
        if(!empty($user)){                        
            
            $response['next'] = true;
            $response['data'] = $user;
            $response['view'] = view('systems.users.modal.from_assign_rolepermiss', [
                'user'  => $user,
                'roles' => Role::where('status_alta', 1)->get(), 
                'permissions'   => Permission::where('status_alta', 1)->get(),
                'user_roles'    => $user->roles->pluck('name','name')->all()
                ])->render();
        }
        
        return json_encode($response);
    }

    public function assing_role(Request $request, string $id){
        $response = ['message' => 'It is not possible to assign this role to this user.', 'next' => false];

        $user = User::find($id);
        if(!empty($user)){
            DB::table('model_has_roles')->where('model_id', $id)->delete();            
            $user->assignRole($request->input('role'));
            $response['next'] = true;
            $response['message'] = 'The role was assigned successfully.';
        }
        
        return json_encode($response);
    }
}