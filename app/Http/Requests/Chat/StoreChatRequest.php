<?php

namespace App\Http\Requests\Chat;

use App\Http\Requests\ApiRequest;

class StoreChatRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
        ];
    }
}
