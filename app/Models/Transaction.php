<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'bankId',
        'transaction_code',
        'amount',
        'description',
        'image',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function bank(){
        return $this->belongsTo(Bank::class);
    }
}
