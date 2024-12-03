<?php

namespace App\Mail;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordCustomer extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected Customer $customer;
    protected string $url;
    /**
     * Create a new message instance.
     */
    public function __construct($customer, $url)
    {
       $this->customer = $customer;
       $this->url = $url;
    }


    /**
     * Build the message.
     */
    public function build(): ResetPassword
    {
        return $this
            ->subject('Đặt lại mật khẩu của bạn')
            ->view('frontend.send_mail_reset_password')
            ->with([
                'customer' => $this->customer,
                'url' => $this->url,
            ]);
    }
}
