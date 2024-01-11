<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'desc',
        'order',
        'curso_id'
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function conteudos()
    {
        return $this->hasMany(Conteudo::class);
    }
}
