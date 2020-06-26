<?php

namespace App\Http\Controllers;

use App\AdminPanel;
use Illuminate\Http\Request;
use App\User;
use App\Event;
use App\Content;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminPanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Accounts
        $users = User::all()->where('role','member')->count();
        $managers = User::all()->where('role','manager')->count();
        $admins = User::all()->where('role','admin')->count();
        //Accounts

        //Events
            //Events by Manager

                $managers_events = DB::table('events')->join('users','user_id','=','users.id')->get()->where('role','"manager"')->count();
            //Events by Admin
                $admins_events = DB::table('events')->join('users','user_id','=','users.id')->get()->where('role','"admin"')->count();

        //Events

        //Contents
            //Contents by Events by Manager
            $managers_events_contents = DB::table('contents')->join('events','event_id','events.id')->join('users','events.user_id','users.id')->get()->where('role','"manager"')->count();

            //Contents by Events by Admin
            $admins_events_contents = DB::table('contents')->join('events','event_id','events.id')->join('users','events.user_id','users.id')->get()->where('role','"admin"')->count();

        //Contents
        return view('admin.dashboard',compact('users','managers','admins','managers_events','admins_events','managers_events_contents','admins_events_contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdminPanel  $adminPanel
     * @return \Illuminate\Http\Response
     */
    public function show(AdminPanel $adminPanel)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdminPanel  $adminPanel
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminPanel $adminPanel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdminPanel  $adminPanel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdminPanel $adminPanel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdminPanel  $adminPanel
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminPanel $adminPanel)
    {
        //
    }
//*===============For User=============================*//
    public function users()
    {
        $users = User::all()->where('role','=','member');
        return view('admin.lists.users_list',compact('users'));
    }

    public function editusers($id)
    {
        $user = User::findOrFail($id);
        return view('admin.lists.users.edit_user',compact('user'));
    }

    public function updateusers(Request $request, $id)
    {
        $data = $request->validate( [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dob' => 'required',
            'number' => 'required',
            'role' => 'required',
        ]);
         
        $user = User::where('id', '=', $id)->first();

        $password = Hash::make($data['password'])  ; 
        $data['password'] = $password;
        
        if ($request->hasFile('photo')) {
            
            $file = $request->file('photo');

            $extension = $file->getClientOriginalExtension();
            $filename =  $user->name . '.' . $extension;
            
            $path = storage_path('app/public/' . $user->name . '/');

            //unlink($path.$user->photo);        
            $file->move($path, $filename);
        }
           
        $data['photo'] = $filename;
        $user->update($data);

        return redirect('/admin/users/lists');
    }

    public function destroyusers($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/admin/users/lists');
    }
//*===============For User=============================*//

//*===============For Manager=============================*//
public function managers()
{
    $users = User::all()->where('role','=','manager');
    return view('admin.lists.managers_lists',compact('users'));
}

public function editmanagers($id)
{
    $user = User::findOrFail($id);
    return view('admin.lists.managers.edit_manager',compact('user'));
}

public function updatemanagers(Request $request, $id)
{
    $data = $request->validate( [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'dob' => 'required',
        'number' => 'required',
        'role' => 'required',
    ]);
     
    $user = User::where('id', '=', $id)->first();

    $password = Hash::make($data['password'])  ; 
    $data['password'] = $password;
    
    if ($request->hasFile('photo')) {
        
        $file = $request->file('photo');

        $extension = $file->getClientOriginalExtension();
        $filename =  $user->name . '.' . $extension;
        
        $path = storage_path('app/public/' . $user->name . '/');

        //unlink($path.$user->photo);        
        $file->move($path, $filename);
    }
       
    $data['photo'] = $filename;
    $user->update($data);

    return redirect('/admin/managers/lists');
}

public function destroymanagers($id)
{
    $user = User::findOrFail($id);
    $user->delete();
    return redirect('/admin/managers/lists');
}
//*===============For Manager=============================*//

//*===============For Admin=============================*//
public function admins()
{
    $users = User::all()->where('role','=','admin');
    return view('admin.lists.users_list',compact('users'));
}

public function editadmins($id)
{
    $user = User::findOrFail($id);
    return view('admin.lists.users.edit_user',compact('user'));
}

public function updateadmins(Request $request, $id)
{
    $data = $request->validate( [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'dob' => 'required',
        'number' => 'required',
        'role' => 'required',
    ]);
     
    $user = User::where('id', '=', $id)->first();

    $password = Hash::make($data['password'])  ; 
    $data['password'] = $password;
    
    if ($request->hasFile('photo')) {
        
        $file = $request->file('photo');

        $extension = $file->getClientOriginalExtension();
        $filename =  $user->name . '.' . $extension;
        
        $path = storage_path('app/public/' . $user->name . '/');

        //unlink($path.$user->photo);        
        $file->move($path, $filename);
    }
       
    $data['photo'] = $filename;
    $user->update($data);

    return redirect('/admin/users/lists');
}

public function destroyadmins($id)
{
    $user = User::findOrFail($id);
    $user->delete();
    return redirect('/admin/users/lists');
}
//*===============For Admin=============================*//
}
