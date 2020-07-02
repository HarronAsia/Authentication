<?php

namespace App\Http\Controllers;

use App\User;
use App\Content;
use App\Event;
use App\Http\Requests\StoreEvent;
use App\Repositories\Event\EventRepositoryInterface;
use App\Exports\EventsExport;
use App\Imports\EventsImport;
use Excel ;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $eventRepo;

    public function __construct(EventRepositoryInterface $eventRepo)
    {
        $this->eventRepo = $eventRepo;
    }

    public function index()
    {

       $events = $this->eventRepo->getallEvents();
        return view('home',compact('events'));
    }

    public function create()
    {
      
        $events = $this->eventRepo->addEvent();
     
        return view('events.add_event', compact('events'));
    }

    //Confirm Add Event---------------------------------------------------------------
    public function confirmadd(StoreEvent $request)
    {
        
       $event = $this->eventRepo->confirmadd($request);
        
        return view('confirms.event.confirm_add_event',compact('event'));
    }
    //Confirm Add Event-------------------------------------------------------------

    public function store()
    {
        
        $this->eventRepo->storeEvent();
        
        return redirect('/');
    }

    public function edit($id)
    {
        $event = $this->eventRepo->showEvent($id);
        
        return view('events.edit',compact('event'));
    }

    public function confirmupdate(StoreEvent $request,$id)
    {
         $value = Event::findOrFail($id);
        
         $event = $this->eventRepo->confirmUpdate($request,$value->id);
        
        return view('confirms.event.confirm_edit_event',compact('event'));
    }

    public function update($id)
    {
        $event = Event::findOrFail($id);
        $this->eventRepo->updateEvent($event->id);
        
        return redirect('/');
    }

   

    public function show($id)
    { 
        $event = Event::findOrFail($id);

        $user = User::findOrFail($event->user_id);
        
        $contents = Content::get()->where('event_id','=',$event->id);

        return view('events.blogs.index',compact('event','user','contents'));
    }

    

    public function destroy($id)
    {
        $this->eventRepo->deleteEvent($id);
        return redirect('/');
    }


    public function join($id)
    {
        $event = Event::findOrFail($id);
        
        $users =  $this->eventRepo->get_join_user($event->id);;
        $numbers = $this->eventRepo->count_users($event->id);
        
        return view('events.join_event',compact('users','event','numbers'));
    }
    

    public function after_join($id)
    {
      
        $event =  Event::findOrFail($id);
        $users =  $this->eventRepo->get_join_user($event->id);;
        $numbers = $this->eventRepo->count_users($event->id);
        
        $participant =$this->eventRepo->update_participant($event->id);

        return view('events.join_event',compact('users','event','numbers'));
    }

    public function all()
    {
        $events = $this->eventRepo->allEvents();
        return view('admin.export.events.export_events',compact('events'));
    }

    public function export() 
    {
        return Excel::download(new EventsExport, 'events_list.csv');
    }

    public function import(Request $request)
    {
        
        $file = $request->file('excel');
        Excel::import(new EventsImport,$file);

    }

}
