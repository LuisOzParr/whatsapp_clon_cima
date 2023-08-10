<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'chat_id',
        'message',
        'message_status_id'
    ];

    protected $casts = [
        'user_id' => 'int',
        'chat_id' => 'int',
        'created_at' => 'datetime',
    ];

    protected $appends =
        ['created_at_formatted']; //created_at_formatted

    public function getCreatedAtFormattedAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
            ->timezone('America/Mexico_City')
            ->format('h:i a');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }

    public function messageStatus(): BelongsTo
    {
        return $this->belongsTo(MessageStatus::class);
    }

    public function scopeByChatId($query, $chatId)
    {
        return $query->where('chat_id', $chatId)->orderBy('id', 'desc');
    }

    public static function store(
        int    $chatId,
        int    $userId,
        string $message,
        int    $statusId = MessageStatus::RECEIVED_SERVER): Message
    {
        return Message::create([
            'chat_id' => $chatId,
            'message' => $message,
            'user_id' => $userId,
            'message_status_id' => $statusId,
        ]);
    }
}
