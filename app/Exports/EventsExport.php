<?php

namespace App\Exports;

use App\Event;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EventsExport implements FromView
{
 
    public function view(): View
    {
        return view('admin.export.events.events_excel',
        [
            'events' => Event::all()
        ]);
    }
}
