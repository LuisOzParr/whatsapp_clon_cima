<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Response;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return Response::success(
            Contact::byOwner(auth()->id())->get()
        );
    }

    /**
     *  Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request): JsonResponse
    {
        $contact = User::SearchByPhone($request->phone_number)->first();

        $contact = Contact::storeOrUpdate(
            name: $request->name,
            ownerId: auth()->id(),
            contactId: $contact->id,
        );

        return Response::success($contact);
    }
}
