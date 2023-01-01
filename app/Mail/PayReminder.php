<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PayReminder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $value;
    private $inv;
    private $project;
    private $payment;
    private $limit;

    public function __construct($value, $inv, $project, $payment, $limit)
    {
        $this->value = $value;
        $this->inv = $inv;
        $this->project = $project;
        $this->payment = $payment;
        $this->limit = $limit;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.reminder')
        ->subject("Pengingat Pembayaran")
        ->with([
            'value' => $this->value,
            'inv' => $this->inv,
            'project' => $this->project,
            'payment' => $this->payment,
            'limit' => $this->limit,
        ]);
    }
}
