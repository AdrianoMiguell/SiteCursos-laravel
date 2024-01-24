<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'img',
        'desc',
        'duration',
        'price_in_cents',
        'promotion',
        'visible',
        'stars',
        'learners',
        'release_date',
        'slug',
        'category_id',
        'user_id'
    ];

    // public function conteudos()
    // {
    //     return $this->hasMany(Conteudo::class);
    // }

    public function user()
    {
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

    public function matricula()
    {
        return $this->hasMany(Matricula::class);
    }

    public function getSlugAttribute()
    {
        // Verifica se já existe um identificador único (uniqid) no slug
        if (Str::contains($this->attributes['slug'], '-')) {
            return $this->attributes['slug'];
        }

        // Se não houver identificador único, adiciona um novo uniqid
        return $this->attributes['slug'] . '-' . uniqid();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($curso) {
            $curso->slug = Str::slug($curso->name) . '-' . uniqid();
        });
    }
}
