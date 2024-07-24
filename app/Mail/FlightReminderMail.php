<?php

namespace App\Mail;

use App\Models\Flight;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FlightReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $flight;

    public function __construct(Flight $flight)
    {
        $this->flight = $flight;
    }

    public function build()
    {
        return $this->view('emails.flight_reminder')
        ->with([
            'flight' => $this->flight,
        ]);
    }
}
