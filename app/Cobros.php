<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cobros extends Model
{
    protected $table = 'cobros';
    protected $primaryKey = 'idCobros';


    protected $fillable = ['idUsuarios', 'Empresa', 'Rut_Empresa', 'descripcion', 'fecha_vencimiento', 'email', 'monto'];
    protected $hidden = ['created_at', 'updated_at', 'eliminado'];


    public static function ListaCobrosFiltros($idUsuario, $fecha_vencimiento, $empresa, $id_hijo, $buscar_rut)
    {
        $cobros = Cobros::with('cobrador')->where('idUsuarios', $idUsuario)
        ->where('cobros.eliminado', 0)
        ->where('cobros.pagado', 0)
        ->select('empresa', 'cobros.idCobros', 'descripcion', 'fecha_vencimiento', 'monto', 'url_adjunto', 'rut_empresa', 'idTipoPago')
        ->orderBy('fecha_vencimiento')
        ->groupBy('cobros.idCobros');
        if (!is_null($id_hijo)) {
            $cobros = $cobros->where('idUsuarios_hijo', $id_hijo);
        }

        if (!empty($buscar_rut)) {
            $cobros = $cobros->where('rut_empresa', $buscar_rut);
        }
        if (!empty($empresa)) {
            $cobros = $cobros->where('empresa', $empresa);
        }
        if (!empty($fecha_vencimiento)) {
            $cobros = $cobros->orderBy('fecha_vencimiento', $fecha_vencimiento);
        } else {
            $cobros = $cobros->orderBy('idCobros', 'desc');
        }
        return $cobros;
    }

    public static function ListaCobrosFiltrosPagados($idUsuario, $fecha_vencimiento, $empresa, $buscar_rut, $vencimiento, $monto)
    {
        /*
        $query = "(
                        SELECT idCobros,empresa,descripcion,fecha_vencimiento,monto,fecha_pago,nro_transaccion,1 AS tipo,rut_empresa as rut
                        FROM cobros
                        WHERE eliminado = 0 AND pagado = 1 AND idUsuarios = ?
                        UNION ALL
                        SELECT N.idnominas,empresa,N.descripcion,N.fecha_vencimiento,monto_pago,fecha_pago,nro_transaccion,2 AS tipo,rut
                        FROM nominas N
                        INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
                        WHERE N.eliminado = 0 AND pagado = 1 AND N.idUsuarios = ?
                        GROUP BY N.idnominas
                    ) AS T";
        */

                    $query = "(
                    SELECT idCobros,empresa,C.descripcion,fecha_vencimiento,monto,fecha_pago,nro_transaccion,1 AS tipo,C.rut_empresa as rut,url_adjunto as 'adjunto', T.descripcion as forma_pago
                    FROM cobros C
                    INNER JOIN usuarios U ON C.idUsuarios = U.idUsuarios
                    LEFT JOIN tipo_pagos T ON C.idTipoPago = T.idTipoPago
                    WHERE C.eliminado = 0 AND pagado = 1 AND C.idUsuarios = ?
                    UNION ALL
                    SELECT D.idnominasdetalle,D.nombre AS empresa,D.descripcion,D.fecha_vencimiento,D.monto,fecha_pago,nro_transaccion,2 AS tipo,D.rut,D.idnominas as 'adjunto',T.descripcion as forma_pago
                    FROM nominas N
                    INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
                    INNER JOIN usuarios U ON N.idUsuarios = U.idUsuarios
                    LEFT JOIN tipo_pagos T ON D.idTipoPago = T.idTipoPago
                    WHERE N.eliminado = 0 AND pagado = 1 AND N.idUsuarios = ?
                ) AS T";

                $data = DB::table(DB::raw($query))
                ->setBindings(array($idUsuario, $idUsuario));

                if (!empty($empresa)) {
                    $data = $data->where('empresa', $empresa);
                }

                if (!empty($buscar_rut)) {
                    $data = $data->where('rut', $buscar_rut);
                }
                $data = $data->orderBy('fecha_pago', 'desc');
                if (!empty($vencimiento)) {
                    $data = $data->orderBy('fecha_vencimiento', $vencimiento);
                }
                if (!empty($monto)) {
                    $data = $data->orderBy('monto', $monto);
                }
                if (!empty($fecha_vencimiento)) {
                    $data = $data->orderBy('fecha_pago', $fecha_vencimiento);
        } /*else {
            $data = $data->orderBy('idCobros', 'desc');
        }*/

        return $data;
    }

    public static function ListaEmpresaPagadas($idUsuarios)
    {

        /*$query = "(
                        SELECT empresa
                        FROM cobros
                        WHERE eliminado = 0 AND pagado = 1 AND idUsuarios = ?
                        UNION ALL
                        SELECT empresa
                        FROM nominas N
                        INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
                        WHERE N.eliminado = 0 AND pagado = 1 AND N.idUsuarios = ?
                        GROUP BY N.idnominas
                    ) AS T";*/

                    $query = "(
                    SELECT empresa
                    FROM cobros C
                    WHERE C.eliminado = 0 AND pagado = 1 AND C.idUsuarios = ?
                    UNION ALL
                    SELECT D.nombre AS empresa
                    FROM nominas N
                    INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
                    WHERE N.eliminado = 0 AND pagado = 1 AND N.idUsuarios = ?
                ) AS T";

                $data = DB::table(DB::raw($query))
                ->setBindings(array($idUsuarios, $idUsuarios));

                return $data;
            }

            public static function total_deudas_pagadas($mes)
            {
                $query = "(
                SELECT idCobros,created_at
                FROM cobros
                WHERE eliminado = 0 AND pagado = 1
                UNION ALL
                SELECT D.idnominasdetalle,D.created_at
                FROM nominas N
                INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
                WHERE D.eliminado = 0 AND pagado = 1
            ) AS T";

            $data = DB::table(DB::raw($query))
            ->where(DB::raw('MONTH(created_at)'), '<=', $mes)
            ->distinct()
            ->count();

            return $data;
        }

        public static function deudores_activos($mes)
        {
            $query = "(
            SELECT * FROM(
            SELECT idUsuarios,created_at
            FROM cobros
            WHERE eliminado = 0 AND pagado = 0
            UNION ALL
            SELECT idUsuarios,D.created_at
            FROM nominas N
            INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
            WHERE D.eliminado = 0 AND pagado = 0
            ) AS B
            GROUP BY idUsuarios
        ) AS T";

        $data = DB::table(DB::raw($query))
        ->where(DB::raw('MONTH(created_at)'), '<=', $mes)
        ->count();

        return $data;
    }

    public static function pagadores_activos($mes)
    {
        $query = "(
        SELECT * FROM(
        SELECT rut_empresa,created_at
        FROM cobros
        WHERE eliminado = 0 AND pagado = 1
        UNION ALL
        SELECT D.rut,D.created_at
        FROM nominas N
        INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
        WHERE D.eliminado = 0 AND pagado = 1
        ) AS B
        GROUP BY rut_empresa
    ) AS T";

    $data = DB::table(DB::raw($query))
    ->where(DB::raw('MONTH(created_at)'), '<=', $mes)
    ->distinct()
    ->count();

    return $data;
}

