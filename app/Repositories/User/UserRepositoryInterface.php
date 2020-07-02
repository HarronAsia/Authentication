<?php
namespace App\Repositories\User;
use  App\Http\Requests\StoreUser;
interface UserRepositoryInterface
{
    public function showUser($id);

    public function confirmUsers(StoreUser $request,$id);
    
    public function updateUser($id);
    
    public function allUsers();
}