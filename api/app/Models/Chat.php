<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Chat extends Model
{
    use HasFactory;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function lastMessage(): HasOne
    {
        return $this->hasOne(Message::class)->latest();
    }

    /**
     * Get the chat by the user id.
     */
    public function scopeByUserId(Builder $query, int $userId): void
    {
        $query->whereHas('Users', function (Builder $query) use ($userId) {
            $query->where('user_id', $userId);
        });
    }
}
