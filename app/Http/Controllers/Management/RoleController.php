<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

use App\Profile;

class RoleController extends Controller
{
    /**
     * get a listing of roles.
     * @return \Illuminate\Http\Response
     */
    public function get_index() {

        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $roles = Role::where('name','<>','super-admin')->orderBy('name')->get();
            //dd($profile);exit;
            return view('management.user_management.roles.index', [
                'profile' => $profile,
                'roles' => $roles,
            ]);
          }
          return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

     /**
     * add a new role
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_role(Request $request)
    {
        if(Auth::check()){

        if($request->isMethod("get")){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            return view('management.user_management.roles.add', [
                'profile' => $profile,
            ]);
        }

        $this->validate($request, [
            'name' => 'required',
        ]);

        $role = Role::firstOrCreate([
            "name" => $request->input("name"),
        ]);

        $permissions = $request->input("permissions");
        if (count($permissions) > 0) {
            $role->givePermissionTo($permissions);
        }

        return response()->json([
            'code' => Response::HTTP_CREATED,
            'message' => 'Role created successfully.',
            'role' => $role
        ], 201);

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * show the specified role.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_role($id)
    {
        if(Auth::check()){

        try {
            $role = Role::with('permissions')->findOrFail($id);

            return response()->json([
                'code' => Response::HTTP_OK,
                'role' => $role
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'error' => 'Not found.'
            ], 404);
        }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * edit the specified role.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_role(Request $request, $id)
    {
        if(Auth::check()){

        try {
            $role = Role::findOrFail($id);

            $currentPermissions = $role->permissions()->pluck('name')->toArray();

            $role->name = $request->input('name');
            $role->save();

            // Revoke all the current permissions
            foreach ($currentPermissions as $permission) {
                $role->revokePermissionTo($permission);
            }

            $permissions = $request->input('permissions');
            if (count($permissions) > 0) {
                $role->givePermissionTo($permissions);
            }

            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'Role updated successfully.',
                'role' => $role
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'error' => 'Not found.'
            ], 404);
        }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * delete the specified role.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_role($id)
    {
        if(Auth::check()){

        try {
            $role = Role::with('permissions')->findOrFail($id);
            $role->delete();

            return back()->with('success', 'Role deleted successfully');
        } catch (\Throwable $th) {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'error' => 'Not found.'
            ], 404);
        }

    }
    return Redirect::to("auth/login")->withErrors('You do not have access!');
    }
}
