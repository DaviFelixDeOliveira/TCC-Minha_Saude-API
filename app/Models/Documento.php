<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Documento extends Model
{
    use HasUuids;

    protected $table = 'documentos';

    protected $fillable = [
        'is_hidden',
        'caminho_arquivo',
        'titulo',
        'nome_paciente',
        'nome_medico',
        'tipo_documento',
        'data_documento',
        'user_id'
    ];

    protected $casts = [
        'is_hidden' => 'boolean',
        'data_documento' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function compartilhamentos(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Compartilhamento::class,
            table: 'compartilhamento_documento',
            foreignPivotKey: 'documento_id',
            relatedPivotKey: 'compartilhamento_id'
        )->using(CompartilhamentoDocumento::class);
    }
}
