<?php
namespace App\Repositories\User;
use  App\Http\Requests\StoreUser;
interface UserRepositoryInterface
{
    public function showUser($id);

    public function updateUser(StoreUser $request,$id);
    
}