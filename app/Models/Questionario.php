<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionario extends Model
{
    use HasFactory;

    protected $fillable = [
        'img',
        'perg',
        'resp1',
        'resp2',
        'resp3',
        'respTrue',
        'curso_id'
    ];
}
