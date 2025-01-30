<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'img',
        'legend',
        'question',
        'alt1',
        'alt2',
        'alt3',
        'alt4',
        'alt5',
        'altTrue',
        'order',
        'modulo_id',
    ];

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }
}
