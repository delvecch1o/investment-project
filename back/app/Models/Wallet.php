<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Wallet extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'wallets';
    protected $fillable = [
        'balance',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
