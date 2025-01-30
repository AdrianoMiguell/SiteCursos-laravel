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

    public function matricula()
    {
        return $this->hasMany(Matricula::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    protected static function boot()
    {
        parent::boot();

        parent::creating(function ($modulo) {
            $lastRegister = self::where('curso_id', $modulo->curso_id)->orderBy('order', 'desc')->first();

            $newOrder = $lastRegister ? $lastRegister->order + 1 : 1;

            $modulo->order = $newOrder;
        });
    }
}
