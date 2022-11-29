<?php

namespace App\Models\Admin\Notification\Telegram;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscribes extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'shop_subscribers';
    protected $guarded = [];
}
