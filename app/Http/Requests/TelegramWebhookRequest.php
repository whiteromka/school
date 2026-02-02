<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class TelegramWebhookRequest extends Request
{
    public function telegramId(): ?string
    {
        return data_get($this->all(), 'message.from.id');
    }

    public function telegram(): ?string
    {
        return data_get($this->all(), 'message.from.username');
    }

    public function name(): ?string
    {
        return data_get($this->all(), 'message.from.first_name');
    }

    public function lastName(): ?string
    {
        return data_get($this->all(), 'message.from.last_name');
    }

    public function text(): ?string
    {
        return data_get($this->all(), 'message.text');
    }
}

