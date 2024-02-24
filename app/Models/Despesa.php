<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Despesa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'descricao',
        'valor',
        'data',
        'tipo'
    ];
}
