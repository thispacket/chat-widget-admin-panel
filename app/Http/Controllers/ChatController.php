<?php

namespace App\Http\Controllers;

use App\Enum\MessageSender;
use App\Events\NewChatMessage;
use App\Http\Requests\Chat\StoreChatRequest;
use App\Http\Requests\Message\StoreMessageRequest;
use App\Http\Resources\Chat\ChatCollection;
use App\Http\Resources\Chat\ChatResource;
use App\Http\Resources\Message\MessageResource;
use App\Models\Chat;
use App\Models\Client;
use Illuminate\Http\JsonResponse;

class ChatController extends Controller
{
    public function store(StoreChatRequest $request): JsonResponse
    {
        $client = Client::query()->createOrFirst($request->validated())->first();

        $chat = $client->wasRecentlyCreated
            ? Chat::query()
                ->whereClientId($client->id)
                ->first()
            : Chat::query()
                ->create([
                    'client_id' => $client->id
                ]);

        return response()->json([
            'success' => true,
            'chatId' => $chat->id,
        ]);
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'chats' => new ChatCollection(
                Chat::query()
                    ->where('user_id', '=', auth()->id())
                    ->orWhere('user_id', '=', null)
                    ->get()
            ),
        ]);
    }

    public function show(Chat $chat): JsonResponse
    {
        $chat->messages()->update([
            'is_read' => true
        ]);

        return response()->json([
            'success' => true,
            'chat' => new ChatResource($chat),
        ]);
    }

    public function sendMessage(Chat $chat, StoreMessageRequest $request): JsonResponse
    {
        if (!$chat->user_id && $request->input('sender') === MessageSender::Operator) {
            $chat->update([
                'user_id' => auth()->id(),
            ]);
        }

        $message = $chat->messages()->create($request->validated());

        event(new NewChatMessage($message));

        return response()->json([
            'success' => true,
            'message' => new MessageResource($message),
        ]);
    }
}
