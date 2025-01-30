<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'curso_id',
        'modulo_id',
        'conteudo_id',
        'status',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }
    public function conteudo()
    {
        return $this->belongsTo(Conteudo::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($matricula) {
            $matricula->status = 'em andamento';
        });
    }
}
