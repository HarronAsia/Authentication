<?php

namespace App\Http\Controllers;

use App\Content;
use App\Event;
use App\Http\Requests\StoreContent;
use App\Repositories\Content\ContentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ContentController extends Controller
{
    protected $contentRepo;
    public function __construct(ContentRepositoryInterface $contentRepo)
    {
        $this->middleware('auth');
        $this->contentRepo = $contentRepo;
    }

    public function index($id)
    {
    }

    public function create($id)
    {
        $event = $this->contentRepo->editContent($id);

        return view('events.blogs.addcontent',compact('event'));
    }

    public function store(StoreContent $request, $id)
    {
        $event = Event::findOrFail($id);
        $contents = $this->contentRepo->addContent($request,$event->id);
 
        return Redirect::action('EventController@show', $event);
    }

    public function show(Content $content)
    {
        //
    }

    public function edit($id)
    {
        $content = Content::findOrFail($id);
        
        return view('events.blogs.editcontent', compact('content'));
        
    }

    public function update(StoreContent $request,$id)
    {
        $event = Event::findOrFail($id);
        
        $contents = $this->contentRepo->updateContent($request,$event->id);
        
        return Redirect::action('EventController@show', $event);
    }
    
    public function destroy($id)
    {

        $content = Content::findOrFail($id);

        $event = Event::where('id', '=', $content->event_id)->first();
        $content->delete();
        return Redirect::action('EventController@show',$event);
    }
}
