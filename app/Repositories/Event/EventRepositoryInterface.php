<?php
namespace App\Repositories\Event;
use  App\Http\Requests\StoreEvent;
interface EventRepositoryInterface
{

    public function getallEvents();

    public function addEvent();

    public function storeEvent(StoreEvent $request);

    public function updateEvent(StoreEvent $request,$id);

    public function deleteEvent($id);

    
}