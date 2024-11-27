<?php

namespace App\Listeners;

use App\Events\NewproductMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;
use App\Mail\ProductMailable;
use App\Mail\EmailMailable;

class SendProductMail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewproductMail $event): void
    {
        Mail::to("hsn42476@gmail.com")->send(new EmailMailable());

    }
}
