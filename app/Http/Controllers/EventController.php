<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;


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

        return view('home')->with('events', $events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.add_event');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'detail' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $events = new Event();

        $events->title = $request->input('title');

        if ($request->hasFile('photo')) {

            $events->photo = $request->file('photo');
            $extension =  $events->photo->getClientOriginalExtension();

            $filename =  $events->title . '.' . $extension;

            $path = storage_path('app/public/event/' . $events->title . '/');


            $events->photo->move($path, $filename);
        }
        $data = $request->except(['photo']);

        $data['photo'] = $filename;
        //dd( $data);
        $events->create($data);
        //dd($events->save( $data));
        return redirect('/home');
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
        return view('events.blogs.index')->with('event', $event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $events
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $events)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $events
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $events)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $events
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $events)
    {
        //
    }
}
