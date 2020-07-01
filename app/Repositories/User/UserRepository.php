<?php
namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Http\Requests\StoreUser;

use App\User;
use Illuminate\Support\Facades\DB;


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

    public function updateUser(StoreUser $request,$id)
    {

        $data = $request->validated();
        $this->model = User::where('id', '=', $id)->first();
        $old_photo = $this->model->photo;

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');

            $extension = $file->getClientOriginalExtension();
            $filename = $data['name'] . '.' . $extension;
            $path = storage_path('app/public/' . $data['name'] . '/');
            
            if (file_exists($path . $old_photo)) {
                
                $file->move($path, $filename);
            } else {
                unlink($path . $old_photo);
                $file->move($path, $filename);
            }
        }
        
        $data = $request->except(['photo']);
        $data['photo'] = $filename;
        
        return $this->model->update($data);

    }

    public function allUsers()
    {
        return $this->model = DB::table('users')->get();
    }
}