public static function ListaEmpresaPagadasAdmin($rut_deudor, $rut_cobrador, $desde, $hasta)
{
    $query = "(
    SELECT idCobros,empresa,descripcion,fecha_vencimiento,monto,fecha_pago,rut_empresa as rut,1 AS tipo, U.rut as rut_cobrador
    FROM cobros C
    INNER JOIN usuarios U on C.idUsuarios = U.idUsuarios
    WHERE C.eliminado = 0 AND pagado = 1
    UNION ALL
    SELECT D.idnominasdetalle,D.nombre,D.descripcion,D.fecha_vencimiento,D.monto,D.fecha_pago,D.rut,2 AS tipo,U.rut as rut_cobrador
    FROM nominas N
    INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
    INNER JOIN usuarios U ON N.idUsuarios = U.idUsuarios
    WHERE D.eliminado = 0 AND pagado = 1
) AS T";

$data = DB::table(DB::raw($query));
if (!empty($rut_deudor)) {
    $data = $data->where('rut', $rut_deudor);
}
if (!empty($rut_cobrador)) {
    $data = $data->where('rut_cobrador', $rut_cobrador);
}

if (!empty($desde)) {
    $data = $data->where('fecha_pago', '>=', $desde);
}

if (!empty($hasta)) {
    $data = $data->where('fecha_pago', '<=', $hasta);
}

$data = $data->distinct();
$data = $data->orderBy('idCobros', 'desc');
return $data;
}

public static function ListaEmpresaPagadasAdminExcel($rut_deudor, $rut_cobrador, $desde, $hasta)
{
    $query = "(
    SELECT idCobros,empresa,descripcion,fecha_vencimiento,monto,fecha_pago,rut_empresa as rut,1 AS tipo, U.rut as rut_cobrador
    FROM cobros C
    INNER JOIN usuarios U on C.idUsuarios = U.idUsuarios
    WHERE C.eliminado = 0 AND pagado = 1
    UNION ALL
    SELECT D.idnominasdetalle,D.nombre,D.descripcion,D.fecha_vencimiento,D.monto,D.fecha_pago,D.rut,2 AS tipo,U.rut as rut_cobrador
    FROM nominas N
    INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
    INNER JOIN usuarios U ON N.idUsuarios = U.idUsuarios
    WHERE D.eliminado = 0 AND pagado = 1
) AS T";

$data = DB::table(DB::raw($query));
if (!empty($rut_deudor)) {
    $data = $data->where('rut', $rut_deudor);
}
if (!empty($rut_cobrador)) {
    $data = $data->where('rut_cobrador', $rut_cobrador);
}

if (!empty($desde)) {
    $data = $data->where('fecha_pago', '>=', $desde);
}

if (!empty($hasta)) {
    $data = $data->where('fecha_pago', '<=', $hasta);
}

$data = $data->distinct();
$data = $data->orderBy('idCobros', 'desc');
return json_decode(json_encode($data->get()), true);
}

public static function ListaPendientesAdmin($rut_deudor, $rut_cobrador, $desde, $hasta)
{
    $query = "(
    SELECT idCobros,empresa,descripcion,fecha_vencimiento,monto,fecha_pago,rut_empresa as rut,1 AS tipo,U.rut as rut_cobrador
    FROM cobros C
    INNER JOIN usuarios U on C.idUsuarios = U.idUsuarios
    WHERE C.eliminado = 0 AND C.pagado = 0
    UNION ALL
    SELECT D.idnominasdetalle,D.nombre,D.descripcion,D.fecha_vencimiento,D.monto,D.fecha_pago,D.rut,2 AS tipo,U.rut as rut_cobrador
    FROM nominas N
    INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
    INNER JOIN usuarios U ON N.idUsuarios = U.idUsuarios
    WHERE D.eliminado = 0 AND pagado = 0
) AS T";

