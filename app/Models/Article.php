<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoryId',
        'name',
        'description',
        'image',
        'status'
    ];

    public function category(){
        return $this->belongsTo(ArticleCategory::class);
    }
}
