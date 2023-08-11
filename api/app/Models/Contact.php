<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'owner_id',
        'contact_id',
        'chat_id',
    ];

    protected $casts = [
        'owner_id' => 'int',
        'contact_id' => 'int',
        'chat_id' => 'int',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(User::class, 'contact_id');
    }

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }

    public function lastMessage(): HasOne
    {
        return $this->hasOne(Message::class, 'chat_id', 'chat_id')->latest();
    }

    /**
     * Scope a query to only include contacts of the given owner.
     */
    public function scopeByOwner(Builder $query, int $ownerId): void
    {
        $query->where('owner_id', $ownerId)
            ->orderBy('name')
            ->with('lastMessage');
    }

    /**
     * Create a new contact.
     */
    public static function storeOrUpdate(string $name, int $ownerId, int $contactId, int $chatId = null): Contact
    {
        return Contact::updateOrCreate(
            [
                'contact_id' => $contactId,
                'owner_id' => $ownerId
            ],
            [
                'name' => $name,
                'chat_id' => $chatId,
            ]
        );
    }

}
