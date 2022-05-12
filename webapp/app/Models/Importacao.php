<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Importacao extends Model
{
    use HasFactory;

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['arquivo', 'importado_em'];

    protected $casts = [
        'importado_em' => 'datetime',
    ];
}
