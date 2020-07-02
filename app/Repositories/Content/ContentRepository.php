<?php

namespace App\Repositories\Content;

use App\Repositories\BaseRepository;
use App\Http\Requests\StoreContent;

use App\Content;
use App\Event;
use Illuminate\Support\Facades\Session;

class ContentRepository extends BaseRepository implements ContentRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Content::class;
    }

    public function editContent($id)
    {

        return $this->model = Event::findOrFail($id);
    }

    public function confirmadd(StoreContent $request, $id)
    {
        $data = $request->validated();

        $event = Event::where('id', '=', $id)->first();

        $data['event_id'] = $event->id;


        $this->model = new Content();

        Session::put('event_id', $data['event_id']);
        Session::put('sub_title', $data['sub_title']);
        Session::put('sub_detail', $data['sub_detail']);



        if ($request->hasFile('sub_photo')) {

            $this->model->sub_photo = $request->file('sub_photo');

            $extension =  $this->model->sub_photo->getClientOriginalExtension();

            $filename =  Session::get('sub_title') . '.' . $extension;

            $path = storage_path('app/public/event/' . $event->title . '/content' . '/' . Session::get('sub_title') . '/');


            $this->model->sub_photo->move($path, $filename);
        }

        $data['sub_photo'] = $filename;

        Session::put('sub_photo', $data['sub_photo']);

        return $this->model = Session::all();
    }

    public function addContent()
    {
        
        $this->model = new Content();

        $this->model->event_id = Session::get('event_id');
        $this->model->sub_title = Session::get('sub_title');
        $this->model->sub_detail = Session::get('sub_detail');
        $this->model->sub_photo = Session::get('sub_photo');

        return $this->model->save();
 
    }

    public function confirmupdate(StoreContent $request, $id)
    {
        $data = $request->validated();
        
        $this->model = Content::where('id', '=', $id)->first();
        
        $event = Event::findOrFail( $this->model->event_id);
        
        $data['event_id'] = $event->id;
        Session::put('id', $this->model->id);
        Session::put('event_id', $data['event_id']);
        Session::put('sub_title', $data['sub_title']);
        Session::put('sub_detail', $data['sub_detail']);

        $old_photo = $this->model->sub_photo;

        if ($request->hasFile('sub_photo')) {

            $this->model->sub_photo = $request->file('sub_photo');

            $extension =  $this->model->sub_photo->getClientOriginalExtension();

            $filename = $data['sub_title'] . '.' . $extension;

            $path = storage_path('app/public/event/' . $event->title . '/content' . '/' . $data['sub_title'] . '/');

            if (!file_exists($path . $old_photo)) {

                $this->model->sub_photo->move($path, $filename);
            } else {

                unlink($path . $old_photo);
                $this->model->sub_photo->move($path, $filename);
            }
        }

        $data['sub_photo'] = $filename;

        Session::put('sub_photo', $data['sub_photo']);
        
        return $this->model = Session::all();
    }

    public function updateContent($id)
    {
        $this->model = Content::findOrFail($id);
        
       $this->model->event_id = Session::get('event_id');
       $this->model->sub_title = Session::get('sub_title');
       $this->model->sub_detail = Session::get('sub_detail');
       $this->model->sub_photo = Session::get('sub_photo');
        
        return $this->model->update();
    }
}
