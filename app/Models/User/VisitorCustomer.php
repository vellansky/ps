<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorCustomer extends Model
{
    use HasFactory;
    protected $table = 'visitor_customer';
    protected $guarded = [];
}
