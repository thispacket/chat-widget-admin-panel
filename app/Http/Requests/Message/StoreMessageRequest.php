<?php

namespace App\Http\Requests\Message;

use App\Enum\MessageSender;
use App\Http\Requests\ApiRequest;
use Illuminate\Validation\Rules\Enum;

class StoreMessageRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'text' => ['required', 'string'],
            'sender' => ['required', new Enum(MessageSender::class)]
        ];
    }
}
