<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResendMessageRequest;
use App\Models\Contact;
use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Response;

class ResendController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResendMessageRequest $request): JsonResponse
    {
        $contact = Contact::find($request->contact_id);
        $message = Message::find($request->message_id);


        Message::store(
            chatId: $contact->chat->id,
            userId: auth()->id(),
            message: $message->message,
        );

        return Response::success($message);
    }
}