$data = DB::table(DB::raw($query));
if (!empty($rut_deudor)) {
    $data = $data->where('rut', $rut_deudor);
}
if (!empty($rut_cobrador)) {
    $data = $data->where('rut_cobrador', $rut_cobrador);
}

if (!empty($desde)) {
    $data = $data->where('fecha_vencimiento', '>=', $desde);
}

if (!empty($hasta)) {
    $data = $data->where('fecha_vencimiento', '<=', $hasta);
}

$data = $data->distinct();
$data = $data->orderBy('idCobros', 'desc');
return $data;
}

public static function ListaPendientesAdminExcel($rut_deudor, $rut_cobrador, $desde, $hasta)
{
    $query = "(
    SELECT idCobros,empresa,descripcion,fecha_vencimiento,monto,fecha_pago,rut_empresa as rut,1 AS tipo,U.rut as rut_cobrador
    FROM cobros C
    INNER JOIN usuarios U on C.idUsuarios = U.idUsuarios
    WHERE C.eliminado = 0 AND C.pagado = 0
    UNION ALL
    SELECT D.idnominasdetalle,D.nombre,D.descripcion,D.fecha_vencimiento,D.monto,D.fecha_pago,D.rut,2 AS tipo,U.rut as rut_cobrador
    FROM nominas N
    INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
    INNER JOIN usuarios U ON N.idUsuarios = U.idUsuarios
    WHERE D.eliminado = 0 AND pagado = 0
) AS T";

$data = DB::table(DB::raw($query));
if (!empty($rut_deudor)) {
    $data = $data->where('rut', $rut_deudor);
}
if (!empty($rut_cobrador)) {
    $data = $data->where('rut_cobrador', $rut_cobrador);
}

if (!empty($desde)) {
    $data = $data->where('fecha_vencimiento', '>=', $desde);
}

if (!empty($hasta)) {
    $data = $data->where('fecha_vencimiento', '<=', $hasta);
}

$data = $data->distinct();
$data = $data->orderBy('idCobros', 'desc');
return json_decode(json_encode($data->get()), true);
}

public static function ListarMisCobrosPendiente($idUsuarios, $empresa, $rut, $fecha_vencimiento, $monto)
{
    $query = "(
    SELECT idCobros,empresa,descripcion,fecha_vencimiento,monto,fecha_pago,rut_empresa as rut,1 AS tipo,url_adjunto
    FROM cobros
    WHERE eliminado = 0 AND pagado = 0 AND idUsuarios = '" . $idUsuarios . "'
    UNION ALL
    SELECT D.idnominasdetalle,D.nombre,D.descripcion,D.fecha_vencimiento,D.monto,D.fecha_pago,D.rut,2 AS tipo,url_adjunto
    FROM nominas N
    INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
    WHERE D.eliminado = 0 AND pagado = 0 AND N.idUsuarios = '" . $idUsuarios . "'
) AS T";

$data = DB::table(DB::raw($query))->distinct();
if (!empty($empresa)) {
    $data->where('empresa', $empresa);
}
if (!empty($rut)) {
    $data->where('rut', $rut);
}
$data = $data->orderBy('fecha_vencimiento', 'asc');
if (!empty($fecha_vencimiento)) {
    $data = $data->orderBy('fecha_vencimiento', $fecha_vencimiento);
} else if (!empty($monto)) {
    $data = $data->orderBy('monto', $monto);
        } /*else {
            $data = $data->orderBy('idCobros', 'desc');
        }*/
        return $data;
    }

    public static function exportar_todo($idUsuarios)
    {
        $query = "(
        SELECT idCobros as ID,rut_empresa as 'Rut Deudor',empresa as 'Nombre / Razón Social',C.descripcion,DATE_FORMAT(C.fecha_vencimiento,'%d/%m/%Y') AS fecha_vencimiento,DATE_FORMAT(fecha_pago,'%d/%m/%Y') AS fecha_pago,monto,C.fecha_vencimiento as raw_vencimiento,
        case when pagado IS NULL or pagado = ''
        then 'pendiente'
        else 'pagado'
        end as Estado
        ,ifnull(T.descripcion, case when pagado is null or pagado = ''
        then ''
        else 'TEF (Conc.Auto)'
        end) as 'Medio Pago', nro_transaccion,'Individual' AS tipo
        FROM cobros C
        LEFT JOIN tipo_pagos T ON C.idTipoPago = T.idTipoPago
        WHERE C.eliminado = 0 AND idUsuarios = '" . $idUsuarios . "'
        UNION ALL
        SELECT D.idnominasdetalle AS ID,D.rut as 'Rut Deudor',D.nombre as 'Nombre / Razón Social',D.descripcion,DATE_FORMAT(D.fecha_vencimiento,'%d/%m/%Y') AS fecha_vencimiento,DATE_FORMAT(fecha_pago,'%d/%m/%Y') AS fecha_pago,D.monto,D.fecha_vencimiento as raw_vencimiento,
        case when pagado IS NULL or pagado = ''
        then 'pendiente'
        else 'pagado'
        end as Estado
        ,ifnull(T.descripcion, case when pagado is null or pagado = ''
        then ''
        else 'TEF (Conc.Auto)'
        end) as 'Medio Pago',nro_transaccion,'Nómina' AS tipo
        FROM nominas N
        INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
        LEFT JOIN tipo_pagos T ON D.idTipoPago = T.idTipoPago
        WHERE D.eliminado = 0 AND N.idUsuarios = '" . $idUsuarios . "'
    ) AS T";

    $data = DB::table(DB::raw($query))->distinct();
    $data = $data->orderBy('Estado', 'desc')->orderByRaw('raw_vencimiento ASC');
        //dd($data->get());

    return json_decode(json_encode($data->get(['ID', 'Rut Deudor', 'Nombre / Razón Social', 'descripcion', 'fecha_vencimiento', 'fecha_pago', 'monto', 'Estado', 'Medio Pago', 'nro_transaccion', 'tipo'])), true);
        //return $data;
}

