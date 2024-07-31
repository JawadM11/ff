<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Flight;

class FlightReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $flight;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Flight  $flight
     * @return void
     */
    public function __construct(Flight $flight)
    {
        $this->flight = $flight;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Flight Reminder')
                    ->view('emails.flight_reminder');
    }
}
