<?php
namespace App\Repositories\Admin;

use App\Repositories\BaseRepository;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreAdmin;

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
         return $this->model->users = User::all()->where('role','member')->count();
            
    }

    public function countAllManagers()
    {
        return $this->model->managers = User::all()->where('role','manager')->count();
    }

    public function countAllAdmins()
    {
        return $this->model->admins = User::all()->where('role','admin')->count();
    }

    public function countAllEventsByManager()
    {
        return $this->model->managers_events = DB::table('events')->join('users','user_id','=','users.id')->get()->where('role','"manager"')->count();
    }
    public function countAllEventsByAdmin()
    {
        return $this->model->admins_events = DB::table('events')->join('users','user_id','=','users.id')->get()->where('role','"admin"')->count();
    }
    public function countallContentByEventByManager()
    {
        return $this->model->managers_events_contents = DB::table('contents')->join('events','event_id','events.id')->join('users','events.user_id','users.id')->get()->where('role','"manager"')->count();
    }
    public function countallContentByEventByAdmin()
    {
        return $this->model->admins_events_contents = DB::table('contents')->join('events','event_id','events.id')->join('users','events.user_id','users.id')->get()->where('role','"admin"')->count();
    }
    //*===============Count =============================*//


    //*===============For User=============================*//
    public function getAllUsers()
    {
        return $this->model = User::all()->where('role','=','member');
    }

    //*===============For User=============================*//


    //*===============For Manager=============================*//
    public function getAllManagers()
    {
        return $users = User::all()->where('role','=','manager');
    }

    //*===============For Manager=============================*//


    //*===============For ADmin=============================*//
    public function getAllAdmins()
    {
        return $users = User::all()->where('role','=','admin');
    }

    //*===============For Admin=============================*//


    //*===============Main Edit=============================*//

    public function editforAdmin(StoreAdmin $request, $id)
    {
        $data = $request->validated();
             
            $this->model = User::where('id', '=', $id)->first();
    
            $password = Hash::make($data['password'])  ; 
            $data['password'] = $password;
            
            if ($request->hasFile('photo')) {
                
                $file = $request->file('photo');
    
                $extension = $file->getClientOriginalExtension();
                $filename =  $data['name'] . '.' . $extension;
                
                $path = storage_path('app/public/' . $data['name'] . '/');
    
                //unlink($path.$user->photo);        
                $file->move($path, $filename);
            }
               
            $data['photo'] = $filename;
            return $this->model->update($data);
    }

    //*===============Main Edit=============================*//

}
