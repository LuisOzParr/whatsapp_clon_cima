<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Chat;
use App\Models\Message;
use Auth;
use Illuminate\Http\JsonResponse;
use Response;

class ChatMessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Chat $chat): JsonResponse
    {
        $this->authorize('view', $chat);
        $message = Message::byChatId($chat->id)->paginate(20);

        return Response::success($message);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageRequest $request, Chat $chat): JsonResponse
    {
        $this->authorize('view', $chat);

        $message = Message::store(
            chatId: $chat->id,
            userId: Auth::user()->id,
            message: $request->message
        );

        return Response::success($message);
    }
}
