<?php

namespace App\Models\Admin\Notification\Telegram;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bot extends Model
{
    use HasFactory;
    protected $table = 'telegram_token';
    protected $guarded = [];
}
