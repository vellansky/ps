<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $table = 'slider';
    protected $guarded = [];

    public function img()
    {
        return $this->hasOne(SliderImg::class, 'slider_id');
    }
}
