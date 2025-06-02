<?php

namespace App\Services;

use App\Models\Site\Newsletter;

class NewsletterService
{
    public function create(array $data): Newsletter
    {
        return Newsletter::create([
            'name' => $data['name'],
            'email' => $data['email']
        ]);
    }
}