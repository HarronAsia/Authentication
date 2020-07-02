<?php

namespace App\Repositories\Event;


use App\Repositories\BaseRepository;
use App\Http\Requests\StoreEvent;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Event;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EventRepository extends BaseRepository implements EventRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Event::class;
    }

    public function getallEvents()
    {

        return $this->model = DB::table('events')->paginate(2);
    }

    public function addEvent()
    {

        return $this->model->all();
    }


    public function confirmAdd(StoreEvent $request)
    {
        $data = $request->validated();

        $this->model = new Event();

        $data['user_id'] = Auth::user()->id;

        if ($request->hasFile('thumbnail')) {

            $this->model->thumbnail = $request->file('thumbnail');

            $extension = $this->model->thumbnail->getClientOriginalExtension();
            $filename = $data['title'] . '.' . $extension;
            $path = storage_path('app/public/event/' . $data['title'] . '/');

            $this->model->thumbnail->move($path, $filename);
        }
        $data['thumbnail'] = $filename;

        Session::put('user_id', $data['user_id']);
        Session::put('title', $data['title']);
        Session::put('detail', $data['detail']);
        Session::put('status', $data['status']);
        Session::put('event_start', $data['event_start']);
        Session::put('event_end', $data['event_end']);
        Session::put('thumbnail', $data['thumbnail']);

        return $this->model = Session::all();
    }


    public function storeEvent()
    {
        $this->model = new Event();

        $this->model->user_id = Session::get('user_id');
        $this->model->title = Session::get('title');
        $this->model->detail = Session::get('detail');
        $this->model->status = Session::get('status');
        $this->model->event_start = Session::get('event_start');
        $this->model->event_end  = Session::get('event_end');
        $this->model->thumbnail  = Session::get('thumbnail');

        return $this->model->save();
    }

    public function confirmUpdate(StoreEvent $request, $id)
    {
        
        $data = $request->validated();

        $this->model = Event::findOrFail($id);
        
        $data['id'] =    $this->model->id;
        
        $data['user_id'] =   $this->model->user_id;

        Session::put('id', $data['id']);
        Session::put('user_id', $data['user_id']);
        Session::put('title', $data['title']);
        Session::put('detail', $data['detail']);
        Session::put('status', $data['status']);
        Session::put('event_start', $data['event_start']);
        Session::put('event_end', $data['event_end']);

        $old_thumbnail = $this->model->thumbnail;
        
        if ($request->hasFile('thumbnail')) {

            $this->model->thumbnail = $request->file('thumbnail');
            
            $extension = $this->model->thumbnail->getClientOriginalExtension();
            $filename =  Session::get('title') . '.' . $extension;
            
            $path = storage_path('app/public/event/' . Session::get('title') . '/');
            
            if (!file_exists($path . $filename)) {
                
                $data['thumbnail']->move($path, $filename);
                
            } else if (!file_exists($path . $old_thumbnail)) {

                $data['thumbnail']->move($path, $filename);
             
            } else {

                unlink($path . $old_thumbnail);
                $data['thumbnail']->move($path, $filename);
               
            }
        }
        $data['thumbnail'] = $filename;
        Session::put('thumbnail', $data['thumbnail']);

        return $this->model = Session::all();
    }

    public function updateEvent($id)
    {
        $this->model = Event::findOrFail($id);

       $this->model->user_id = Session::get('user_id');
       $this->model->title = Session::get('title');
       $this->model->detail = Session::get('detail');
       $this->model->status = Session::get('status');
       $this->model->event_start = Session::get('event_start');
       $this->model->event_end  = Session::get('event_end');
       $this->model->thumbnail  = Session::get('thumbnail');
        
        return $this->model->update();
    }

    

    public function deleteEvent($id)
    {
        $this->model = Event::findOrFail($id);
        return $this->model->delete();
    }

    public function get_join_user($id)
    {
        return $this->model = User::get()->where('join_id', '==', $id);
    }

    public function showEvent($id)
    {
        return $this->model = Event::findOrFail($id);
    }

    public function update_participant($id)
    {
        $user = User::findOrFail(Auth::user()->id);
        return $this->model = DB::table('users')->where('id', $user->id)->update(['join_id' => $id, 'join_date' => Carbon::now()]);
    }

    public function allEvents()
    {
        return $this->model = DB::table('events')->join('users', 'user_id', 'users.id')->get()->where('role', '!=', 'member');
    }

    public function count_users($id)
    {

        return $numbers = DB::table('users')->get()->where('join_id', '=', $id)->count();

        $this->model = DB::table('events')->where('id', '=', $id)->update(['count_id' => $numbers]);
    }
}
