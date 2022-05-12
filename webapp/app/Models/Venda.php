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
}
