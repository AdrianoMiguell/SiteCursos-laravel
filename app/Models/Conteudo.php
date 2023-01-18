<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conteudo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name-content',
        'text-content',
        'file-content',
        'cursos_id'
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}