public static function ComboboxMisCobrosPendiente($idUsuarios)
{
    $query = "(
    SELECT empresa
    FROM cobros
    WHERE eliminado = 0 AND pagado = 0 AND idUsuarios = '" . $idUsuarios . "'
    UNION ALL
    SELECT D.nombre as empresa
    FROM nominas N
    INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
    WHERE D.eliminado = 0 AND pagado = 0 AND N.idUsuarios = '" . $idUsuarios . "'
) AS T";

$data = DB::table(DB::raw($query))->distinct();
$data = $data->lists('empresa', 'empresa');
return $data;
}

public static function total_deudas_no_pagadas_id($rut, $fecha)
{
    $query = "(
    SELECT idCobros AS ID
    FROM cobros
    WHERE eliminado = 0 AND pagado = 0 AND (rut_empresa = ? OR rut_traspaso = ?) AND fecha_vencimiento < ?
    UNION ALL
    SELECT D.idnominasdetalle AS ID
    FROM nominas N
    INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
    WHERE N.eliminado = 0 AND pagado = 0 AND (D.rut = ? OR rut_traspaso = ?) AND D.fecha_vencimiento < ?

) AS T";
$data = DB::table(DB::raw($query))
->setBindings(array($rut, $rut, $fecha, $rut, $rut, $fecha))
->count();
return $data;
}

public static function MisNoPagadas($rut, $fecha_vencimiento, $monto, $empresa, $buscar_rut)
{
    $query = "(
    SELECT idCobros,CONCAT(U.nombre,' ',U.apellido) AS empresa,descripcion,fecha_vencimiento,monto,fecha_pago,nro_transaccion,1 AS tipo,U.rut as rut,url_adjunto as 'adjunto'
    FROM cobros C
    INNER JOIN usuarios U ON C.idUsuarios = U.idUsuarios
    WHERE C.eliminado = 0 AND pagado = 0 AND (rut_empresa = '" . $rut . "' OR rut_traspaso = '" . $rut . "')
    UNION ALL
    SELECT D.idnominasdetalle,CONCAT(U.nombre,' ',U.apellido) AS empresa,D.descripcion,D.fecha_vencimiento,D.monto,fecha_pago,nro_transaccion,2 AS tipo,U.rut,D.idnominas as 'adjunto'
    FROM nominas N
    INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
    INNER JOIN usuarios U ON N.idUsuarios = U.idUsuarios
    WHERE N.eliminado = 0 AND pagado = 0 AND (D.rut = '" . $rut . "' OR rut_traspaso = '" . $rut . "')
                        " .//GROUP BY N.idnominas
                        ") AS T";
                        $data = DB::table(DB::raw($query))
            //->setBindings(array($rut,$rut,$rut,$rut))
                        ->distinct();
                        if (!empty($empresa)) {
                            $data = $data->where('empresa', $empresa);
                        }

                        if (!empty($buscar_rut)) {
                            $data = $data->where('rut', $buscar_rut);
                        }
                        $data = $data->orderBy('fecha_vencimiento', 'asc');
                        if (!empty($fecha_vencimiento)) {
                            $data = $data->orderBy('fecha_vencimiento', $fecha_vencimiento);
                        } else if (!empty($monto)) {
                            $data = $data->orderBy('monto', $monto);
        } /*else {
            $data = $data->orderBy('idCobros', 'desc');
        }*/
        return $data;
    }

    public static function MisNoPagadas_lista($rut)
    {
        $query = "(
        SELECT idCobros,CONCAT(U.nombre,' ',U.apellido) AS empresa
        FROM cobros C
        INNER JOIN usuarios U ON C.idUsuarios = U.idUsuarios
        WHERE C.eliminado = 0 AND pagado = 0 AND (rut_empresa = ? OR rut_traspaso = ?)
        UNION ALL
        SELECT D.idnominasdetalle,CONCAT(U.nombre,' ',U.apellido) AS empresa
        FROM nominas N
        INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
        INNER JOIN usuarios U ON N.idUsuarios = U.idUsuarios
        WHERE N.eliminado = 0 AND pagado = 0 AND (D.rut = ? OR rut_traspaso = ?)
        GROUP BY N.idnominas
    ) AS T";
    $data = DB::table(DB::raw($query))
    ->setBindings(array($rut, $rut, $rut, $rut))
    ->distinct();
    return $data;
}

