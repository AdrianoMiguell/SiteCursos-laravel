<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conteudo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'text',
        'file_link',
        'cursos_id'
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}
