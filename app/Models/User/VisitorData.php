<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorData extends Model
{
    use HasFactory;
    protected $table = 'visitor_data_session';
    protected $guarded = [];
}