public static function MisPagadas($rut, $fecha_vencimiento, $monto, $empresa, $buscar_rut)
{
    $query = "(
    SELECT idCobros,CONCAT(U.nombre,' ',U.apellido) AS empresa,C.descripcion,C.fecha_vencimiento,C.monto,C.fecha_pago,C.nro_transaccion,1 AS tipo,C.rut_empresa as rut,url_adjunto as 'adjunto',U.rut as rut_cobrador,T.descripcion as forma_pago
    FROM cobros C
    INNER JOIN usuarios U ON C.idUsuarios = U.idUsuarios
    LEFT JOIN tipo_pagos T ON T.idTipoPago = C.idTipoPago
    WHERE C.eliminado = 0 AND pagado = 1 AND (rut_empresa = ? OR rut_traspaso = ?)
    UNION ALL
    SELECT N.idnominas,CONCAT(U.nombre,' ',U.apellido) AS empresa,D.descripcion,D.fecha_vencimiento,D.monto,D.fecha_pago,nro_transaccion,2 AS tipo,D.rut,url_adjunto as 'adjunto',U.rut as rut_cobrador,T.descripcion as forma_pago
    FROM nominas N
    INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
    INNER JOIN usuarios U ON N.idUsuarios = U.idUsuarios
    LEFT JOIN tipo_pagos T ON T.idTipoPago = D.idTipoPago
    WHERE N.eliminado = 0 AND pagado = 1 AND (D.rut = ? OR rut_traspaso = ?)
    GROUP BY N.idnominas
) AS T";

$data = DB::table(DB::raw($query))
->setBindings(array($rut, $rut, $rut, $rut))
->distinct();
if (!empty($empresa)) {
    $data = $data->where('empresa', $empresa);
}

if (!empty($buscar_rut)) {
    $data = $data->where('rut', $buscar_rut);
}
$data = $data->orderBy('fecha_pago', 'desc');
if (!empty($fecha_vencimiento)) {
    $data = $data->orderBy('fecha_vencimiento', $fecha_vencimiento);
} else if (!empty($monto)) {
    $data = $data->orderBy('monto', $monto);
        }/* else {
            $data = $data->orderBy('idCobros', 'desc');
        }*/
        return $data;
    }

    public static function MisPagadas_lista($rut)
    {
        $query = "(
        SELECT idCobros,CONCAT(U.nombre,' ',U.apellido) AS empresa
        FROM cobros C
        INNER JOIN usuarios U ON C.idUsuarios = U.idUsuarios
        WHERE C.eliminado = 0 AND pagado = 1 AND (rut_empresa = ? OR rut_traspaso = ?)
        UNION ALL
        SELECT N.idnominas,CONCAT(U.nombre,' ',U.apellido) AS empresa
        FROM nominas N
        INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
        INNER JOIN usuarios U ON N.idUsuarios = U.idUsuarios
        WHERE N.eliminado = 0 AND pagado = 1 AND (D.rut = ? OR rut_traspaso = ?)
        GROUP BY N.idnominas
    ) AS T";

    $data = DB::table(DB::raw($query))
    ->setBindings(array($rut, $rut, $rut, $rut))
    ->distinct();
    return $data;
}

public static function nominas($idUsuarios, $fecha_vencimiento, $empresa, $id_hijo, $buscar_rut)
{
    $nominas = Nominas::where('nominas.idUsuarios', $idUsuarios)
    ->join('nominasdetalle', 'nominasdetalle.idnominas', '=', 'nominas.idnominas')
    ->leftJoin('usuarios', 'usuarios.idUsuarios', '=', 'nominas.idUsuarios_hijo')
    ->where('todo_pagado', 0)
    ->where('nominas.eliminado', 0)
    ->select('nominasdetalle.*', 'nominas.*', 'usuarios.nombre', 'usuarios.apellido')
    ->groupBy('nominas.idnominas');

    if (!is_null($id_hijo)) {
        $nominas = $nominas->where('idUsuarios_hijo', $id_hijo);
    }

    if (!empty($buscar_rut)) {
        $nominas = $nominas->where('rut', $buscar_rut);
    }

    if (!empty($empresa)) {
        $nominas = $nominas->where('empresa', $empresa);
    }

    if (!empty($fecha_vencimiento)) {
        $nominas = $nominas->orderBy('nominas.fecha_vencimiento', $fecha_vencimiento);
    } else {
        $nominas = $nominas->orderBy('nominas.idnominas', 'desc');
    }
    return $nominas;
}

public static function nominasPadre($idUsuarios, $fecha_vencimiento, $empresa, $mi_rut)
{

    $nominas = Nominas::select('*')
    ->from(DB::raw("( SELECT *,(SELECT COUNT(*) FROM nominasdetalle n WHERE n.idnominas = nominas.idnominas AND n.rut = '" . $mi_rut . "') AS total
        FROM `nominas`
        WHERE `idUsuarios` = '" . $idUsuarios . "' AND `todo_pagado` = 0 AND `eliminado` = 0) AS T")
)->where('total', '>', 0);

    if (!empty($empresa)) {
        $nominas = $nominas->where('empresa', $empresa);
    }

    if (!empty($fecha_vencimiento)) {
        $nominas = $nominas->orderBy('fecha_vencimiento', $fecha_vencimiento);
    } else {
        $nominas = $nominas->orderBy('idnominas', 'desc');
    }
    return $nominas;
}

public static function detallenominas($id, $monto)
{
    $detalle = NominasDetalles::where('idnominas', $id)
    ->where('eliminado', 0)
    ->where('pagado', 0);
    if (!empty($monto)) {
        $nominas = $detalle->orderBy('monto', $monto);
    } else {
        $nominas = $detalle->orderBy('idnominasdetalle', 'desc');
    }
    return $detalle;
}

