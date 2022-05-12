<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendasImportacao extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vendas_importacoes';

    /**
     * VendasImportacao belongs to Venda.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function venda()
    {
        // belongsTo(RelatedModel, foreignKey = venda_id, keyOnRelatedModel = id)
        return $this->belongsTo(Venda::class);
    }

    /**
     * VendasImportacao belongs to Importacao.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function importacao()
    {
        // belongsTo(RelatedModel, foreignKey = importacao_id, keyOnRelatedModel = id)
        return $this->belongsTo(Importacao::class);
    }
}
