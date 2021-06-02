<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\userRegisterationValidation;
use App\Notifications\technicianNotifications;
use App\Notifications\assignTicket;
use Carbon\Carbon;
use App\user;
use App\user_info;
use App\ticket;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class permissionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function administrationByadmin(Request $request,$id)
    {
        $user = User::find($id);
        $user->permissions()->detach();
        if(isset($request->admin_permissions) && (count($request->admin_permissions)>0)){
            foreach ($request->admin_permissions as $key => $permission) {
                $permission = Permission::findById($permission);
                $user->givePermissionTo($permission);
            }
        }
        
        session()->flash('message','Permissons has been updated successfully');
        return back();
       
    }
    public function requestorByadmin(Request $request,$id)
    {
        $user = User::find($id);
        $user->permissions()->detach();
        if(isset($request->requestor_permissions) && (count($request->requestor_permissions)>0)){
            foreach ($request->requestor_permissions as $key => $permission) {
                $permission = Permission::findById($permission);
                $user->givePermissionTo($permission);
            }
        }
        
        session()->flash('message','Permissons has been updated successfully');
        // return redirect('/admin/users');
        return back();
    }

    public function technicianByadmin(Request $request,$id)
    {
        $user = User::find($id);
        $user->permissions()->detach();
        if(isset($request->technician_permissions) && (count($request->technician_permissions)>0)) {
            foreach ($request->technician_permissions as $key => $permission) {
                $permission = Permission::findById($permission);
                $user->givePermissionTo($permission);
            }
        }        
        session()->flash('message','Permissons has been updated successfully');
        return back();
    }
}
