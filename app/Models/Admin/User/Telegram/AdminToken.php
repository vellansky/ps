<?php

namespace App\Models\Admin\User\Telegram;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminToken extends Model
{
    use HasFactory;

    protected $table = 'telegram_token';


    public function chat()
    {
        return $this->hasOne(User::class, 'id')->select('id','chat_id');
    }
    
}
