<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use Session;
use Hash;
use Illuminate\Http\Request;
use App\Http\Requests\userRegisterationValidation;
use App\Notifications\technicianNotifications;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\user;
use App\user_info;
use App\db_notification;
use App\email_notification;
use App\Notifications\UserCreated;

class adminController extends Controller
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
    
    public function redirectUser(){
    	if (auth::user()->role ==  '1') {
            return redirect('/admin/dashboard');
    	}elseif (auth::user()->role == '2') {
            return redirect('/admin/dashboard');
        }
        elseif (auth::user()->role == '3') {
            return redirect('/index');
        }
    	else{
    		return 'try again';
        }
    }
    public function adminDashboard()
    {

        //Check permissions
            // return Auth::user()->roles->pluck('name');
            // return Auth()->user()->getDirectPermissions();
            // return Auth()->user()->getPermissionsViaRoles();
            // return Auth()->user()->getAllPermissions();
        //Check roles via user    
            // return User::role('super admin')->get();
        //Check permissions via user    
            // return User::permission('create admin')->get();
        //Remove Permissions
            // Auth()->user()->revokePermissionTo('update admin');    
        // Role::create(['name'=>'technician']);
        // Permission::create(['name'=>'enroll request technician']);
        // Auth()->user()->givePermissionTo('read admin');
        // Auth()->user()->assignRole('super admin');
        // $role = Role::findById(1);
        // $permission = Permission::findById(1);
        // $role->givePermissionTo($permission);

        // $when = Carbon::now()->addSeconds(10);

        //New Users
        $new_users = User::latest('created_at')
        ->take(5)
        ->with('infos')
        ->where('id', '!=', Auth::id())
        ->get();
        return view('admin.dashboard',compact('new_users'));
    }
   
    public function myAccount($id)
    {
        $users = User::where('id',$id)
        ->with('infos')
        ->get();
        $dbs = db_notification::where('user_id',Auth::user()->id)
        ->get();
        $emails = email_notification::where('user_id',Auth::user()->id)
        ->get();
        return view('users.edit_my_profile',compact('users','dbs','emails'));
    }
    public function updateMyAccount(Request $request, $id)
    {
        $store = User::find($id);
        $store->name = $request->first_name;
        $store->email = $request->email;
        $store->save();
        //Second Model
        $store2 = user_info::where('user_id',$id)->first();
        $store2->last_name = $request->last_name;
        $store2->address = $request->address;
        $store2->contact = $request->contact;
        //update avatar
        if($request->file('avatar')){
            $path = $request->file('avatar')->storeAs(
                'public/avatars', time().".".$request->file('avatar')->extension()
            );
    
            $path = str_replace("public", "storage", $path);
            $store2->avatar = $path;
            $store2->save();
            }
            $store2->save();
            session()->flash('message','Congrats! Your profile has been updated successfully');
            return back();
    }
    public function updatePassword(Request $request, $id)
    {
        // dd($request->all());
         $vali = $request->validate([
            'old_password' => 'required',
            'password'     => 'required|min:6|confirmed',
            // 'password_confirmation' => 'required|confirmed',
        ]);
            
        if(!(Hash::check($request->get('old_password'), Auth::user()->password))){
            return back()->with('error','Your current password does not match');
        }
        elseif(strcmp($request->get('old_password'),$request->get('password'))== 0){
            return back()->with('error','Your current & new password can not be the same');
        }
        else{
            $user = Auth::user();
            $user->password = Hash::make($request->get('password'));
            $user->save();
        }
        session()->flash('message','Congrats! Your password has been updated successfully');
        return back();
        
    }
    public function notificationsByUser(Request $request)
    {
        if ($request->has('db_notification')){
            $store = db_notification::where('user_id',Auth::User()->id)
            ->first();
            $store->status = $request->db_notification;
            $store->save();
        }else{
            $store = db_notification::where('user_id',Auth::User()->id)
            ->first();
            $store->status = '0';
            $store->save();
        }
        //Email Notification
        if ($request->has('email_notification')){
            $store = email_notification::where('user_id',Auth::User()->id)
            ->first();
            $store->status = $request->email_notification;
            $store->save();
        }else{
            $store = email_notification::where('user_id',Auth::User()->id)
            ->first();
            $store->status = '0';
            $store->save();
        }
        return back();
        session()->flash('message','Congrats! Your Notification settings has been updated successfully');

    }
   
    public function createUserByAdmin(userRegisterationValidation $request)
    {
        $store = new user();
        $store->name = $request->first_name;
        $store->email = $request->email;
        $pswd = $request->password;
        $store->password = Hash::make($pswd);
        $store->role = $request->role;
        $store->save();
        $user = User::find($store->id);
        if($store->role == '1'){
            $user->assignRole('admin');
        }
        elseif($store->role == '2'){
            $user->assignRole('admin');
        }
        elseif($store->role == '3'){
            $user->assignRole('customer');
        }
        //Second Model
        $user_id = $store->id;
        $store2 = new user_info();
        $store2->user_id = $user_id;
        $store2->last_name = $request->last_name;
        $store2->address = $request->address;
        $store2->contact = $request->contact;

        //update avatar
        if($request->file('avatar')){
            $path = $request->file('avatar')->storeAs(
                'public/avatars', time().".".$request->file('avatar')->extension()
            );
    
            $path = str_replace("public", "storage", $path);
    
            $store2->avatar = $path;
            $store2->save();
        }
            $store2->save();
            $user->notify(new UserCreated($user, $pswd));

            session()->flash('message','User has been created successfully');
            return back();

        
    }
}
