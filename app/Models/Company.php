<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'configfin';
    protected $fillable = [
        'ip', 'nome_banco', 'usuario_banco', 'senha_banco', 'squema', 'nomecliente', 'caminho_logo', 'origem', 'status'
    ];

}
