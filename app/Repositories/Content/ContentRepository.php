<?php
namespace App\Repositories\Content;

use App\Repositories\BaseRepository;
use App\Http\Requests\StoreContent;

use App\Content;
use App\Event;


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

    public function addContent(StoreContent $request, $id)
    {
            $data = $request->validated();
            
            $event = Event::where('id', '=', $id)->first();
            
            $data['event_id'] = $event->id;
            
    
            $this->model = new Content();
            
            $this->model->event_id =   $data['event_id'];
            
            $this->model->sub_title = $data['sub_title'];
    
            $this->model->sub_detail = $data['sub_detail'];
            
            if ($request->hasFile('sub_photo')) {
    
                $this->model->sub_photo = $request->file('sub_photo');
    
                $extension =  $this->model->sub_photo->getClientOriginalExtension();
    
                $filename =  $this->model->sub_title . '.' . $extension;
    
                $path = storage_path('app/public/event/' . $event->title . '/content' . '/' . $this->model->sub_title . '/');
    
    
                $this->model->sub_photo->move($path, $filename);
            }
    
            $data['sub_photo'] = $filename;
            $this->model->sub_photo = $data['sub_photo'];
            
            return $this->model->save();
    }

    public function updateContent(StoreContent $request, $id)
    {
        $data = $request->validated();
        
        $this->model = Content::where('id', '=', $id)->first(); 
        
        $event = Event::where('id', '=', $this->model->event_id)->first();
        
        $old_photo = $this->model->sub_photo;
        
        if ($request->hasFile('sub_photo')) {

            $this->model->sub_photo = $request->file('sub_photo');
            
            $extension =  $this->model->sub_photo->getClientOriginalExtension();
            
            $filename = $data['sub_title'] . '.' . $extension;
            
            $path = storage_path('app/public/event/' . $event->title . '/content' . '/' . $data['sub_title'] . '/');
            
            if (!file_exists($path.$old_photo)) {

                $this->model->sub_photo->move($path, $filename);
            } else {

                unlink($path . $old_photo);
                $this->model->sub_photo->move($path, $filename);
            }
        }

        $data['sub_photo'] = $filename;

        return $this->model->update($data);

        
    }
    
    
}