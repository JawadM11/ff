<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Flight;
use Illuminate\Support\Facades\Mail;
use App\Mail\FlightReminderMail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $flights = Flight::where('departure_time', '>=', now()->addHours(24))
                                        ->where('departure_time', '<', now()->addHours(25))
                                        ->with('passengers')
                                        ->get();

            foreach ($flights as $flight) {
                foreach ($flight->passengers as $passenger) {
                    Mail::to($passenger->email)->send(new FlightReminderMail($flight));
                }
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
