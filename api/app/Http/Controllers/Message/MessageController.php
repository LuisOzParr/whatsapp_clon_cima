<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;

class MessageController extends Controller
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
        $current = Auth::user();

        $message = Message::create([
           'message' => $request->message,
           'user_id' => $current->id,
        ]);

        return Response::success($message);
    }
}
