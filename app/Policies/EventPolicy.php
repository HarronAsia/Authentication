<?php

namespace App\Policies;

use App\Event;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class EventPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // public function viewAny(User $user)
    // {
    //     return true;
    // }

    // public function view(User $user, Event $event)
    // {
    //     return $user->id == $event->user_id;
    // }

    public function update(User $user, Event $event)
    {
        
        return $user->id === $event->user_id
                    ? Response::allow()
                    : Response::deny('You are not authorize ! ! !');
    }

    public function delete(User $user, Event $event)
    {
        
        return $user->id === $event->user_id
                    ? Response::allow()
                    : Response::deny('You are not authorize ! ! !');
    }
}
