<?php

namespace App\Console\Commands;

use App\User;
use App\Event;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email notification to user about reminders. ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle()
    {

        $users = User::all();
        $events = Event::all();
        
        foreach ($users as $user) {
            foreach ($events as $event) {
                
                //If user not a member
                if ($user->role != "member") {
                    //If user join id is not null
                    if ($user->join_id != NULL) {
                        //If user join id equal to event id
                        if ($user->join_id == $event->id) {
                            
                            $subj = 'Friendly Reminder to join your event which is '.$event->title.' And i should remind you that the event will start at '.$event->event_start;
                            Mail::raw("Friendly Reminder", function ($message) use ($user, $subj) {
                                $message->from('xxxxtest123xxxx@gmail.com');
                                $message->to($user->email)->subject($subj);
                            });

                        }
                        //If user join id equal to event id
                    }
                    //else user id is null
                    else {
                        Mail::raw("Event Reminder", function ($message) use ($user) {
                            $message->from('xxxxtest123xxxx@gmail.com');
                            $message->to($user->email)->subject('You should join some event!');
                        });
                    }
                    //If user join id is not null
                }
                //If user not a member
            }
        }

        $this->info('Successfully Sent !!');
    }
}