public static function detallenominasPadre($id, $mi_rut, $monto)
{
    $detalle = NominasDetalles::where('idnominas', $id)
    ->where('rut', $mi_rut)
    ->where('eliminado', 0)
    ->where('pagado', 0);
    if (!empty($monto)) {
        $nominas = $detalle->orderBy('monto', $monto);
    } else {
        $nominas = $detalle->orderBy('idnominasdetalle', 'desc');
    }
    return $detalle;
}

public static function detallenominas_pagadas($id, $monto)
{
    $detalle = NominasDetalles::where('idnominas', $id)
    ->where('eliminado', 0)
    ->where('pagado', 1);
    if (!empty($monto)) {
        $nominas = $detalle->orderBy('monto', $monto);
    } else {
        $nominas = $detalle->orderBy('idnominasdetalle', 'desc');
    }
    return $detalle;
}

public static function detallepuntuales($id, $idUsuarios, $monto)
{
    $detalles = Cobros::where('idCobros', $id)
    ->where('idUsuarios', $idUsuarios)
    ->where('eliminado', 0)
    ->select('idCobros', 'descripcion', 'email', 'fecha_vencimiento', 'monto', 'empresa', 'rut_empresa');

    if (!empty($monto)) {
        $detalles = $detalles->orderBy('monto', $monto);
    } else {
        $detalles = $detalles->orderBy('idCobros', 'desc');
    }

    return $detalles;
}

public static function buscar_cobro($idCobro, $idUsuario)
{
    return Cobros::where('idCobros', $idCobro)
    ->where('idUsuarios', $idUsuario)
    ->first();
}

public static function buscar_cobro_id_no_pago($idCobro)
{
    return Cobros::join('usuarios', 'usuarios.idUsuarios', '=', 'cobros.idUsuarios')
    ->where('idCobros', $idCobro)
    ->where('cobros.eliminado', 0)
    ->select('usuarios.rut as rut_cobrador', 'usuarios.nombre as reg_nombre', 'usuarios.apellido as reg_apellido', 'cobros.*')
    ->first();
}

public static function buscar_cobro_id_pagado($idCobro)
{
    return Cobros::join('usuarios', 'usuarios.idUsuarios', '=', 'cobros.idUsuarios')
    ->where('idCobros', $idCobro)
    ->where('cobros.eliminado', 0)
    ->select('usuarios.rut as rut_cobrador', 'usuarios.nombre as reg_nombre', 'usuarios.apellido as reg_apellido', 'cobros.*')
    ->first();
}

public static function ListaEmpresaPuntuales($idUsuarios, $pagada = 0, $id_hijo)
{
    if (!$pagada) {
        $empresa = Cobros::where('idUsuarios', $idUsuarios)
        ->where('pagado', 0)
        ->where('eliminado', 0);
        if (!is_null($id_hijo)) {
            $empresa = $empresa->where('idUsuarios_hijo', $id_hijo);
        }
    } else {
        $empresa = Cobros::where('idUsuarios', $idUsuarios)
        ->where('pagado', 1)
        ->where('eliminado', 0);
    }
    return $empresa;
}

public static function ListaEmpresaNomina($idUsuarios, $pagada = false)
{
    if (!$pagada) {
        $empresa = Nominas::where('idUsuarios', $idUsuarios)
        ->where('todo_pagado', 0)
        ->where('eliminado', 0);
    } else {
        $empresa = Nominas::where('idUsuarios', $idUsuarios)
        ->where('eliminado', 0);
    }
    return $empresa;
}

public static function editarCobrosPuntuales($idCobro, $idUsuario, $empresa, $rut_empresa, $descripcion, $fecha_vencimiento, $email, $monto)
{
    $rs = Cobros::where('idUsuarios', $idUsuario)
    ->where('idCobros', $idCobro)
    ->update(array(
        'empresa' => $empresa,
        'rut_empresa' => $rut_empresa,
        'descripcion' => $descripcion,
        'fecha_vencimiento' => $fecha_vencimiento,
        'email' => $email,
        'monto' => $monto
    ));
}


public static function pagarcuenta($idCuenta, $idUsuario, $monto, $fecha_pago, $nro_transaccion, $idtipopago)
{
    $rs = Cobros::where('idUsuarios', $idUsuario)
    ->where('idCobros', $idCuenta)
    ->update(array(
        'monto' => $monto,
        'fecha_pago' => $fecha_pago,
        'pagado' => 1,
        'nro_transaccion' => $nro_transaccion,
        'idTipoPago' => $idtipopago
    ));
    return $rs;
}

public static function eliminar($id)
{
    return Cobros::where('idCobros', $id)
    ->update(array(
        'eliminado' => 1
    ));
}

public static function total_cobros_pendientes($mes)
{
    $mes = (int)$mes;

    $total1 = Cobros::where('eliminado', 0)
    ->where('pagado', 0)
    ->where(DB::raw('MONTH(created_at)'), '<=', $mes)
    ->count();

    $total2 = NominasDetalles::where('eliminado', 0)
    ->where('pagado', 0)
    ->where(DB::raw('MONTH(created_at)'), '<=', $mes)
    ->count();

    return $total1 + $total2;
}

public static function editar_no_registrado($rut, $email, $empresa)
{
    return Cobros::where('rut_empresa', $rut)
    ->update(array(
        'empresa' => $empresa,
        'email' => $email
    ));
}

