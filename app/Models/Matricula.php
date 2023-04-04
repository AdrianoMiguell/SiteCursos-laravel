<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'curso_id',
        'status',
        'modulo_atual',
        'price',
    ];

    public function curso()
    {
        return $this->hasMany(Curso::class);
    }
    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }
}
