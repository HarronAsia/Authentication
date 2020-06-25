<?php

namespace App\Http\Controllers;

use App\Content;
use App\Event;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ContentController extends Controller
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
    public function index($id)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $event = Event::where('id', '=', $id)->first();
        return view('events.blogs.addcontent',compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        $data = $request->validate([
            'sub_title' => 'required',
            'sub_detail' => 'required',
            'sub_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $event = Event::where('id', '=', $id)->first();

        $data['event_id'] = $event->id;


        $contents = new Content();
        $contents->event_id =   $data['event_id'];

        $contents->sub_title = $data['sub_title'];

        $contents->sub_detail = $data['sub_detail'];

        if ($request->hasFile('sub_photo')) {

            $contents->sub_photo = $request->file('sub_photo');

            $extension =  $contents->sub_photo->getClientOriginalExtension();

            $filename =  $contents->sub_title . '.' . $extension;

            $path = storage_path('app/public/event/' . $event->title . '/content' . '/' . $contents->sub_title . '/');


            $contents->sub_photo->move($path, $filename);
        }
        $data = $request->except(['sub_photo']);

        $data['sub_photo'] = $filename;
        $contents->sub_photo = $data['sub_photo'];

        //dd( $data);
        $contents->save();

        return Redirect::action('EventController@show', $event);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $content = Content::findOrFail($id);
        
        return view('events.blogs.editcontent', compact('content'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data = $request->validate([
            'sub_title' => 'required',
            'sub_detail' => 'required',
            'sub_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
    
        $content = Content::where('id', '=', $id)->first(); 
        $event = Event::where('id', '=', $content->event_id)->first();
        
        $old_photo = $content->sub_photo;
        
        if ($request->hasFile('sub_photo')) {

            $content->sub_photo = $request->file('sub_photo');
            
            $extension =  $content->sub_photo->getClientOriginalExtension();

            $filename =  $content->sub_title . '.' . $extension;

            $path = storage_path('app/public/event/' . $event->title . '/content' . '/' . $content->sub_title . '/');
  
            if (!file_exists($path.$old_photo)) {

                $content->sub_photo->move($path, $filename);
            } else {

                unlink($path . $old_photo);
                $content->sub_photo->move($path, $filename);
            }
        }

        $data['sub_photo'] = $filename;

        $content->update($data);

        return Redirect::action('EventController@show', $event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $content = Content::findOrFail($id);

        $event = Event::where('id', '=', $content->event_id)->first();
        $content->delete();
        return Redirect::action('EventController@show',$event);
    }
}
