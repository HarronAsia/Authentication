<?php
namespace App\Repositories\Event;
use  App\Http\Requests\StoreEvent;
interface EventRepositoryInterface
{

    public function getallEvents();

    public function addEvent();

    public function confirmAdd(StoreEvent $request);

    public function storeEvent();

    public function showEvent($id);

    public function confirmUpdate(StoreEvent $request,$id);

    public function updateEvent($id);

    public function deleteEvent($id);

    public function get_join_user($id);
    
    public function update_participant($id);

    public function allEvents();

    public function count_users($id);

}