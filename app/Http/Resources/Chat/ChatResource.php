<?php

namespace App\Http\Resources\Chat;

use App\Http\Resources\ClientResource;
use App\Http\Resources\Message\MessageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'client' => new ClientResource($this->client),
            'unreadMessagesCount' => $this->unreadMessagesCount(),
            'lastMessage' => new MessageResource($this->lastMessage->first()),
            'messages' => MessageResource::collection($this->messages),
        ];
    }
}
