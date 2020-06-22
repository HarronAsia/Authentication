<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('profiles.profile')->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
<<<<<<< HEAD
        $this->validate($request, [
            'name' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);

        $user = User::where('id', '=', $id)->first();
        $old_photo = $user->photo;

        if($request->hasFile('photo'))
        {
            
            $file = $request->file('photo');
            
            $extension = $file->getClientOriginalExtension();
            $filename =  $user->name. '.' . $extension;
            //$path = public_path('img/uploaded/'.$user->name.'/');
            $path = storage_path('app/public/'.$user->name.'/');
            
            if( !file_exists($path.$old_photo))
            {
                $file->move($path,$filename);
            }
            else
            {
                unlink($path.$old_photo);
                 $file->move($path,$filename);
            }
            
        }
        $data = $request->except(['photo']);
        
        $data['photo'] = $filename;
        
        $user->update( $data);
        
        return view('profiles.profile', compact('user'));
    
=======
        //
>>>>>>> parent of bf9220a... new project
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
