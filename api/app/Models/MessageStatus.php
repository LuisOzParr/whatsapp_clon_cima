<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageStatus extends Model
{
    use HasFactory;

    const SEND = 1;
    const RECEIVED_SERVER = 2;
    const RECEIVED_USER = 3;
    const USER_READ = 4;
}
