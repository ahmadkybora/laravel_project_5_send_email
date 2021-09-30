<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_number',
        'name',
        'description',
        'image',
        'status'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
