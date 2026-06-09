<?php

namespace App\Jobs\Contact;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;

//Mail
use App\Mail\Contact\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    public $content;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->content = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mailer = Mail::to(config('mail.to.address'));

        $cc = config('mail.cc');
        if (!empty($cc)) {
            $ccAddresses = array_filter(array_map('trim', explode(',', $cc)));
            if (!empty($ccAddresses)) {
                $mailer->cc($ccAddresses);
            }
        }

        $mailer->send(new ContactMail($this->content));
    }
}
