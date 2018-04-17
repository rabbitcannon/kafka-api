<?php

namespace App\Mail;

use App\CriticalEventTest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CriticalEventOccurred extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var CriticalEventTest
     */
    private $criticalEvent;

    /**
     * Create a new message instance.
     *
     * @param CriticalEventTest $criticalEvent
     */
    public function __construct(CriticalEventTest $criticalEvent)
    {
        $this->criticalEvent = $criticalEvent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.events.critical-notification');
    }
}
