<?php

namespace App\Repositories\Admin;

use App\Repositories\BaseRepository;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreAdmin;
use Illuminate\Support\Facades\Session;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\AdminPanel::class;
    }

    //*===============Count=============================*//
    public function countAllUsers()
    {
        return $this->model->users = User::all()->where('role', 'member')->count();
    }

    public function countAllManagers()
    {
        return $this->model->managers = User::all()->where('role', 'manager')->count();
    }

    public function countAllAdmins()
    {
        return $this->model->admins = User::all()->where('role', 'admin')->count();
    }

    public function countAllEventsByManager()
    {
        return $this->model->managers_events = DB::table('events')->join('users', 'user_id', '=', 'users.id')->get()->where('role', '"manager"')->count();
    }
    public function countAllEventsByAdmin()
    {
        return $this->model->admins_events = DB::table('events')->join('users', 'user_id', '=', 'users.id')->get()->where('role', '"admin"')->count();
    }
    public function countallContentByEventByManager()
    {
        return $this->model->managers_events_contents = DB::table('contents')->join('events', 'event_id', 'events.id')->join('users', 'events.user_id', 'users.id')->get()->where('role', '"manager"')->count();
    }
    public function countallContentByEventByAdmin()
    {
        return $this->model->admins_events_contents = DB::table('contents')->join('events', 'event_id', 'events.id')->join('users', 'events.user_id', 'users.id')->get()->where('role', '"admin"')->count();
    }
    //*===============Count =============================*//


    //*===============For User=============================*//
    public function getAllUsers()
    {
        return $this->model = User::all()->where('role', '=', 'member');
    }

    //*===============For User=============================*//


    //*===============For Manager=============================*//
    public function getAllManagers()
    {
        return $users = User::all()->where('role', '=', 'manager');
    }

    //*===============For Manager=============================*//


    //*===============For ADmin=============================*//
    public function getAllAdmins()
    {
        return $users = User::all()->where('role', '=', 'admin');
    }

    //*===============For Admin=============================*//


    //*===============Main Edit=============================*//

    public function confirmAdmin(StoreAdmin $request, $id)
    {
        $data = $request->validated();
        //dd($data);
        $this->model = User::findOrFail($id);
        
        Session::put('id', $this->model->id);
        Session::put('name', $data['name']);
        Session::put('email',  $data['email']);
        Session::put('password',  $data['password']);
        Session::put('role',  $data['role']);
        Session::put('dob', $data['dob']);
        Session::put('number', $data['number']);
        Session::put('created_at', $this->model->created_at);
        Session::put('updated_at', $this->model->updated_at);

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');

            $extension = $file->getClientOriginalExtension();
            $filename =  Session::get('name') . '.' . $extension;

            $path = storage_path('app/public/' . Session::get('name') . '/');

            $file->move($path, $filename);
        }
        $data['photo'] = $filename;
        Session::put('photo', $data['photo']);
        //dd($this->model = Session::all());
        return $this->model = Session::all();
    }

    //*===============Main Edit=============================*//

    public function editforAdmin($id)
    {
        $this->model = User::findOrFail($id);
        dd($this->model);
        $this->model->id = Session::get('id');
        $this->model->name = Session::get('name');
        $this->model->email = Session::get('email');
        $this->model->password = Session::get('password');
        $this->model->dob = Session::get('dob');
        $this->model->photo = Session::get('photo');
        $this->model->number = Session::get('number');
        $this->model->created_at = Session::get('created_at');
        $this->model->updated_at = Session::get('updated_at');


        return $this->model->update();
    }
}
