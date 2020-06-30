<?php

namespace App\Http\Controllers;

use App\User;
use App\Content;
use App\Event;
use App\Http\Requests\StoreEvent;
use App\Repositories\Event\EventRepositoryInterface;

use Illuminate\Support\Facades\DB;


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

    public function store(StoreEvent $request)
    {
        $this->eventRepo->storeEvent($request);
        
        return redirect('/');
    }

    public function show($id)
    { 
        $event = Event::findOrFail($id);

        $user = User::findOrFail($event->user_id);
        
        $contents = Content::get()->where('event_id','=',$event->id);

        return view('events.blogs.index',compact('event','user','contents'));
    }

    public function edit($id)
    {
        $event = $this->eventRepo->showEvent($id);
        
        return view('events.edit',compact('event'));
    }

    public function update(StoreEvent $request, $id)
    {
        $this->eventRepo->updateEvent( $request, $id);
        
        return redirect('/');
    }

    public function destroy($id)
    {
        $this->eventRepo->deleteEvent($id);
        return redirect('/');
    }


    public function join($id)
    {
        $event = Event::findOrFail($id);
        //dd( $event);
        $users = User::get()->where('join_id','==',$event->id);
        
        
        return view('events.join_event',compact('users','event'));
    }

    public function after_join($id)
    {
       
        $event =  Event::findOrFail($id);
        //dd($event);
        $users = User::get()->where('join_id','==',$event->id);
        
        $participant = DB::table('users')->where('id',$id)->update(['join_id' => $event->id]);
        return view('events.join_event',compact('users','event'));
    }
}
