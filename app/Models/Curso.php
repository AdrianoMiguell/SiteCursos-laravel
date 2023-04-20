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
        'desc_more',
        'duration',
        'modulos',
        'real_price',
        'promotion',
        'promotion_price',
        'ready'
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
