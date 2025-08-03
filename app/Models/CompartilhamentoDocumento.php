<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompartilhamentoDocumento extends Pivot
{
    protected $table = 'compartilhamento_documento';

    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'documento_id',
        'compartilhamento_id'
    ];

    public function documento(): BelongsTo
    {
        return $this->belongsTo(Documento::class);
    }

    public function compartilhamento(): BelongsTo
    {
        return $this->belongsTo(Compartilhamento::class);
    }
}
