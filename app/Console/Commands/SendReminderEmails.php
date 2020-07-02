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
        $reminder_days = date_format(Carbon::now()->subDays(3),"d");

        foreach ($users as $user) {
            foreach ($events as $event) {
                //If user not a member
                if ($user->role != "member") {
                    //If user join id is not null
                    if ($user->join_id != NULL) {
                        //If user join id equal to event id
                        if ($user->join_id == $event->id) {
                            //If now equal to event date - 3(before 3 days)
                            if (Carbon::now() == $reminder_days) {

                                Mail::raw("$event->title", function ($message) use ($user) {
                                    $message->from('xxxxtest123xxxx@gmail.com');
                                    $message->to($user->email)->subject('Friendly Reminder to join your event ');
                                });
                            }
                            //If user join date equal to event date - 3(before 3 days)
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
