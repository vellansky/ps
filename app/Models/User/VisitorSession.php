<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorSession extends Model
{
    use HasFactory;
    protected $table = 'visitor_session';
    protected $guarded = [];
}
