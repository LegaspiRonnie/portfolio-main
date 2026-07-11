<?php

namespace App\Observers;

use App\Models\ContactMessage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ContactMessageObserver
{
    public function created(ContactMessage $contactMessage): void
    {
        $webhookUrl = config('services.discord.contact_webhook_url');

        if (! $webhookUrl) {
            return;
        }

        try {
            Http::timeout(5)->post($webhookUrl, [
                'embeds' => [[
                    'title' => 'New portfolio contact message',
                    'color' => 3447003,
                    'fields' => [
                        ['name' => 'Name', 'value' => $contactMessage->name, 'inline' => true],
                        ['name' => 'Email', 'value' => $contactMessage->email, 'inline' => true],
                        ['name' => 'Message', 'value' => Str::limit($contactMessage->message, 1000)],
                    ],
                    'timestamp' => $contactMessage->created_at->toIso8601String(),
                ]],
            ]);
        } catch (\Throwable $e) {
            Log::warning('Discord contact webhook failed: '.$e->getMessage());
        }
    }
}
