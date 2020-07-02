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

        return view('events.blogs.addcontent', compact('event'));
    }

    //Confirm Add Event---------------------------------------------------------------
    public function confirmadd(StoreContent $request, $id)
    {
        $event = Event::findOrFail($id);
        $content = $this->contentRepo->confirmadd($request, $event->id);
        return view('confirms.content.confirm_add_content', compact('content','event'));
    }
    //Confirm Add Event-------------------------------------------------------------

    public function store($id)
    {
        $event = Event::findOrFail($id);
        
        $this->contentRepo->addContent();

        return  Redirect::action('EventController@show', $event);
    }

    public function show(Content $content)
    {
        //
    }

    public function edit($id)
    {
        
        $content = Content::findOrFail($id);
        $event = Event::findOrFail($content->event_id);
        
        return view('events.blogs.editcontent', compact( 'content','event'));
    }

    //Confirm Add Event---------------------------------------------------------------
    public function confirmupdate(StoreContent $request, $id)
    {
        $value = Content::findOrFail($id);
       
        $event = Event::findOrFail($value->event_id);
        
        $content = $this->contentRepo->confirmupdate($request, $value->id);
       
        return view('confirms.content.confirm_edit_content', compact('content','event'));
    }
    //Confirm Add Event-------------------------------------------------------------

    public function update( $id)
    {
        $value = Content::findOrFail($id);
        
        $event = Event::findOrFail($value->event_id);
        
        $this->contentRepo->updateContent($value->id);

        return Redirect::action('EventController@show', $event);
    }

    public function destroy($id)
    {

        $content = Content::findOrFail($id);

        $event = Event::where('id', '=', $content->event_id)->first();
        $content->delete();
        return Redirect::action('EventController@show', $event);
    }
}
