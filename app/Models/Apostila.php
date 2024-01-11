<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apostila extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'link',
    ];

    public function conteudo()
    {
        return $this->hasOne(Conteudo::class);
    }
}
