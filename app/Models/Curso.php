<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'img',
        'desc',
        'duration',
        'modulos',
        'real_price',
        'promotion',
        'promotion_price',
    ];

    public function conteudos()
    {
        return $this->hasMany(Conteudo::class);
    }

    public function matricula()
    {
        return $this->belongsTo(Matricula::class);
    }
}
