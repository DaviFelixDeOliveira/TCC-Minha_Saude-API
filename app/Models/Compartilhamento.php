<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Compartilhamento extends Model
{
    use HasUuids;

    protected $table = 'compartilhamentos';

    protected $fillable = [
        'codigo',
        'data_primeiro_uso',
        'expirado',
        'user_id'
    ];

    protected $casts = [
        'data_primeiro_uso' => 'datetime',
        'expirado' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function documentos(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Documento::class,
            table: 'compartilhamento_documento',
            foreignPivotKey: 'compartilhamento_id',
            relatedPivotKey: 'documento_id'
        )->using(CompartilhamentoDocumento::class);
    }
}
