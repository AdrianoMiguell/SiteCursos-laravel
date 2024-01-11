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
        'video_id',
        'slide_id',
        'desafio_id',
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
}
