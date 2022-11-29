<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributes extends Model
{
    use HasFactory;
    protected $table = 'product_attributes';

    public function attribute()
    {
        return $this->hasOne(Attributes::class, 'id', 'attributes_id'); 
    }
}
