<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $guarded = [];

    public function address(){
        return $this->hasOne(Address::class, 'customer_id', 'id');
    }
    public function contact(){
        return $this->hasOne(Contact::class, 'customer_id', 'id');
    }
}
