<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuario';
    protected $primaryKey = 'id';

    public static function obtemTodos($filtroTexto = null, $filtroData = null, $FiltroSituacao = null) {
        $whereExtra = '';
        if($filtroTexto) {
            $whereExtra .= " AND (UPPER(u.nome) LIKE UPPER('%". $filtroTexto ."%') OR UPPER(u.email) LIKE UPPER('%". $filtroTexto . "%'))";
        }

        if($filtroData) {
            $whereExtra .= " AND u.dt_admissao = '{$filtroData}'";
        }

        if($FiltroSituacao) {
            $whereExtra .= " AND u.id_situacao = ". $FiltroSituacao;
        }

        $sql = <<<SQL
            SELECT u.id, u.nome, u.email, u.id_situacao, TO_CHAR(u.dt_admissao, 'DD/MM/YYYY') AS dt_admissao
	          FROM usuario u
             WHERE u.id is not null
              {$whereExtra}
             ORDER BY u.id
SQL;

        return DB::select($sql);
    }

}
