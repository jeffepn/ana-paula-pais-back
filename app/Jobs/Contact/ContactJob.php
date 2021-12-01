<?php

namespace App\Jobs\Contact;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;

//Mail
use App\Mail\Contact\ContactMail;
//Services
use JpUtilities\Services\ContactService;
use JpUtilities\Utilities\LogsSystem;

class ContactJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
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

        //  $logs = new LogsSystem();
        // $logs->writeLogEmail('Passei kkkkkk = ' . "    " . config('queue.default') . "    " . config('queue.connections.async.binary') . "    " . config('mail.encryption') . "    " .  config('mail.driver') . "    " . config('mail.host') . "    " . config('queue.connections.binary') . "    " . config('mail.port') . "    " . config('mail.username') . "  add=  " . config('mail.from.address') . " name=   " . config('mail.from.name'));
        ContactService::sendEmail('contato@anapaulapais.com.br', new ContactMail($this->content));
    }
}