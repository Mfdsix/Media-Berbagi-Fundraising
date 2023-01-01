<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaySucceed extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $data;
    private $project;

    public function __construct($data, $project)
    {
        $this->data = $data;
        $this->project = $project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.succeed')
        ->subject("Donasi Berhasil")
        ->with([
            'data' => $this->data,
            'project' => $this->project,
        ]);
    }
}
