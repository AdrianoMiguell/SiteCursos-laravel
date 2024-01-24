<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conteudo extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'order',
        'apostila_id',
        'desafio_id',
        'slide_id',
        'video_id',
        'modulo_id',
        'curso_id'
    ];

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }

    public function apostila()
    {
        return $this->belongsTo(Apostila::class);
    }
    public function desafio()
    {
        return $this->belongsTo(Desafio::class);
    }
    public function slide()
    {
        return $this->belongsTo(Slide::class);
    }
    public function video()
    {
        return $this->belongsTo(Video::class);
    }
    public function matricula()
    {
        return $this->hasMany(Matricula::class);
    }

    protected static function boot()
    {
        parent::boot();

        parent::creating(function ($conteudo) {
            $lastRegister = self::where([['curso_id', $conteudo->curso_id], ['modulo_id', $conteudo->modulo_id]])->orderBy('order', 'desc')->first();

            $newOrder = $lastRegister ? $lastRegister->order + 1 : 1;

            $conteudo->order = $newOrder;
        });
    }
}
