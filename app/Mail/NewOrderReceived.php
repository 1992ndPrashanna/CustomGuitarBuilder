<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrderReceived extends Mailable
{
    use Queueable, SerializesModels;
    public $usersFullName;
    public $uuid;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($usersFullName,$uuid)
    {
        $this->usersFullName=$usersFullName;
        $this->uuid=$uuid;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('admin.products.guitaroptions.new_order_received');
    }
}
