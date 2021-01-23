<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ToUserOrderPrice extends Mailable
{
    use Queueable, SerializesModels;

    public $fullname;
    public $email;
    public $guitarmodel;
    public $uuid;
    public $date;
    public $totalPrice;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($fullname,$email,$guitarmodel,$uuid,$date,$totalPrice)
    {
        $this->fullname=$fullname;
        $this->email=$email;
        $this->guitarmodel=$guitarmodel;
        $this->uuid=$uuid;
        $this->date=$date;
        $this->totalPrice=$totalPrice;
        $this->subject('Your Custom Guitar Quote');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('admin.products.guitaroptions.to_user_order_price');
    }
}
