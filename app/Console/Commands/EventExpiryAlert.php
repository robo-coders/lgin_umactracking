<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Carbon\Carbon;
use App\ticket;
use App\event;
class EventExpiryAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:event-expiry-alert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will send an update email to users before the expiry of the ecents.';

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
     * @return mixed
     */
    public function handle()
    {
        $date = Carbon::now();
        $days = ticket_alert::where('id','1')->first();
        $alert_date = Carbon::parse($event->end)->subDays($days[0])->toDateString();
        $event = event::where('end', '>=' , $alert_date );

    }
}
