<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SitePolicy extends Model
{
    use HasFactory;
    protected $table = 'site_policy';
    protected $guarded = [];
}
