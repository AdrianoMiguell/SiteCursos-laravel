<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'img',
        'desc',
        'duration',
        'real_price',
        'promotion',
        'promotion_price',
        'visible',
        'release_date',
        'category_id',
        'user_id'
    ];

    // public function conteudos()
    // {
    //     return $this->hasMany(Conteudo::class);
    // }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function modulos()
    {
        return $this->hasMany(Modulo::class);
    }
    // public function mo()
    // {
    //     return $this->hasMany(Conteudo::class);
    // }

    public function matricula()
    {
        return $this->belongsTo(Matricula::class);
    }

    public function quiz()
    {
        // return $this->belongsTo(Quiz::class);
        return $this->hasMany(Quiz::class);
    }
}
