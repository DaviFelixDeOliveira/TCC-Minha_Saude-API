<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';

    protected $fillable = [
        'nome_usuario',
        'senha_hash'
    ];

    protected $hidden = [
        'senha_hash'
    ];
}
