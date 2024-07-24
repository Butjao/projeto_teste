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


    public static function obtemTodos() {
        $sql = <<<SQL
            SELECT u.id, u.nome, u.email, u.id_situacao, TO_CHAR(u.dt_admissao, 'DD/MM/YYYY') AS dt_admissao
	          FROM usuario u
             ORDER BY u.id
SQL;
        return DB::select($sql);
    }

}
