<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuLink extends Model
{
    use HasFactory;
    protected $table = 'menu_link';
    protected $guarded = [];
}
