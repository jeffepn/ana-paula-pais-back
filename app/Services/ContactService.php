<?php

namespace App\Services;

use App\Jobs\Contact\ContactJob;

class ContactService
{
    public function send(array $data): void
    {
        ContactJob::dispatch($data);
    }
}
