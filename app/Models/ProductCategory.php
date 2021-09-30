<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'brandId',
        'name',
        'description',
        'image',
        'status'
    ];

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
