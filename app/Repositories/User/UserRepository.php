<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Http\Requests\StoreUser;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\User::class;
    }

    public function showUser($id)
    {

        return $this->model = User::findOrFail($id);
    }

    public function confirmUsers(StoreUser $request, $id)
    {
        
        $data = $request->validated();
        
        $this->model = User::findOrFail($id);

        Session::put('name', $data['name']);
        Session::put('email', $this->model->email);
        Session::put('password', $this->model->password);
        Session::put('dob', $data['dob']);
        Session::put('number', $data['number']);

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');

            $extension = $file->getClientOriginalExtension();
            $filename =  Session::get('name') . '.' . $extension;

            $path = storage_path('app/public/' . Session::get('name') . '/');

            $file->move($path, $filename);
        }
        $data['photo'] = $filename;
        Session::put('photo', $data['photo']);

        return $this->model = Session::all();
    }

    public function updateUser( $id)
    {

        $this->model = User::findOrFail($id);

       $this->model->name = Session::get('name');
       $this->model->email = Session::get('email');
       $this->model->password = Session::get('password');
       $this->model->dob = Session::get('dob');
       $this->model->photo = Session::get('photo');
       $this->model->number = Session::get('number');
     
        
        return $this->model->update();
    }

    public function allUsers()
    {
        return $this->model = DB::table('users')->get();
    }
}
