<?php

namespace App\Extras;

use App\Cobros;
use App\ContenidoEmail;
use App\HistorialEmail;
use App\Usuarios;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class SendEmail
{
    public static function recuperar_password($email)
    {
        $msg = ContenidoEmail::buscar(1);
        $data = array(
            'to' => $email,
            'expira' => Crypt::encrypt(date("Y-m-d H:i:s")),
            'email' => Crypt::encrypt($email),
            'mensaje' => $msg->texto,
            'titulo' => $msg->titulo
        );
        $a = Mail::send('emails.password', $data, function ($message) use ($data) {
            $message->from('noreply@portaldepagos.cl', $data['titulo']);
            $message->to($data['to'])->subject('Portal de pagos');
        });
        if ($a) {
            $d = Usuarios::buscar_usuario_por_email($email);
            if ($d) {
                HistorialEmail::agregar($msg->titulo, $msg->texto, $d->idUsuarios, "-", 1);
            }
            return true;
        } else {
            return false;
        }
    }

    public static function enviar_email_cobrador($last_id, $user, $nombre, $id_usuario)
    {
        $msg = ContenidoEmail::buscar(2);

        $data = array(
            'url_confirmacion' => asset('/confirmco?b=' . Crypt::encrypt($last_id)),
            'nombre' => $nombre,
            'to' => $user->email,
            'mensaje' => $msg->texto,
            'titulo' => $msg->titulo,
            'cobrador' => $user->nombre
        );
        $a = Mail::send('emails.email_confirmar_cobrador', $data, function ($message) use ($data) {
            $message->from('noreply@portaldepagos.cl', "Confirmar Usuario");
            $message->to($data['to'])->subject('Portal de pagos');
        });
        if ($a) {
            HistorialEmail::agregar($msg->titulo, $msg->texto, $id_usuario, $user->email, 2);
            return true;
        } else {
            return false;
        }
    }

    public static function enviar_email_de_registro($email_para, $session_id, $session_nombre)
    {
        $msg = ContenidoEmail::buscar(3);
        $para = $email_para;
        $data = array(
            'nombre' => $session_nombre,
            'to' => $para,
            'mensaje' => $msg->texto,
            'titulo' => $msg->titulo
        );

        $a = Mail::send('emails.email_nuevoregistro', $data, function ($message) use ($data) {
            $message->from('noreply@portaldepagos.cl', 'Portal de Pagos');
            $message->to($data['to'])->subject($data['titulo']);
        });

        if ($a) {
            HistorialEmail::agregar($msg->titulo, $msg->texto, $session_id, $para, 3);
            return true;
        } else {
            return false;
        }
    }

    public static function nuevo_registro($email, $nombre)
    {
        $msg = ContenidoEmail::buscar(4);
        $data = array(
            'to' => $email,
            'nombre' => $nombre,
            'titulo' => $msg->titulo,
            'url_active' => asset('/active?b=' . Crypt::encrypt($email)),
        );

        $a = Mail::send('emails.email_bienvenida', $data, function ($message) use ($data) {
            $message->from('noreply@portaldepagos.cl', 'Portal de Pagos');
            $message->to($data['to'])->subject($data['titulo']);
        });

        if ($a) {
            $d = Usuarios::buscar_usuario_por_email($email);
            if ($d) {
                HistorialEmail::agregar($msg->titulo, "...", $d->idUsuarios, "-", 4);
            }
        }
    }

    public static function edicion_cuenta($email, $nombre)
    {
        $msg = ContenidoEmail::buscar(5);
        $data = array(
            'to' => $email,
            'nombre' => $nombre,
            'titulo' => $msg->titulo
        );

        $a = Mail::send('emails.email_datos_cambiado', $data, function ($message) use ($data) {
            $message->from('noreply@portaldepagos.cl', 'Portal de pagos');
            $message->to($data['to'])->subject($data['titulo']);
        });

        if ($a) {
            $d = Usuarios::buscar_usuario_por_email($email);
            if ($d) {
                HistorialEmail::agregar($msg->titulo, "...", $d->idUsuarios, "-", 5);
            }
        }
    }

    public static function aviso_nuevo_cobro($email, $session_nombre, $de, $fecha_vencimiento, $deudor, $archivo = null, $cobro_id = null, $datos_deudor = null, $rut = null)
    {
        $msg = ContenidoEmail::buscar(6);
        $data = array(
            'to' => $email,
            'empresa' => $session_nombre,
            'nombre' => $session_nombre,
            'titulo' => $msg->titulo . " - " . $session_nombre,
            'fecha_vencimiento' => $fecha_vencimiento,
            'deudor' => $deudor,
            'archivo' => $archivo
        );
        if ($cobro_id) {
            $data["cobro_id"] = $cobro_id;
        }
        if ($datos_deudor) {
            $data['registrado'] = true;
        }
        if ($rut) {
            $data['rut'] = base64_encode($rut);
        }
        $a = Mail::send('emails.email_aviso_nuevo_cobro', $data, function ($message) use ($data) {
            $message->from('noreply@portaldepagos.cl', 'Portal de Pagos');
            $message->to($data['to'])->subject( $data['titulo']);
            if (!empty($data['archivo'])) {
                $message->attach($data['archivo']);
            }
        });
        if ($a) {
            $d = Usuarios::buscar_usuario_por_email($email);
            if ($d) {
                HistorialEmail::agregar_de($msg->titulo, "...", $d->idUsuarios, "-", 6, $de);
            }
        }
    }

    public static function aviso_cobro_editado($email, $session_nombre, $de, $fecha_vencimiento, $monto, $deudor, $nombre)
    {
        $data = array(
            'to' => $email,
            'empresa' => $session_nombre,
            'titulo' => "Actualización de deuda",
            'fecha_vencimiento' => $fecha_vencimiento,
            'monto' => $monto,
            'deudor' => $deudor,
            'nombre' => $nombre
        );

        $a = Mail::send('emails.email_cobro_editado', $data, function ($message) use ($data) {
            $message->from('noreply@portaldepagos.cl', 'Portal de Pagos');
            $message->to($data['to'])->subject($data['titulo']);
        });
    }

    public static function aviso_cambio_clave($usuario)
    {
        $data = array(
            'to' => $usuario->email,
            'nombre' => $usuario->nombre,
            'titulo' => "Cambio de contraseña realizado"
        );

        $a = Mail::send('emails.email_cambio_clave', $data, function ($message) use ($data) {
            $message->from('noreply@portaldepagos.cl', 'Portal de Pagos');
            $message->to($data['to'])->subject($data['titulo']);
        });
    }

    public static function nuevo_archivo_adjunto($email, $empresa, $de, $archivo = null)
    {
        $msg = ContenidoEmail::buscar(7);
        $data = array(
            'to' => $email,
            'empresa' => $empresa,
            'titulo' => $msg->titulo,
            'archivo' => $archivo
        );
        $a = Mail::send('emails.email_nuevo_archivo', $data, function ($message) use ($data) {
            $message->from('noreply@portaldepagos.cl', 'Portal de pagos');
            $message->to($data['to'])->subject($data['titulo']);
            if (!empty($data['archivo'])) {
                $message->attach($data['archivo']);
            }
        });
        if ($a) {
            $d = Usuarios::buscar_usuario_por_email($email);
            if ($d) {
                HistorialEmail::agregar_de($msg->titulo, "...", $d->idUsuarios, "-", 7, $de);
            }
        }
    }

    public static function aviso_vencimientos($dia)
    {
        $msg = ContenidoEmail::buscar(8);
        $emails = Cobros::cobros_por_vencer_un_dia();
        if (count($emails) > 0) {
            $data = array(
                'to' => "noreply@portaldepagos.cl",
                'dia' => $dia,
                'emails' => $emails,
                'nombre' => '',
                'url_active' => 'http://portaldepagos.cl/',
                'titulo' => $msg->titulo
            );
            $a = Mail::send('emails.email_aviso_vencimiento_deudor', $data, function ($message) use ($data) {
                $message->from('noreply@portaldepagos.cl', 'Portal de pagos')->bcc($data['emails']);
                $message->to($data['to'])->subject($data['titulo']);
            });
            if ($a) {
                foreach ($emails as $data) {
                    $d = Usuarios::buscar_usuario_por_email($data);
                    if ($d) {
                        HistorialEmail::agregar($msg->titulo, "", $d->idUsuarios, "-", 8);
                    }
                }
            }
        }
    }

    public static function aviso_vencimiento_tres_dias()
    {
        $dia = 3;
        $msg = ContenidoEmail::buscar(9);
        $emails = Cobros::cobros_por_vencer_tres_dias();
        if (count($emails) > 0) {
            $data = array(
                'to' => "noreply@portaldepagos.cl",
                'dia' => $dia,
                'emails' => $emails,
                'nombre' => '',
                'url_active' => 'http://portaldepagos.cl/',
                'titulo' => $msg->titulo
            );
            $a = Mail::send('emails.email_aviso_vencimiento_deudor', $data, function ($message) use ($data) {
                $message->from('noreply@portaldepagos.cl', 'Portal de pagos')->bcc($data['emails']);
                $message->to($data['to'])->subject($data['titulo']);
            });
            if ($a) {
                foreach ($emails as $data) {
                    $d = Usuarios::buscar_usuario_por_email($data);
                    if ($d) {
                        HistorialEmail::agregar($msg->titulo, "", $d->idUsuarios, "-", 9);
                    }
                }
            }
        }
    }

    public static function aviso_vencimiento_una_semana()
    {
        $dia = 7;
        $msg = ContenidoEmail::buscar(10);
        $emails = Cobros::cobros_por_vencer_una_semana();
        if (count($emails) > 0) {
            $data = array(
                'to' => "noreply@portaldepagos.cl",
                'dia' => $dia,
                'emails' => $emails,
                'nombre' => '',
                'url_active' => 'http://portaldepagos.cl/',
                'titulo' => $msg->titulo
            );
            $a = Mail::send('emails.email_aviso_vencimiento_deudor', $data, function ($message) use ($data) {
                $message->from('noreply@portaldepagos.cl', 'Portal de pagos')->bcc($data['emails']);
                $message->to($data['to'])->subject($data['titulo']);
            });
            if ($a) {
                foreach ($emails as $data) {
                    $d = Usuarios::buscar_usuario_por_email($data);
                    if ($d) {
                        HistorialEmail::agregar($msg->titulo, "", $d->idUsuarios, "-", 10);
                    }
                }
            }
        }
    }

    public static function aviso_vencimiento_dos_semana()
    {
        $dia = 14;
        $msg = ContenidoEmail::buscar(11);
        $emails = Cobros::cobros_por_vencer_dos_semana();
        if (count($emails) > 0) {
            $data = array(
                'to' => "noreply@portaldepagos.cl",
                'dia' => $dia,
                'emails' => $emails,
                'nombre' => '',
                'url_active' => 'http://portaldepagos.cl/',
                'titulo' => $msg->titulo
            );
            $a = Mail::send('emails.email_aviso_vencimiento_deudor', $data, function ($message) use ($data) {
                $message->from('noreply@portaldepagos.cl', 'Portal de pagos')->bcc($data['emails']);
                $message->to($data['to'])->subject($data['titulo']);
            });
            if ($a) {
                foreach ($emails as $data) {
                    $d = Usuarios::buscar_usuario_por_email($data);
                    if ($d) {
                        HistorialEmail::agregar($msg->titulo, "", $d->idUsuarios, "-", 11);
                    }
                }
            }
        }
    }

    public static function aviso_cobrador_nuevo_vencimiento_un_dia()
    {
        $dias = 1;
        $msg = ContenidoEmail::buscar(12);
        $emails = Cobros::aviso_cobrarador_un_dia();
        if (count($emails) > 0) {
            $data = array(
                'to' => "noreply@portaldepagos.cl",
                'dias' => $dias,
                'emails' => $emails,
                'nombre' => '',
                'titulo' => $msg->titulo
            );
            $a = Mail::send('emails.email_aviso_cobrador', $data, function ($message) use ($data) {
                $message->from('noreply@portaldepagos.cl', 'Portal de pagos')->bcc($data['emails']);
                $message->to($data['to'])->subject($data['titulo']);
            });
            if ($a) {
                foreach ($emails as $data) {
                    $d = Usuarios::buscar_usuario_por_email($data);
                    if ($d) {
                        HistorialEmail::agregar($msg->titulo, "", $d->idUsuarios, "-", 12);
                    }
                }
            }
        }
    }

    public static function aviso_cobrador_nuevo_vencimiento_tres_dias()
    {
        $dias = 1;
        $msg = ContenidoEmail::buscar(13);
        $emails = Cobros::aviso_cobrarador_tres_dias();
        if (count($emails) > 0) {
            $data = array(
                'to' => "noreply@portaldepagos.cl",
                'dias' => $dias,
                'nombre' => '',
                'emails' => $emails,
                'titulo' => $msg->titulo
            );
            $a = Mail::send('emails.email_aviso_cobrador', $data, function ($message) use ($data) {
                $message->from('noreply@portaldepagos.cl', 'Portal de pagos')->bcc($data['emails']);
                $message->to($data['to'])->subject($data['titulo']);
            });
            if ($a) {
                foreach ($emails as $data) {
                    $d = Usuarios::buscar_usuario_por_email($data);
                    if ($d) {
                        HistorialEmail::agregar($msg->titulo, "", $d->idUsuarios, "-", 13);
                    }
                }
            }
        }
    }

    public static function enviar_email_contacto($motivo, $celular, $solucion, $rut, $nombre, $email, $mensaje)
    {
        $data = array(
            'to' => $email,
            'titulo' => 'nuevo contacto',
            'motivo' => $motivo,
            'celular' => $celular,
            'solucion' => $solucion,
            'rut' => $rut,
            'nombre' => $nombre,
            'email' => $email,
            'mensaje' => $mensaje
        );
        $a = Mail::send('emails.email_contacto', $data, function ($message) use ($data) {
            $message->from('atencion@portaldepagos.cl', 'Portal de pagos');
            $message->to('atencion@portaldepagos.cl')->subject($data['titulo']);
        });
        if ($a) {
            return true;
        } else {
            return false;
        }
    }
}

?>
