<?php
namespace App\Repositories\Event;
use  App\Http\Requests\StoreEvent;
interface EventRepositoryInterface
{

    public function getallEvents();

    public function addEvent();

    public function storeEvent(StoreEvent $request);

    public function showEvent($id);

    public function updateEvent(StoreEvent $request,$id);

    public function deleteEvent($id);

    public function get_join_user($id);
    
    public function update_participant($id);

    public function allEvents();

    public function count_users($id);

}