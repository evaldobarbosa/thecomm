<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Importacao extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'importacoes';

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['arquivo', 'importado_em', 'hash', 'total'];

    protected $casts = [
        'importado_em' => 'datetime',
    ];

    public function id5()
    {
        return str_pad($this->id, 5, '0', STR_PAD_LEFT);
    }

    public function precoFormatado()
    {
        $a = new \NumberFormatter( config('app.locale'), \NumberFormatter::CURRENCY);
        return str_replace(' ', ' ', $a->format($this->total));
    }

    /**
     * Importacao has many Vendas.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vendas()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = importacao_id, localKey = id)
        return $this->belongsToMany(
            Venda::class,
            VendasImportacao::class
        );
    }
}
