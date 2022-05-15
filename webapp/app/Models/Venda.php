<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['preco', 'descricao', 'quantidade', 'endereco',];

    public function vincularImportacao(Importacao $importacao)
    {
        if ((int)$this->id == 0) {
            throw new \Exception('Salve primeiro o registro da venda para vinculá-lo à importação');
        }

        $vi = VendasImportacao::make();
        $vi->venda()->associate($this);
        $vi->importacao()->associate($importacao);
        $vi->save();

        $importacao->total += $this->preco * $this->quantidade;
        $importacao->save();
    }

    /**
     * Venda belongs to Fornecedor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fornecedor()
    {
        // belongsTo(RelatedModel, foreignKey = fornecedor_id, keyOnRelatedModel = id)
        return $this->belongsTo(User::class, 'fornecedor_id');
    }

    /**
     * Venda belongs to Comprador.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comprador()
    {
        // belongsTo(RelatedModel, foreignKey = comprador_id, keyOnRelatedModel = id)
        return $this->belongsTo(User::class, 'comprador_id');
    }

    /**
     * Venda belongs to Importacao.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function importacao()
    {
        // belongsTo(RelatedModel, foreignKey = importacao_id, keyOnRelatedModel = id)
        return $this->hasOneThrough(
            Importacao::class,
            VendasImportacao::class,
            'importacao_id',
            'id',
            'id',
            'venda_id'
        );
    }
}
