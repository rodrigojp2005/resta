<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Autorizacao extends Model
{
    use HasFactory;

    protected $table = 'autorizacoes';

    protected $fillable = [
        'autorizador_id',
        'autorizado_id',
        'status',
    ];

    public function autorizador()
    {
        return $this->belongsTo(User::class, 'autorizador_id');
    }

    public function autorizado()
    {
        return $this->belongsTo(User::class, 'autorizado_id');
    }

}
