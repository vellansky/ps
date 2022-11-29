<?php

namespace App\Models\Subscribes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Telegram\Chat;

class Subscribes extends Model
{
    use HasFactory;


    protected $table = 'shop_subscribers';


    public function chat()
    {
        return $this->hasMany(Chat::class)->select('subscribes_id','chat_id','first_name','username'); 
    }
}
