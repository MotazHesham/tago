<?php

namespace App\Jobs;

use App\Mail\ConfirmedOrderMail;
use App\Models\Order;
use App\Models\Setting; 
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendOrderConfirmationMail
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private $email; 

    public function __construct(public Order $order,public Setting $site_settings,$email)
    { 
        $this->email = $email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new ConfirmedOrderMail($this->order,$this->site_settings));
    }
}
