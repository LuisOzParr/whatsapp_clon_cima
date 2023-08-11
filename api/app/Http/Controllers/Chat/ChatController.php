<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChatRequest;
use App\Models\Chat;
use App\Models\Contact;
use Auth;
use Illuminate\Http\JsonResponse;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $currentUser = Auth::user();
        $chats = Chat::byUserId($currentUser->id)
            ->with(['contacts',  'lastMessage'])
            ->get();

        $chats = $chats->sortByDesc(function ($chat) {
            return $chat?->lastMessage?->created_at;
        })->values();

        return response()->success($chats);
    }

    /**
     * Display a listing of the resource.
     */
    public function store(StoreChatRequest $request): JsonResponse
    {
        $contact = Contact::findOrFail($request->contact_id);
        if ($contact->chat_id != null) {
            return response()->success($contact->chat()->with(['contacts',  'lastMessage'])->first());
        }

        $chat = Chat::create([]);

        $contact->update([
            'chat_id' => $chat->id
        ]);

        $contact->owner->chats()->attach($chat->id);
        $contact->contact->chats()->attach($chat->id);

        $chat = Chat::where('id', $chat->id)->with(['contacts',  'lastMessage'])->first();

        return response()->success($chat);
    }
}
