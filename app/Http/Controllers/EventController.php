<?php

namespace App\Http\Controllers;

use App\Content;
use App\User;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $events = Event::all();
 
        return view('home',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $events = Event::all();
        return view('events.add_event', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = $request->validate( [
            'title' => 'required',
            'detail' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);
        
        $data['user_id'] = Auth::user()->id;
        $events = new Event();
        $events->user_id =   $data['user_id'];

        $events->title = $data['title'];
        $events->detail = $data['detail'];
        $events->status = $data['status'];
        if ($request->hasFile('thumbnail')) {
            
            $events->thumbnail = $request->file('thumbnail');
            
            $extension =  $events->thumbnail->getClientOriginalExtension();

            $filename =  $events->title . '.' . $extension;

            $path = storage_path('app/public/event/' . $events->title . '/');


            $events->thumbnail->move($path, $filename);
        }
        $data = $request->except(['thumbnail']);

        $data['thumbnail'] = $filename;
        $events->thumbnail = $data['thumbnail'];

        $events->save();

        //dd($events->save( $data));
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $events
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        $event = Event::findOrFail($id);
        $user = User::findOrFail( $event->user_id);

        //$user = User::all()->where('id','=',$event->user_id);
    
        $contents = Content::get()->where('event_id',$event->id);
      
        return view('events.blogs.index',compact('event','user','contents'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $events
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $events = Event::findOrFail($id);
        return view('events.edit')->with('event', $events);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $events
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required',
            'detail' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        $events = Event::where('id', '=', $id)->first(); 
        $user = User::where('id', '=', $events->user_id)->first();

        $data['user_id'] =  $user->id;
        $old_thumbnail = $events->thumbnail;
        if($request->hasFile('thumbnail'))
        {
            
            $events->thumbnail = $request->file('thumbnail');
            
            $extension = $events->thumbnail->getClientOriginalExtension();
            $filename =  $events->title. '.' . $extension;
            
            $path = storage_path('app/public/event/'.$events->title.'/');
            
            if( !file_exists($path.$old_thumbnail))
            {
                
                $events->thumbnail->move($path,$filename);
            }
            else
            {
                
                unlink($path.$old_thumbnail);
                $events->thumbnail->move($path,$filename);
            }
            
        }

        $data['thumbnail'] = $filename;
        
        $events->update($data);
        
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $events
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $events = Event::findOrFail($id);
        $events->delete();
        return redirect('/');
    }

    public function join($id)
    {
        $users = User::all();
        $event = Event::findOrFail($id);
        return view('events.join_event',compact('users','event'));
    }
}
