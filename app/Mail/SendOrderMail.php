<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;
    public function __construct(int $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->view('email.order')
            ->with([
                'order' => $this->order
            ]);
    }
}
