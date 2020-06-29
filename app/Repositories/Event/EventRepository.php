<?php
namespace App\Repositories\Event;

use App\Repositories\BaseRepository;
use App\Http\Requests\StoreEvent;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Event;


class EventRepository extends BaseRepository implements EventRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Event::class;
    }

    public function getallEvents()
    {

        return $this->model->select('*')->get();

    }

    public function addEvent()
    {

        return $this->model->all();

    }

    public function storeEvent(StoreEvent  $request)
    {
        $data = $request->validated();
        
        $data['user_id'] = Auth::user()->id;
        
        $this->model = new Event();
        $this->model->user_id =   $data['user_id'];

        $this->model->title = $data['title'];
        $this->model->detail = $data['detail'];
        $this->model->status = $data['status'];
        
        if ($request->hasFile('thumbnail')) {
            
            $this->model->thumbnail = $request->file('thumbnail');
            
            $extension =  $this->model->thumbnail->getClientOriginalExtension();

            $filename = $this->model->title . '.' . $extension;

            $path = storage_path('app/public/event/' . $this->model->title . '/');


            $this->model->thumbnail->move($path, $filename);
        }
        $data = $request->except(['thumbnail']);

        $data['thumbnail'] = $filename;
        $this->model->thumbnail = $data['thumbnail'];

        return $this->model->save();

    }

    public function updateEvent(StoreEvent  $request,$id)
    {
        
        $data = $request->validated();
       
        $this->model = Event::where('id', '=', $id)->first(); 
        
        $user = User::where('id', '=', $this->model->user_id)->first();
        
        $data['user_id'] =   $user->id;
        
        $old_thumbnail = $this->model->thumbnail;
        
        if( $request->hasFile('thumbnail'))
        {
           
            $data['thumbnail'] = $request->file('thumbnail');
           
            $extension =  $data['thumbnail']->getClientOriginalExtension();
            $filename =   $data['title']. '.' . $extension;
            
            $path = storage_path('app/public/event/'.  $data['title'].'/');

            if( !file_exists($path.$old_thumbnail))
            {
                
                $data['thumbnail']->move($path,$filename);
                
            }
            else
            {
                
                unlink($path.$old_thumbnail);
                $data['thumbnail']->move($path,$filename);
            }
            
        }

        $data['thumbnail'] = $filename;
        
        return $this->model->update( $data);
    }

    public function deleteEvent($id)
    {
        $this->model = Event::findOrFail($id);
        $this->model->delete();
    }
}