public static function buscar_detalle_no_pagado($id)
{
    return Cobros::join('usuarios', 'usuarios.idUsuarios', '=', 'cobros.idUsuarios')
    ->where('idcobros', $id)
    ->where('cobros.eliminado', 0)
    ->select('usuarios.nombre as reg_nombre', 'usuarios.apellido as reg_apellido', 'fecha_vencimiento', 'monto', 'idcobros AS ID', 'usuarios.idUsuarios', 'usuarios.rut', 'idunico_pago as codigo_transaccion')
    ->first();
}

public static function pagar_cuenta_no_pagada($id, $rut, $monto, $fecha_pago, $nro_transaccion, $idTipoPago)
{
    return Cobros::where('idcobros', $id)
    ->where('rut_empresa', $rut)
    ->orWhere('rut_traspaso', $rut)
    ->update(array(
        'monto' => $monto,
        'fecha_pago' => $fecha_pago,
        'nro_transaccion' => $nro_transaccion,
        'idTipoPago' => $idTipoPago,
        'pagado' => 1
    ));
}

public static function excel_nomina($idUsuarios, $id_hijo)
{
    $nominas = Nominas::join('nominasdetalle', 'nominasdetalle.idnominas', '=', 'nominas.idnominas')
    ->where('nominas.idUsuarios', $idUsuarios)
    ->where('todo_pagado', 0)
    ->where('nominasdetalle.pagado', 0)
    ->where('nominasdetalle.eliminado', 0)
    ->where('nominas.eliminado', 0)
    ->select('nominas.empresa', 'nominas.descripcion', 'nominas.fecha_vencimiento', 'nominas.created_at as fecha-de-carga', 'nominasdetalle.nombre as nombre_detalle', 'nominasdetalle.rut as rut_detalle', 'nominasdetalle.email as email_detalle', 'nominasdetalle.monto as monto_detalle', 'nominasdetalle.fecha_vencimiento as fecha_vencimiento_detalle', 'nominasdetalle.descripcion as descripcion_detalle');

    if (!is_null($id_hijo)) {
        $nominas = $nominas->where('idUsuarios_hijo', $id_hijo);
    }
    $nominas = $nominas->orderBy('nominas.idnominas', 'desc');
    return $nominas->get();
}

public static function excel_individual($idUsuario, $id_hijo)
{
    $cobros = Cobros::where('idUsuarios', $idUsuario)
    ->where('cobros.eliminado', 0)
    ->where('cobros.pagado', 0)
    ->select('empresa', 'descripcion', 'fecha_vencimiento', 'monto', 'rut_empresa as rut', 'email')
    ->groupBy('cobros.idCobros')
    ->orderBy('cobros.idCobros', 'desc');
    if (!is_null($id_hijo)) {
        $cobros = $cobros->where('idUsuarios_hijo', $id_hijo);
    }
    return $cobros->get();
}

