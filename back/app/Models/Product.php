<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Product extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'products';
    protected $fillable = [
        'instituition_id',
        'description',
        'name',
        'index',
        'interest_rate',
        
    ];

    public function instituition()
    {
        return $this->belongsTo(Instituition::class);
    }
}
