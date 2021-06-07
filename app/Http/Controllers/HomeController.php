<?php

namespace App\Http\Controllers;

use Auth;
use App\user;
use App\Prefix;
use App\user_info;
use Illuminate\Http\Request;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
   
    public function registerationByAdmin()
    {
        return view('users.registeration');
    }
    public function usersList()
    {
        $views= user::where('role','!=','1')
        ->with('infos')
        ->get();
        return view('admin.users',compact('views'));
    }
    public function editUserByAdmin($id)
    {
        $edits = user::where('id',$id)->with('infos')->get();
        return view('users.edit_user',compact('edits'));
    }
    public function updateUserByAdmin(Request $request,$id)
    {
        $store = User::find($id);
        $store->name = $request->first_name;
        $store->email = $request->email;
        $store->role = $request->role;
        $store->save();
        //Updating Spatie Role
        if($request->role == '2')
            $store->syncRoles(['admin']);
        elseif($request->role == '3')
            $store->syncRoles(['customer']);
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
            session()->flash('message','User has been updated successfully');
            return back();
        }
        public function deleteUserByAdmin(Request $request)
        {
            $user = User::find($request->dell_id);

            $dell = User::find($request->dell_id);
            $dell->delete();
            $dell = User_info::where('user_id',$request->dell_id);
            $dell->delete();
            $user->prefix()->delete();
            session()->flash('delete','User has been deleted successfully');
            return back();
        }
        public function addPrefixByAdmin($id)
        {
            $user = User::where('id', $id)
            ->with('prefix')
            ->first();
            return view('prefix.index',["user" => $user]);
        }
        public function attachPrefix(Request $request)
        {
            $prefix = Prefix::create([
                'user_id' =>  $request->user_id,
                'prefix' =>  $request->prefix,
            ]);
            return redirect()->back()->with('success', 'Prefix has been attached.');
        }
        public function updatePrefix(Request $request,Prefix $prefix)
        {
            // update record
            $prefix->prefix = $request->prefix;
            $prefix->save();
            return redirect()->back()->with('success', 'Prefix has been updated successfully.');
        }

}