public static function excel_cobros_pagados($idUsuario)
{

    $query = "(
    SELECT idCobros AS ID,empresa,descripcion,fecha_vencimiento,monto,fecha_pago,nro_transaccion
    FROM cobros C
    INNER JOIN usuarios U ON C.idUsuarios = U.idUsuarios
    WHERE C.eliminado = 0 AND pagado = 1 AND C.idUsuarios = ?
    UNION ALL
    SELECT D.idnominasdetalle AS ID, D.nombre AS empresa,D.descripcion,D.fecha_vencimiento,D.monto,fecha_pago,nro_transaccion
    FROM nominas N
    INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
    INNER JOIN usuarios U ON N.idUsuarios = U.idUsuarios
    WHERE N.eliminado = 0 AND pagado = 1 AND N.idUsuarios = ?
    GROUP BY N.idnominas
) AS T";
        /*
        $query = "(
                        SELECT idCobros AS ID,empresa,descripcion,fecha_vencimiento,monto,fecha_pago,nro_transaccion,'cobros cuentas_por_pagar' AS tipo
                        FROM cobros
                        WHERE eliminado = 0 AND pagado = 1 AND idUsuarios = ?
                        UNION ALL
                        SELECT N.idnominas AS ID,empresa,N.descripcion,N.fecha_vencimiento,monto_pago AS monto,fecha_pago,nro_transaccion,'nominas' AS tipo
                        FROM nominas N
                        INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
                        WHERE N.eliminado = 0 AND pagado = 1 AND N.idUsuarios = ?
                        GROUP BY N.idnominas
                    ) AS T";*/

                    $data = DB::table(DB::raw($query))
                    ->setBindings(array($idUsuario, $idUsuario))
                    ->select('ID', 'empresa', 'descripcion', 'fecha_vencimiento', 'monto', 'fecha_pago', 'nro_transaccion');

                    $data = $data->orderBy('ID', 'desc');
                    return json_decode(json_encode($data->get()), true);
                }

                public static function adjuntar_doc($idUsuarios, $id, $url_path)
                {
                    $rs = Cobros::where('idCobros', $id)
                    ->where('idUsuarios', $idUsuarios)
                    ->update(array(
                        'url_adjunto' => $url_path
                    ));
                    return $rs;
                }

                public static function editar_traspaso_detalle($id, $rut, $email)
                {
                    return Cobros::where('idCobros', $id)
                    ->update(array(
                        'rut_traspaso' => $rut,
                        'email_traspaso' => $email
                    ));
                }

                public static function cobros_por_vencer_un_dia()
                {
                    $fecha_actual = date('Y-m-d');
                    $query = "(
                    SELECT email
                    FROM cobros C
                    WHERE C.eliminado = 0 AND pagado = 0 AND date_add(C.fecha_vencimiento, INTERVAL 1 DAY) = ?
                    UNION ALL
                    SELECT email
                    FROM nominas N
                    INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
                    WHERE N.eliminado = 0 AND pagado = 0 AND date_add(D.fecha_vencimiento, INTERVAL 1 DAY) = ?
                ) AS T";

                $data = DB::table(DB::raw($query))
                ->setBindings(array($fecha_actual, $fecha_actual))
                ->distinct();
                $data = $data->get();
                $array = null;
                foreach ($data as $fila) {
                    $array[] = $fila->email;
                }
                return $array;
            }

            public static function cobros_por_vencer_tres_dias()
            {
                $fecha_actual = date('Y-m-d');
                $query = "(
                SELECT email
                FROM cobros C
                WHERE C.eliminado = 0 AND pagado = 0 AND date_add(C.fecha_vencimiento, INTERVAL 3 DAY) = ?
                UNION ALL
                SELECT email
                FROM nominas N
                INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
                WHERE N.eliminado = 0 AND pagado = 0 AND date_add(D.fecha_vencimiento, INTERVAL 3 DAY) = ?
            ) AS T";

            $data = DB::table(DB::raw($query))
            ->setBindings(array($fecha_actual, $fecha_actual))
            ->distinct();
            $data = $data->get();
            $array = null;
            foreach ($data as $fila) {
                $array[] = $fila->email;
            }
            return $array;
        }

        public static function cobros_por_vencer_una_semana()
        {
            $fecha_actual = date('Y-m-d');
            $query = "(
            SELECT email
            FROM cobros C
            WHERE C.eliminado = 0 AND pagado = 0 AND date_add(C.fecha_vencimiento, INTERVAL 7 DAY) = ?
            UNION ALL
            SELECT email
            FROM nominas N
            INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
            WHERE N.eliminado = 0 AND pagado = 0 AND date_add(D.fecha_vencimiento, INTERVAL 7 DAY) = ?
        ) AS T";

        $data = DB::table(DB::raw($query))
        ->setBindings(array($fecha_actual, $fecha_actual))
        ->distinct();
        $data = $data->get();
        $array = null;
        foreach ($data as $fila) {
            $array[] = $fila->email;
        }
        return $array;
    }

    public static function cobros_por_vencer_dos_semana()
    {
        $fecha_actual = date('Y-m-d');
        $query = "(
        SELECT email
        FROM cobros C
        WHERE C.eliminado = 0 AND pagado = 0 AND date_add(C.fecha_vencimiento, INTERVAL 14 DAY) = ?
        UNION ALL
        SELECT email
        FROM nominas N
        INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
        WHERE N.eliminado = 0 AND pagado = 0 AND date_add(D.fecha_vencimiento, INTERVAL 14 DAY) = ?
    ) AS T";

    $data = DB::table(DB::raw($query))
    ->setBindings(array($fecha_actual, $fecha_actual))
    ->distinct();
    $data = $data->get();
    $array = null;
    foreach ($data as $fila) {
        $array[] = $fila->email;
    }
    return $array;
}

public static function aviso_cobrarador_un_dia()
{
    $fecha_actual = date('Y-m-d');
    $query = "(
    SELECT U.email
    FROM cobros C
    INNER JOIN usuarios U on C.idUsuarios = U.idUsuarios
    WHERE C.eliminado = 0 AND pagado = 0 AND date_add(C.fecha_vencimiento, INTERVAL 1 DAY) = ?
    UNION ALL
    SELECT U.email
    FROM nominas N
    INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
    INNER JOIN usuarios U on N.idUsuarios = U.idUsuarios
    WHERE N.eliminado = 0 AND pagado = 0 AND date_add(D.fecha_vencimiento, INTERVAL 1 DAY) = ?
) AS T";

$data = DB::table(DB::raw($query))
->setBindings(array($fecha_actual, $fecha_actual))
->distinct();
$data = $data->get();
$array = null;
foreach ($data as $fila) {
    $array[] = $fila->email;
}
return $array;
}

public static function aviso_cobrarador_tres_dias()
{
    $fecha_actual = date('Y-m-d');
    $query = "(
    SELECT U.email
    FROM cobros C
    INNER JOIN usuarios U on C.idUsuarios = U.idUsuarios
    WHERE C.eliminado = 0 AND pagado = 0 AND date_add(C.fecha_vencimiento, INTERVAL 3 DAY) = ?
    UNION ALL
    SELECT U.email
    FROM nominas N
    INNER JOIN nominasdetalle D on N.idnominas = D.idnominas
    INNER JOIN usuarios U on N.idUsuarios = U.idUsuarios
    WHERE N.eliminado = 0 AND pagado = 0 AND date_add(D.fecha_vencimiento, INTERVAL 3 DAY) = ?
) AS T";

$data = DB::table(DB::raw($query))
->setBindings(array($fecha_actual, $fecha_actual))
->distinct();
$data = $data->get();
$array = null;
foreach ($data as $fila) {
    $array[] = $fila->email;
}
return $array;
}

public static function update_idunico_pago($id, $data)
{
    return Cobros::where('idCobros', $id)
    ->update(array(
        'idunico_pago' => $data
    ));
}

public function tipoPagos()
{
    $id = $this->idTipoPago;
    return TipoPagos::where('idTipoPago', $id)->first();
}

public function cobrador()
{
    return $this->belongsTo(Usuarios::class, 'idUsuarios', 'idUsuarios');
}

}
