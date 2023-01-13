<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Group extends Model
{
    use HasFactory, softDeletes;

    protected $table = 'groups';
    protected $fillable = [
        'name',
        'user_id',
        'instituition_id',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function instituition()
    {
        return $this->belongsTo(Instituition::class);
    }
}
