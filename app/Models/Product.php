<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    use HasFactory;

    protected $fillable = [
        'name',
        'image_path',
        'price',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
