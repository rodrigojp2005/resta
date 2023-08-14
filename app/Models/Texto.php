<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Texto extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'titulo',
        'texto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
