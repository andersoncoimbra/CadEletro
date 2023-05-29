<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Marca;

class Eletrodomestico extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'tensao',
        'marca_id',
    ];
}
