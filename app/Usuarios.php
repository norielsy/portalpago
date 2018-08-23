<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\DB;

class Usuarios extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'idUsuarios';

    protected $fillable = ['rut', 'nombre', 'nro_direccion', 'complemento', 'referencia', 'email', 'passwordp', 'email_alternativo', 'apellido', 'razon_social'];
    protected $hidden = ['passwordp', 'remember_token'];

    public function setPasswordpAttribute($value)
    {
        if (!empty($value))
            $this->attributes['passwordp'] = \Hash::make($value);
    }

    public static function buscar_usuario_por_rut($rut)
    {
        return Usuarios::where('rut', $rut)
            ->select('usuarios.*',
                DB::raw('(SELECT L.created_at FROM logaccesos L  WHERE L.idUsuarios = usuarios.idUsuarios  ORDER BY L.IDLogAcceso DESC LIMIT 1) AS ultimo_log'))
            ->first();
    }

    public static function buscar_usuario_por_id($id)
    {
        return Usuarios::where('eliminado', 0)
            ->where('idUsuarios', $id)
            ->first();
    }

    public static function buscar_usuario_por_email($email)
    {
        return Usuarios::where('eliminado', 0)
            ->where('email', $email)
            ->first();
    }

    public static function total_usuarios_mes($mes)
    {
        $mes = (int)$mes;
        return Usuarios::where('eliminado', 0)
            ->where(DB::raw('MONTH(created_at)'), $mes)
            ->count();
    }

    public static function crear_usuario_admin($nombre, $email, $telefono, $celular, $password, $rut, $direccion, $region, $giro, $apellido, $razon_social)
    {
        $tabla = new Usuarios();
        $tabla->nombre = $nombre;
        $tabla->email = $email;
        $tabla->telefono = $telefono;
        $tabla->celular = $celular;
        $tabla->passwordp = $password;
        $tabla->rut = $rut;
        $tabla->direccion = $direccion;
        $tabla->IDRegion = $region;
        $tabla->idrubros = $giro;
        $tabla->apellido = $apellido;
        $tabla->razon_social = $razon_social;

        $tabla->save();
        return $tabla->idUsuarios;
    }

    public static function editar($id, $nombre, $email, $telefono, $celular, $direccion, $IDRegion, $idrubros, $tipo_usuario, $rut_hijo, $apellido, $razon_social)
    {
        $rs = Usuarios::where('idUsuarios', $id)
            ->update(array(
                'nombre' => $nombre,
                'email' => $email,
                'telefono' => $telefono,
                'celular' => $celular,
                'direccion' => $direccion,
                'IDRegion' => $IDRegion,
                'idrubros' => $idrubros,
                'apellido' => $apellido,
                'razon_social' => $razon_social
            ));
        return $rs;
    }

    public static function eliminar($id)
    {
        $rs = Usuarios::where('idUsuarios', $id)
            ->update(array(
                'eliminado' => 1
            ));
        return $rs;
    }

    public static function reactivar_usuario($id)
    {
        $rs = Usuarios::where('idUsuarios', $id)
            ->update(array(
                'eliminado' => 0
            ));
        return $rs;
    }

    public static function buscar_usuario_noregistrado($id, $from)
    {
        if ($from == "nomina") {
            return NominasDetalles::join('nominas', 'nominas.idnominas', '=', 'nominasdetalle.idnominas')
                ->join('usuarios', 'usuarios.idUsuarios', '=', 'nominas.idUsuarios')
                ->where('idnominasdetalle', $id)
                ->where('nominasdetalle.eliminado', 0)
                ->select('nominasdetalle.rut', 'nominasdetalle.nombre', 'nominasdetalle.email', 'nominasdetalle.created_at as fecha_registro', 'usuarios.nombre as nombre_ing', 'usuarios.apellido as apellido_ing')
                ->first();
        } else if ($from == "cobros") {
            return Cobros::join('usuarios', 'usuarios.idUsuarios', '=', 'cobros.idUsuarios')
                ->where('idCobros', $id)
                ->where('cobros.eliminado', 0)
                ->select('rut_empresa as rut', 'empresa as nombre', 'cobros.email', 'cobros.created_at as fecha_registro', 'usuarios.nombre as nombre_ing', 'usuarios.apellido as apellido_ing')
                ->first();
        }
    }

    public static function count_deudas_por_rut($rut)
    {
        $tabla = Usuarios::select('*')
            ->from(DB::raw("(
                                        SELECT rut_empresa
                                        FROM (
                                        SELECT rut_empresa
                                        FROM cobros
                                        WHERE pagado = 0 AND eliminado = 0 AND rut_empresa = '" . $rut . "'
                                        UNION ALL
                                        SELECT rut
                                        FROM nominasdetalle
                                        WHERE pagado = 0 AND eliminado = 0 AND rut = '" . $rut . "'
                                        ) AS B
                                        ) AS C"))
            ->count();
        return $tabla;
    }

    public static function TablaAdminUsuarios($rut, $type)
    {
        $tabla = Usuarios::select('*')
            ->from(DB::raw("(
                                SELECT rut,email,nombre,idUsuarios,'usuario' as type, 'nulo' as dest,
                                (SELECT idperfiles_cobrado FROM vistas_cobradores V WHERE V.idUsuarios = usuarios.idUsuarios AND idperfiles_cobrado = 1 LIMIT 1) AS consultor,
                                (SELECT idperfiles_cobrado FROM vistas_cobradores V WHERE V.idUsuarios = usuarios.idUsuarios AND idperfiles_cobrado = 2 LIMIT 1) AS operativo,
                                (SELECT idCobros FROM cobros V WHERE V.rut_empresa = usuarios.rut AND pagado = 0 AND eliminado = 0 LIMIT 1) AS deudor1,
                                (SELECT idnominasdetalle FROM nominasdetalle V WHERE V.rut = usuarios.rut AND pagado = 0 AND eliminado = 0 LIMIT 1) AS deudor2,
                                created_at
                                FROM `usuarios`
                                WHERE eliminado = 0
                                UNION ALL
                                SELECT DISTINCT(rut_empresa),email,empresa,ID,'noregistrado' as type,dest, null AS consultor, null AS operativo, 1 as deudor1, 1 as deudor2, created_at
                                FROM (
                                SELECT rut_empresa,email,empresa,idCobros as ID, 'cobros' as dest, created_at
                                FROM cobros
                                WHERE pagado = 0 AND eliminado = 0
                                UNION ALL
                                SELECT rut,email,nombre,idnominasdetalle AS ID, 'nomina' as dest, created_at
                                FROM nominasdetalle
                                WHERE pagado = 0 AND eliminado = 0
                                ) AS B
                                ) AS C"))
            ->groupBy('rut')
            ->orderBy('idUsuarios', 'desc');


        if (!empty($rut)) {
            $tabla->where('rut', $rut);
        }

        if (!is_null($type)) {
            if ($type == "deudor") {
                $tabla->orWhere('deudor1', '>', 0);
                $tabla->orWhere('deudor2', '>', 0);
            }

            if ($type == "operador") {
                $tabla->where('operativo', '>', 0);
            }

            if ($type == "consultor") {
                $tabla->where('consultor', '>', 0);
            }
        }
        return $tabla;
    }

    public static function cambiar_password($email, $password)
    {
        return Usuarios::where('eliminado', 0)
            ->where('email', $email)
            ->update(array(
                'passwordp' => $password
            ));
    }

    public static function listar_usuarios()
    {
        return Usuarios::where('eliminado', 0)
            ->selectRaw('CONCAT(CONCAT(nombre, " ",apellido)," (",rut,")") as detalle,idUsuarios')
            ->lists('detalle', 'idUsuarios');
    }

    public static function activar_usuario($email)
    {
        return Usuarios::where('email', $email)
            ->update(array(
                'activo' => 1
            ));
    }
}

?>