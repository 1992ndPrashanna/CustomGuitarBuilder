<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ToUserOrderReceived extends Mailable
{
    use Queueable, SerializesModels;
    public $fullname;
    public $email;
    public $guitarmodel;
    public $uuid;
    public $date;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fullname,$email,$guitarmodel,$uuid,$date)
    {
        $this->fullname=$fullname;
        $this->email=$email;
        $this->guitarmodel=$guitarmodel;
        $this->uuid=$uuid;
        $this->date=$date;
        $this->subject('Thank you for your order!');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('admin.products.guitaroptions.to_user_order_received');
    }
}
