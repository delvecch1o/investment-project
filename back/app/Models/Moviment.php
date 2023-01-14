<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Moviment extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'moviments';
    protected $fillable = [
        'user_id',
        'group_id',
        'product_id',
        'invested_value',
        'type',
        'get_value',
    
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
