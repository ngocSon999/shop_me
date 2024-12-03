<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class ReplyContact extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected array $data;
    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     */
    public function build(): ReplyContact
    {
        $subject = env('APP_NAME') . ' - Trả lời liên hệ của bạn';
        return $this
            ->subject($subject)
            ->view('admins.mail_reply_contact')
            ->with([
                'data' => $this->data,
            ]);
    }
}
