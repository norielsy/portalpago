<?php



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

function sendEmail($body = '', $to = null, $from = '', $subject = '')
{
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'user@example.com';                 // SMTP username
        $mail->Password = 'secret';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom($from);
        if (is_array($to)) {
            foreach ($to as $key => $value) {
                if (is_string($key)) {
                    $mail->addAddress($value, $key);
                }
                if (is_int($key)) {
                    if (is_string($value)) {
                        $mail->addAddress($value);
                    }
                    if (is_array($value)) {
                        $mail->addAddress($value['email'], $value['nombre']);
                    }
                }
            }
        }
        if (is_string($to)) {
            $mail->addAddress($to);
        }
        //$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}

function obtener_campo($msg, $str1, $str2, $offset1, $offset2)
{

    $pos1 = strpos($msg, $str1);
    $pos1 += $offset1;
    $txt = substr($msg, $pos1, 1000);
    $pos2 = strpos($txt, $str2);
    $pos2 = $pos2 - $offset2;

    $campo = substr($txt, 0, $pos2);
    $campo = str_replace(":", "", $campo);
    $campo = trim($campo);
    $campo = str_replace("&nbsp;", "", $campo);
    $campo = str_replace("*", "", $campo);
    $campo = str_replace("=", "", $campo);
    $campo = trim($campo);

    return $campo;
}

function obtener_tipo_a_pagar($id_transaccion)
{
    $data = explode('P', $id_transaccion);
    $total = count($data);
    return ($total >= 2) ? $data[0] : 0;
}

function obtener_id_descripcion($string)
{
    $pattern = "/(P|p)ortal de pago?.*:\s?([^\s]+)/";
    preg_match($pattern, $string, $matches);
    $total = count($matches);
    return ($total > 2) ? $matches[2] : "codigo no encontrado";
}

ini_set("max_execution_time", 360);

print "A";

include "connect.php";

print "B";
//$gmail_inbox = imap_open('{imap.gmail.com:993/imap/ssl}INBOX', "transferencias.portal@gmail.com", "pagos2015") or die('Cannot connect to Gmail: ' . imap_last_error());
//$gmail_inbox = imap_open('{imap.gmail.com:993/imap/ssl}INBOX', "transferencias@portaldepagos.cl", "pagos2015") or die('Cannot connect to Gmail: ' . imap_last_error());


/* connect to server */
$hostname = "{mail.portaldepagos.cl:993/imap/ssl/novalidate-cert}INBOX";
//$username = "transferencias@portaldepagos.cl";
//$password = "pagos2015";

$username = "pago@portaldepagos.cl";
$password = "=Xzi;61PL$.,";
$gmail_inbox = imap_open($hostname, $username, $password) or die('Cannot connect to Mail: ' . imap_last_error());

$n_msgs = imap_num_msg($gmail_inbox);
$new_message = true;

print "Leyendo mensajes, cantidad: " . $n_msgs;

while ($new_message && $n_msgs > 0) {

    print "<br>" . $n_msgs;

    $cabecera = imap_headerinfo($gmail_inbox, $n_msgs);
    /*
            foreach ($cabecera as $key => $value) {

                if (is_array($value)){
                    print $key . "=>";
                    print_r($value);
                    print "<br>";
                }else{
                    print_r ($key . "=>" . $value . "<br>");

                }
            }
    */

    $senderaddress = $cabecera->senderaddress;
    $sender = $cabecera->sender;
    $host = $sender[0]->host;
    //COMENTAR:
    //$host = "santander.cl";

    $subject = $cabecera->subject;
    $udate = $cabecera->udate;

    $msg_html = imap_body($gmail_inbox, $n_msgs);

//print $msg_html . "<br>" . $host . "<br>";

    $msg = strip_tags($msg_html);
    $msg = preg_replace('/\s+/', ' ', $msg);

    print  $host . "<br>";

    /* Verificar por Base de datos si el mensaje es nuevo o no comparándolo con los mails último mail recibido y almacenado:*/
    $sql = "SELECT `id`, `host`, `value`, `bank`, `remite`, `unix_time` FROM `transferencias_info` WHERE unix_time = '$udate' ORDER BY id DESC LIMIT 1;";

    //$result=mysql_query($sql, $conexion);
    $result = $mysqli->query($sql);
    $last_udate = "";
    $new_message = true;
    while ($row = $result->fetch_assoc()) {
        //$last_udate = $row["unix_time"];
        $new_message = false;
    }

    //if ($udate==$last_udate){
    //no hay nuevos mensajes
    /*DESCOMENTAR:*/
    //	$new_message =  false;
    //}

    if ($new_message) {
        $bank = "";


        /*******************************************
         *
         * BANCO SANTANDER
         ********************************************/


        if ($host == "santander.cl") {
            $bank = "Banco Santander";

            print "<br><br>Nuevo mail de transferencia desde Banco Santander:";
            //obtener info desde el texto completo:
            //Para obtener el nombre del depositante:
            //nuestro(a) cliente  XXXXXX ha instruído una transferencia
            $pos1 = strpos($msg, "nuestro(a) cliente");
            $pos1 += 19;
            $txt = substr($msg, $pos1, 1000);
            $pos2 = strpos($txt, "transferencia");
            $pos2 = $pos2 - 25;
            $nombre_depositante = substr($txt, 0, $pos2);
            $nombre_depositante = str_replace("&nbsp;", "", $nombre_depositante);
            $nombre_depositante = str_replace("*", "", $nombre_depositante);
            $nombre_depositante = trim($nombre_depositante);

            print ("<BR>" . $nombre_depositante);

            //Para obtener el nombre del destinatario del dinero:
            //Estimado(a) XXXXXX :
            $pos1 = strpos($msg, "Estimado(a)");
            $pos1 += 11;
            $txt = substr($msg, $pos1, 1000);
            $pos2 = strpos($txt, ":");
            $pos2 = $pos2;
            $nombre_destinatario = substr($txt, 0, $pos2);
            $nombre_destinatario = str_replace("&nbsp;", "", $nombre_destinatario);
            $nombre_destinatario = str_replace("*", "", $nombre_destinatario);
            $nombre_destinatario = trim($nombre_destinatario);

            print ("<BR>" . $nombre_destinatario);


            //Para obtener los siguientes datos:
            //<TD width='176' nowrap>: <B> XXXXXXXX </B></TD>
            //Primera ocurrencia: Banco de destino
            $pos1 = strpos($msg, "Banco de destino");
            $pos1 += 17;
            $txt = substr($msg, $pos1, 1000);
            $pos2 = strpos($txt, "Cuenta");
            //$pos2 = $pos2;

            $nombre_banco = substr($txt, 0, $pos2);
            $nombre_banco = str_replace(":", "", $nombre_banco);
            $nombre_banco = trim($nombre_banco);
            $nombre_banco = str_replace("&nbsp;", "", $nombre_banco);
            $nombre_banco = str_replace("*", "", $nombre_banco);
            $nombre_banco = trim($nombre_banco);

            print ("<BR>" . $nombre_banco);


            //Segunda ocurrencia: Cuenta de destino
            $pos1 = strpos($msg, "Cuenta de destino");
            $pos1 += 17;
            $txt = substr($msg, $pos1, 1000);
            $pos2 = strpos($txt, "Rut destinatario");
            //$pos2 = $pos2;

            $cuenta_destino = substr($txt, 0, $pos2);
            $cuenta_destino = str_replace(":", "", $cuenta_destino);
            $cuenta_destino = trim($cuenta_destino);
            $cuenta_destino = str_replace("&nbsp;", "", $cuenta_destino);
            $cuenta_destino = str_replace("*", "", $cuenta_destino);
            $cuenta_destino = trim($cuenta_destino);

            print ("<BR>" . $cuenta_destino);


            //Tercera ocurrencia: Rut destinatario
            $pos1 = strpos($msg, "Rut destinatario");
            $pos1 += 17;
            $txt = substr($msg, $pos1, 1000);
            $pos2 = strpos($txt, "Monto de la");
            //$pos2 = $pos2;

            $rut_destinatario = substr($txt, 0, $pos2);
            $rut_destinatario = str_replace(":", "", $rut_destinatario);
            $rut_destinatario = trim($rut_destinatario);
            $rut_destinatario = str_replace("&nbsp;", "", $rut_destinatario);
            $rut_destinatario = str_replace("*", "", $rut_destinatario);
            $rut_destinatario = trim($rut_destinatario);

            print ("<BR>" . $rut_destinatario);

            //Cuarta ocurrencia: Monto operación
            $pos1 = strpos($msg, "Monto de la");
            $pos1 += 28;
            $txt = substr($msg, $pos1, 1000);
            $pos2 = strpos($txt, "Nuestro Cliente");
            //$pos2 = $pos2;

            $monto_operacion = substr($txt, 0, $pos2);
            $monto_operacion = str_replace(":", "", $monto_operacion);
            $monto_operacion = str_replace("$", "", $monto_operacion);
            $monto_operacion = str_replace(".", "", $monto_operacion);
            $monto_operacion = trim($monto_operacion);
            $monto_operacion = str_replace("&nbsp;", "", $monto_operacion);
            $monto_operacion = str_replace("*", "", $monto_operacion);
            $monto_operacion = trim($monto_operacion);

            print ("<BR>" . $monto_operacion);


            //Para obtener La glosa:
            $pos1 = strpos($msg, "siguiente comentario:");
            $pos1 += 21;
            $txt = substr($msg, $pos1, 1000);
            $pos2 = strpos($txt, "Atentamente");
            //$pos2 = $pos2;

            $glosa = substr($txt, 0, $pos2);
            $glosa = str_replace(":", "", $glosa);
            $glosa = trim($glosa);
            $glosa = str_replace("&nbsp;", "", $glosa);
            $glosa = str_replace("*", "", $glosa);
            $glosa = trim($glosa);

            print ("<BR>" . $glosa);


        }

        /*******************************************
         *
         * BANCO ESTADO
         ********************************************/


        if ($host == "bancoestado.cl") {
            $bank = "Banco Estado";

            print "<br><br>Nuevo mail de transferencia desde Banco Estado: <br><br><br>"; //$msg
            //obtener info desde el texto completo:
            //Para obtener el nombre del depositante:
            //nuestro(a) cliente  XXXXXX ha instruído una transferencia

            $pos1 = strpos($msg, "nuestro(a) cliente");
            $pos1 += 19;
            $txt = substr($msg, $pos1, 1000);
            $pos2 = strpos($txt, "con los");
            $pos2 = $pos2;
            $nombre_depositante = substr($txt, 0, $pos2);
            $nombre_depositante = str_replace("&nbsp;", "", $nombre_depositante);
            $nombre_depositante = str_replace("*", "", $nombre_depositante);
            $nombre_depositante = trim($nombre_depositante);

            print ("<BR>" . $nombre_depositante);

            //Para obtener el nombre del destinatario del dinero:
            //Estimado(a) XXXXXX :
            $pos1 = strpos($msg, "Estimado(a)");
            $pos1 += 11;
            $txt = substr($msg, $pos1, 1000);
            $pos2 = strpos($txt, ":");
            $pos2 = $pos2;
            $nombre_destinatario = substr($txt, 0, $pos2);
            $nombre_destinatario = str_replace("&nbsp;", "", $nombre_destinatario);
            $nombre_destinatario = str_replace("*", "", $nombre_destinatario);
            $nombre_destinatario = str_replace("=", "", $nombre_destinatario);
            $nombre_destinatario = trim($nombre_destinatario);

            print ("<BR>" . $nombre_destinatario);


            //Para obtener los siguientes datos:
            //<TD width='176' nowrap>: <B> XXXXXXXX </B></TD>
            //Primera ocurrencia: Banco de destino
            $pos1 = strpos($msg, "Banco");
            $pos1 += 7;
            $txt = substr($msg, $pos1, 1000);
            $pos2 = strpos($txt, "cuenta:");
            $pos2 = $pos2 - 12;

            //print "**" . $txt . "**";

            $nombre_banco = substr($txt, 0, $pos2);
            $nombre_banco = str_replace(":", "", $nombre_banco);
            $nombre_banco = trim($nombre_banco);
            $nombre_banco = str_replace("&nbsp;", "", $nombre_banco);
            $nombre_banco = str_replace("*", "", $nombre_banco);
            $nombre_banco = str_replace("=", "", $nombre_banco);
            $nombre_banco = trim($nombre_banco);

            print ("<BR>" . $nombre_banco);


            //Segunda ocurrencia: Cuenta de destino
            $pos1 = strpos($msg, "cuenta:");
            $pos1 += 8;
            $txt = substr($msg, $pos1, 1000);
            $cuenta_destino = "";
            $x = 0;
            for ($x = 0; $x < strlen($txt); $x++) {
                if ($txt[$x] == " " || $txt[$x] == "&")
                    break;
                $cuenta_destino .= $txt[$x];

            }

            /*
            print ("<BR>*" . $txt);

            $pos2 = strpos($txt , " Comentario: ");
            $pos2 = $pos2 - 13;

            $cuenta_destino = substr($txt, 0, $pos2);
            $cuenta_destino = str_replace(":", "", $cuenta_destino);
            $cuenta_destino = trim($cuenta_destino);
            $cuenta_destino = str_replace("&nbsp;", "", $cuenta_destino);
            $cuenta_destino = str_replace("*", "", $cuenta_destino);
            $cuenta_destino = trim($cuenta_destino);
            */
            print ("<BR>" . $cuenta_destino);


            //Tercera ocurrencia: Rut destinatario
            $pos1 = strpos($msg, "RUT:");
            $pos1 += 4;
            $txt = substr($msg, $pos1, 1000);
            $pos2 = strpos($txt, "Banco");
            //$pos2 = $pos2;

            $rut_destinatario = substr($txt, 0, $pos2);
            $rut_destinatario = str_replace(":", "", $rut_destinatario);
            $rut_destinatario = trim($rut_destinatario);
            $rut_destinatario = str_replace("&nbsp;", "", $rut_destinatario);
            $rut_destinatario = str_replace("*", "", $rut_destinatario);
            $rut_destinatario = str_replace("=2E", "", $rut_destinatario);
            $rut_destinatario = str_replace("=", "", $rut_destinatario);

            $rut_destinatario = trim($rut_destinatario);

            print ("<BR>" . $rut_destinatario);

            //Cuarta ocurrencia: Monto operación
            $pos1 = strpos($msg, "Transferido");
            $pos1 += 13;
            $txt = substr($msg, $pos1, 1000);
            $pos2 = strpos($txt, "Detalles");
            //$pos2 = $pos2;

            $monto_operacion = substr($txt, 0, $pos2);
            $monto_operacion = str_replace(":", "", $monto_operacion);
            $monto_operacion = str_replace("$", "", $monto_operacion);
            $monto_operacion = str_replace(".", "", $monto_operacion);
            $monto_operacion = trim($monto_operacion);
            $monto_operacion = str_replace("&nbsp;", "", $monto_operacion);
            $monto_operacion = str_replace("*", "", $monto_operacion);
            $monto_operacion = trim($monto_operacion);

            print ("<BR>" . $monto_operacion);


            //Para obtener La glosa:
            $pos1 = strpos($msg, "Comentario");
            $pos1 += 11;
            $txt = substr($msg, $pos1, 1000);
            $pos2 = strpos($txt, "&nb");
            //$pos2 = $pos2;

            $glosa = substr($txt, 0, $pos2);
            $glosa = str_replace(":", "", $glosa);
            $glosa = trim($glosa);
            $glosa = str_replace("&nbsp;", "", $glosa);
            $glosa = str_replace("*", "", $glosa);
            $glosa = str_replace("=", "", $glosa);
            $glosa = trim($glosa);

            print ("<BR>" . $glosa);


        }


        /*******************************************
         *
         * BANCO BCI
         ********************************************/

        if ($host == "bci.cl") {
            $bank = "Banco Crédito e Inversiones";

            print "<br><br>Nuevo mail de transferencia desde BCI:  <br><br><br>"; //$msg
            //obtener info desde el texto completo:
            //Para obtener el nombre del depositante:
            //nuestro(a) cliente  XXXXXX ha instruído una transferencia

            $pos1 = strpos($msg, "Titular de la cuenta de origen");
            $pos1 += 32;
            $txt = substr($msg, $pos1, 1000);
            $pos2 = strpos($txt, "Banco de origen");
            $pos2 = $pos2;
            $nombre_depositante = substr($txt, 0, $pos2);
            $nombre_depositante = str_replace("&nbsp;", "", $nombre_depositante);
            $nombre_depositante = str_replace("*", "", $nombre_depositante);
            $nombre_depositante = trim($nombre_depositante);

            print ("<BR>" . $nombre_depositante);

            //Para obtener el nombre del destinatario del dinero:
            //Estimado(a) XXXXXX :
            $pos1 = strpos($msg, "Content-Transfer-Encoding: 7bit");
            $pos1 += 32;
            $txt = substr($msg, $pos1, 500);
            $pos2 = strpos($txt, ":");
            $pos2 = $pos2;
            $nombre_destinatario = substr($txt, 0, $pos2);
            $nombre_destinatario = str_replace("&nbsp;", "", $nombre_destinatario);
            $nombre_destinatario = str_replace("*", "", $nombre_destinatario);
            $nombre_destinatario = str_replace("=", "", $nombre_destinatario);
            $nombre_destinatario = trim($nombre_destinatario);

            print ("<BR>" . $nombre_destinatario);


            //Para obtener los siguientes datos:
            //<TD width='176' nowrap>: <B> XXXXXXXX </B></TD>
            //Primera ocurrencia: Banco de destino
            $pos1 = strpos($msg, "Content-Transfer-Encoding: 7bit");
            $txt = $txt = substr($msg, $pos1, 2000);;
            $pos1 = strpos($txt, ",");
            $pos1 += 12;
            $txt = substr($txt, $pos1, 1000);
            $pos2 = strpos($txt, "Monto transferido");
            //$pos2 = $pos2 - 12;


            $nombre_banco = substr($txt, 0, $pos2);
            $nombre_banco = str_replace(":", "", $nombre_banco);
            $nombre_banco = trim($nombre_banco);
            $nombre_banco = str_replace("&nbsp;", "", $nombre_banco);
            $nombre_banco = str_replace("*", "", $nombre_banco);
            $nombre_banco = str_replace("=", "", $nombre_banco);
            $nombre_banco = trim($nombre_banco);

            print ("<BR>" . $nombre_banco);


            //Segunda ocurrencia: Cuenta de destino NO TIENE EN BCI
            $cuenta_destino = "";
            /*
            $pos1 = strpos($msg , "cuenta:");
            $pos1 += 8;
            $txt = substr($msg, $pos1, 1000);
            $cuenta_destino = "";
            $x = 0;
            for ($x =0; $x<strlen($txt);$x++){
                if ($txt[$x]==" " || $txt[$x]=="&")
                    break;
                $cuenta_destino .= $txt[$x];

            }

        //	print ("<BR>" . $cuenta_destino);
            */

            //Tercera ocurrencia: Rut destinatario NO TIENE
            /*
            $pos1 = strpos($msg , "RUT:");
            $pos1 += 4;
            $txt = substr($msg, $pos1, 1000);
            $pos2 = strpos($txt , "Banco");
            //$pos2 = $pos2;

            $rut_destinatario = substr($txt, 0, $pos2);
            $rut_destinatario = str_replace(":", "", $rut_destinatario);
            $rut_destinatario = trim($rut_destinatario);
            $rut_destinatario = str_replace("&nbsp;", "", $rut_destinatario);
            $rut_destinatario = str_replace("*", "", $rut_destinatario);
            $rut_destinatario = str_replace("=2E", "", $rut_destinatario);
            $rut_destinatario = str_replace("=", "", $rut_destinatario);

            $rut_destinatario = trim($rut_destinatario);
            */
            $rut_destinatario = "";
            print ("<BR>" . $rut_destinatario);

            //Cuarta ocurrencia: Monto operación
            $pos1 = strpos($msg, "Monto transferido");
            $pos1 += 19;
            $txt = substr($msg, $pos1, 1000);
            $pos2 = strpos($txt, "Titular");
            //$pos2 = $pos2;

            $monto_operacion = substr($txt, 0, $pos2);
            $monto_operacion = str_replace(":", "", $monto_operacion);
            $monto_operacion = str_replace("$", "", $monto_operacion);
            $monto_operacion = str_replace(".", "", $monto_operacion);
            $monto_operacion = trim($monto_operacion);
            $monto_operacion = str_replace("&nbsp;", "", $monto_operacion);
            $monto_operacion = str_replace("*", "", $monto_operacion);
            $monto_operacion = trim($monto_operacion);

            print ("<BR>" . $monto_operacion);


            //Para obtener La glosa:
            $pos1 = strpos($msg, "Comentario para el destinatario");
            $pos1 += 32;
            $txt = substr($msg, $pos1, 1000);
            $pos2 = strpos($txt, "Numero");
            //$pos2 = $pos2;

            $glosa = substr($txt, 0, $pos2);
            $glosa = str_replace(":", "", $glosa);
            $glosa = trim($glosa);
            $glosa = str_replace("&nbsp;", "", $glosa);
            $glosa = str_replace("*", "", $glosa);
            $glosa = str_replace("=", "", $glosa);
            $glosa = trim($glosa);

            print ("<BR>" . $glosa);


        }


        /*******************************************
         *
         * BANCO ITAÚ
         ********************************************/

        if ($host == "itau.cl") {
            $bank = "Banco Itaú";

            print "<br><br>Nuevo mail de transferencia desde ITAÚ: <br><br><br>"; //$msg
            //obtener info desde el texto completo:
            //Para obtener el nombre del depositante:
            //nuestro(a) cliente  XXXXXX ha instruído una transferencia

            $pos1 = strpos($msg, "nuestro(a) cliente");
            $pos1 += 19;
            $txt = substr($msg, $pos1, 1000);
            $pos2 = strpos($txt, ", ha instruido");
            $pos2 = $pos2;
            $nombre_depositante = substr($txt, 0, $pos2);
            $nombre_depositante = str_replace("&nbsp;", "", $nombre_depositante);
            $nombre_depositante = str_replace("*", "", $nombre_depositante);
            $nombre_depositante = trim($nombre_depositante);

            print ("<BR>" . $nombre_depositante);

            //Para obtener el nombre del destinatario del dinero:
            //Estimado(a) XXXXXX :
            $pos1 = strpos($msg, "Estimado(a):");
            $pos1 += 13;
            $txt = substr($msg, $pos1, 500);
            $pos2 = strpos($txt, "Le informamos");
            $pos2 = $pos2;
            $nombre_destinatario = substr($txt, 0, $pos2);
            $nombre_destinatario = str_replace("&nbsp;", "", $nombre_destinatario);
            $nombre_destinatario = str_replace("*", "", $nombre_destinatario);
            $nombre_destinatario = str_replace("=", "", $nombre_destinatario);
            $nombre_destinatario = trim($nombre_destinatario);

            print ("<BR>" . $nombre_destinatario);


            //Para obtener los siguientes datos:
            //<TD width='176' nowrap>: <B> XXXXXXXX </B></TD>
            //Primera ocurrencia: Banco de destino
            $pos1 = strpos($msg, "Destino");
            $pos1 += 8;
            $txt = substr($msg, $pos1, 1000);

            $pos2 = strpos($txt, "Cuenta");
            $pos2 = $pos2 - 12;


            $nombre_banco = substr($txt, 0, $pos2);
            $nombre_banco = str_replace(":", "", $nombre_banco);
            $nombre_banco = trim($nombre_banco);
            $nombre_banco = str_replace("&nbsp;", "", $nombre_banco);
            $nombre_banco = str_replace("*", "", $nombre_banco);
            $nombre_banco = str_replace("=", "", $nombre_banco);
            $nombre_banco = trim($nombre_banco);

            print ("<BR>" . $nombre_banco);


            //Segunda ocurrencia: Cuenta de destino NO TIENE EN BCI
            $cuenta_destino = "";

            $pos1 = strpos($msg, "Cuenta:");
            $pos1 += 8;
            $txt = substr($msg, $pos1, 1000);
            $pos2 = strpos($txt, " de la ");
            $pos2 = $pos2 - 8;

            $cuenta_destino = substr($txt, 0, $pos2);
            $cuenta_destino = str_replace(":", "", $cuenta_destino);
            $cuenta_destino = trim($cuenta_destino);
            $cuenta_destino = str_replace("&nbsp;", "", $cuenta_destino);
            $cuenta_destino = str_replace("*", "", $cuenta_destino);
            $cuenta_destino = str_replace("=", "", $cuenta_destino);
            $cuenta_destino = trim($cuenta_destino);

            print ("<BR>" . $cuenta_destino);


            //Tercera ocurrencia: Rut destinatario NO TIENE

            $pos1 = strpos($msg, "RUT:");
            $pos1 += 4;
            $txt = substr($msg, $pos1, 100);

            $pos2 = strpos($txt, ':');
            $pos2 = $pos2 - 5;

            $rut_destinatario = substr($txt, 0, $pos2);
            $rut_destinatario = str_replace(":", "", $rut_destinatario);
            $rut_destinatario = trim($rut_destinatario);
            $rut_destinatario = str_replace("&nbsp;", "", $rut_destinatario);
            $rut_destinatario = str_replace("*", "", $rut_destinatario);
            $rut_destinatario = str_replace("=2E", "", $rut_destinatario);
            $rut_destinatario = str_replace("=", "", $rut_destinatario);

            $rut_destinatario = trim($rut_destinatario);


            print ("<BR>" . $rut_destinatario);


            //Cuarta ocurrencia: Monto operación
            $pos1 = strpos($msg, "Monto");
            $pos1 += 7;
            $txt = substr($msg, $pos1, 1000);
            $pos2 = strpos($txt, "Nuestro");
            //$pos2 = $pos2;

            $monto_operacion = substr($txt, 0, $pos2);
            $monto_operacion = str_replace(":", "", $monto_operacion);
            $monto_operacion = str_replace("$", "", $monto_operacion);
            $monto_operacion = str_replace(".", "", $monto_operacion);
            $monto_operacion = trim($monto_operacion);
            $monto_operacion = str_replace("&nbsp;", "", $monto_operacion);
            $monto_operacion = str_replace("*", "", $monto_operacion);
            $monto_operacion = str_replace("=", "", $monto_operacion);
            $monto_operacion = str_replace(" ", "", $monto_operacion);
            $monto_operacion = trim($monto_operacion);

            print ("<BR>" . $monto_operacion);


            //Para obtener La glosa:
            $pos1 = strpos($msg, "mensaje");
            $pos1 += 8;
            $txt = substr($msg, $pos1, 1000);
            $pos2 = strpos($txt, "Este");
            //$pos2 = $pos2;

            $glosa = substr($txt, 0, $pos2);
            $glosa = str_replace(":", "", $glosa);
            $glosa = trim($glosa);
            $glosa = str_replace("&nbsp;", "", $glosa);
            $glosa = str_replace("*", "", $glosa);
            $glosa = str_replace("=", "", $glosa);
            $glosa = trim($glosa);

            print ("<BR>" . $glosa);


        }


        /*******************************************
         *
         * BANCO SCOTIABANK.CL
         *******************************************/

        if ($host == "SCOTIABANK.CL" || $host == "scotiabank.cl") {
            $bank = "Banco Scotiabank";

            print "<br><br>Nuevo mail de transferencia desde SCOTIABANK:  <br><br><br>";  //$msg
            //obtener info desde el texto completo:
            //Para obtener el nombre del depositante:

            $nombre_depositante = obtener_campo($msg, "nuestro cliente el Sr(a)", "ha instruido", 24, 0);
            print ("<BR>(1)" . $nombre_depositante);

            //Para obtener el nombre del destinatario del dinero:
            //Estimado(a) XXXXXX :
            $nombre_destinatario = obtener_campo($msg, "Estimado(a)", "Con fecha", 12, 4);
            print ("<BR>(2)" . $nombre_destinatario);


            //Para obtener los siguientes datos:
            //Primera ocurrencia: Banco de destino
            $temp = obtener_campo($msg, "cuenta nro.", "por un monto", 11, 0);
            $nombre_banco = obtener_campo($temp . "***", " de ", "***", 4, 0);
            print ("<BR>(3)" . $nombre_banco);


            //Segunda ocurrencia: Cuenta de destino NO TIENE EN BCI
            $cuenta_destino = obtener_campo($msg, "cuenta nro.", " de ", 11, 0);
            print ("<BR>(4)" . $cuenta_destino);


            //Tercera ocurrencia: Rut destinatario NO TIENE


            $rut_destinatario = "";
            print ("<BR>(5)" . $rut_destinatario);


            //Cuarta ocurrencia: Monto operación

            $monto_operacion = obtener_campo($msg, "monto de", "Adjuntamos", 8, 3);
            $monto_operacion = str_replace(".", "", $monto_operacion);
            $monto_operacion = str_replace("$", "", $monto_operacion);
            print ("<BR>(6)" . $monto_operacion);


            //Para obtener La glosa:
            $glosa = obtener_campo($msg, "Comentarios de nuestro Cliente", " Atentamente", 30, 3);
            print ("<BR>" . $glosa);


        }


        /*******************************************
         *
         * BANCO FALABELLA
         ******************************************
         *
         * if ($host == "mediasoft.cl" || $host == "bancofalabella.cl"){
         * $bank = "Banco Falabella";
         *
         * print "<br><br>Nuevo mail de transferencia desde BANCO FALABELLA: $msg <br><br><br>";
         *
         * $nombre_depositante = obtener_campo($msg, "nuestro cliente", ", le informamos", 15, 0);
         * print ("<BR>" . $nombre_depositante);
         *
         * //Para obtener el nombre del destinatario del dinero:
         * $nombre_destinatario = obtener_campo($msg, "Estimado(a)", "De acuerdo", 12, 0);
         * print ("<BR>" . $nombre_destinatario);
         *
         *
         * //Para obtener los siguientes datos:
         * //<TD width='176' nowrap>: <B> XXXXXXXX </B></TD>
         * //Primera ocurrencia: Banco de destino
         *
         * $nombre_banco = obtener_campo($msg, "del banco", "N=C2", 9, 0);
         * print ("<BR>" . $nombre_banco);
         *
         *
         * //Segunda ocurrencia: Cuenta de destino
         * $cuenta_destino = obtener_campo($msg, "=B0", "N=C", 3, 0);
         * print ("<BR>" . $cuenta_destino);
         *
         *
         * //Tercera ocurrencia: Rut destinatario NO TIENE
         *
         * $rut_destinatario = "";
         * //$rut_destinatario = obtener_campo($msg, "=B0", "N=C", 3, 0);
         * print ("<BR>".$rut_destinatario);
         *
         *
         * //Cuarta ocurrencia: Monto operación
         * $monto_operacion = obtener_campo($msg, "Monto Transferido", "Transferencia", 18, 0);
         *
         * $monto_operacion = str_replace(":", "", $monto_operacion);
         * $monto_operacion = str_replace("$", "", $monto_operacion);
         * $monto_operacion = str_replace(".", "", $monto_operacion);
         * $monto_operacion = trim($monto_operacion);
         * $monto_operacion = str_replace("&nbsp;", "", $monto_operacion);
         * $monto_operacion = str_replace("*", "", $monto_operacion);
         * $monto_operacion = str_replace("=", "", $monto_operacion);
         * $monto_operacion = str_replace(" ", "", $monto_operacion);
         * $monto_operacion = trim($monto_operacion);
         *
         * print ("<BR>" . $monto_operacion);
         *
         *
         * //Para obtener La glosa:
         * $glosa = obtener_campo($msg, "Asunto Transferencia", "Monto", 21, 0);
         * print ("<BR>" . $glosa);
         *
         *
         *
         * }
         */


        /*******************************************
         *
         * BANCO FALABELLA
         *******************************************/

        if ($host == "mediasoft.cl" || $host == "bancofalabella.cl") {
            $bank = "Banco Falabella";

            print "<br><br>Nuevo mail de transferencia desde BANCO FALABELLA: <br><br><br>"; //$msg

            $nombre_depositante = obtener_campo($msg, "nuestro cliente", ", le informamos", 15, 0);
            print ("<BR>" . $nombre_depositante);

            //Para obtener el nombre del destinatario del dinero:
            $nombre_destinatario = obtener_campo($msg, "Estimado(a)", "De acuerdo", 12, 0);
            print ("<BR>" . $nombre_destinatario);


            //Para obtener los siguientes datos:
            //<TD width='176' nowrap>: <B> XXXXXXXX </B></TD>
            //Primera ocurrencia: Banco de destino

            $nombre_banco = obtener_campo($msg, "del banco", "N=C2", 9, 0);
            print ("<BR>" . $nombre_banco);


            //Segunda ocurrencia: Cuenta de destino
            $cuenta_destino = obtener_campo($msg, "=B0", "N=C", 3, 0);
            print ("<BR>" . $cuenta_destino);


            //Tercera ocurrencia: Rut destinatario NO TIENE

            $rut_destinatario = "";
            //$rut_destinatario = obtener_campo($msg, "=B0", "N=C", 3, 0);
            print ("<BR>" . $rut_destinatario);


            //Cuarta ocurrencia: Monto operación
            $monto_operacion = obtener_campo($msg, "Monto Transferido", "Transferencia", 18, 0);

            $monto_operacion = str_replace(":", "", $monto_operacion);
            $monto_operacion = str_replace("$", "", $monto_operacion);
            $monto_operacion = str_replace(".", "", $monto_operacion);
            $monto_operacion = trim($monto_operacion);
            $monto_operacion = str_replace("&nbsp;", "", $monto_operacion);
            $monto_operacion = str_replace("*", "", $monto_operacion);
            $monto_operacion = str_replace("=", "", $monto_operacion);
            $monto_operacion = str_replace(" ", "", $monto_operacion);
            $monto_operacion = trim($monto_operacion);

            print ("<BR>" . $monto_operacion);


            //Para obtener La glosa:
            $glosa = obtener_campo($msg, "Asunto Transferencia", "Monto", 21, 0);
            print ("<BR>" . $glosa);


        }


        /*******************************************
         *
         * BANCO CorpBanca
         *******************************************/

        if ($host == "mediasoft.cl" || $host == "corpbanca.cl") {
            $bank = "Banco CorpBanca";

            print "<br><br>Nuevo mail de transferencia desde BANCO CORPBANCA: <br><br><br>"; //$msg

            $nombre_depositante = obtener_campo($msg, "nuestro(a) cliente", "ha instruido", 18, 0);
            print ("<BR>(1) " . $nombre_depositante);

            //Para obtener el nombre del destinatario del dinero:
            $nombre_destinatario = obtener_campo($msg, "Estimado(a)", "Informamos", 12, 0);
            print ("<BR>(2) " . $nombre_destinatario);


            //Para obtener los siguientes datos:
            //<TD width='176' nowrap>: <B> XXXXXXXX </B></TD>
            //Primera ocurrencia: Banco de destino

            $temp = obtener_campo($msg, "Destino", "Monto", 7, 0);
//print ("<BR>" . $temp);
            $nombre_banco = obtener_campo($temp . "***", " de ", "***", 4, 0);
            print ("<BR>(3) " . $nombre_banco);


            //Segunda ocurrencia: Cuenta de destino
            $cuenta_destino = obtener_campo($msg, "Destino", " de ", 7, 0);
            print ("<BR>(4) " . $cuenta_destino);


            //Tercera ocurrencia: Rut destinatario NO TIENE

            $rut_destinatario = "";
            //$rut_destinatario = obtener_campo($msg, "=B0", "N=C", 3, 0);
            print ("<BR>(5) " . $rut_destinatario);


            //Cuarta ocurrencia: Monto operación
            $monto_operacion = obtener_campo($msg, "Monto transferido", ".-", 18, 0);

            $monto_operacion = str_replace(":", "", $monto_operacion);
            $monto_operacion = str_replace("$", "", $monto_operacion);
            $monto_operacion = str_replace(".", "", $monto_operacion);
            $monto_operacion = trim($monto_operacion);
            $monto_operacion = str_replace("&nbsp;", "", $monto_operacion);
            $monto_operacion = str_replace("*", "", $monto_operacion);
            $monto_operacion = str_replace("=", "", $monto_operacion);
            $monto_operacion = str_replace(" ", "", $monto_operacion);
            $monto_operacion = trim($monto_operacion);

            print ("<BR>(6) " . $monto_operacion);


            //Para obtener La glosa:
            $glosa = "";
            //$glosa = obtener_campo($msg, "Asunto Transferencia", "Monto", 21, 0);
            print ("<BR>(7) " . $glosa);


        }


        /*******************************************
         *
         * BANCO DE CHILE
         *******************************************/

        if ($host == "bancochile.cl") {
            $bank = "Banco de Chile";

            print "<br><br>Nuevo mail de transferencia desde BANCO DE CHILE: $msg <br><br><br>"; //$msg

            $nombre_depositante = obtener_campo($msg, "nuestro(a) cliente", "ha efectuado", 18, 0);
            print ("<BR>(1) " . $nombre_depositante);

            //Para obtener el nombre del destinatario del dinero:
            $nombre_destinatario = obtener_campo($msg, "Estimado(a)", ",Le informamos", 12, 0);
            print ("<BR>(2) " . $nombre_destinatario);


            //Para obtener los siguientes datos:
            //<TD width='176' nowrap>: <B> XXXXXXXX </B></TD>
            //Primera ocurrencia: Banco de destino

            $nombre_banco = obtener_campo($msg, "Banco:", "Cuenta de ", 7, 0);
//print ("<BR>" . $temp);
            //$nombre_banco = obtener_campo($temp."***", " de ", "***", 4, 0);
            print ("<BR>(3) " . $nombre_banco);


            //Segunda ocurrencia: Cuenta de destino
            $cuenta_destino = obtener_campo($msg, "Cuenta de destino:", "Datos transferencia", 19, 0);
            print ("<BR>(4) " . $cuenta_destino);


            //Tercera ocurrencia: Rut destinatario NO TIENE

            $rut_destinatario = "";
            $rut_destinatario = obtener_campo($msg, "RUT:", "Email:", 5, 0);
            print ("<BR>(5) " . $rut_destinatario);


            //Cuarta ocurrencia: Monto operación
            $monto_operacion = obtener_campo($msg, "Monto:", "Comprobante", 6, 17);

            $monto_operacion = str_replace(":", "", $monto_operacion);
            $monto_operacion = str_replace("$", "", $monto_operacion);
            $monto_operacion = str_replace(".", "", $monto_operacion);
            $monto_operacion = trim($monto_operacion);
            $monto_operacion = str_replace("&nbsp;", "", $monto_operacion);
            $monto_operacion = str_replace("*", "", $monto_operacion);
            $monto_operacion = str_replace("=", "", $monto_operacion);
            $monto_operacion = str_replace(" ", "", $monto_operacion);
            $monto_operacion = trim($monto_operacion);

            print ("<BR>(6) " . $monto_operacion);


            //Para obtener La glosa:
            $glosa = "";
            $glosa = obtener_campo($msg, "Asunto:", "Datos de ", 8, 0);
            print ("<BR>(7) " . $glosa);


        }


        /*******************************************
         *
         * BANCO BBVA
         *******************************************/

        if ($host == "bbva.cl") {
            $bank = "Banco BBVA";

            print "<br><br>Nuevo mail de transferencia desde BBVA: $msg <br><br><br>"; //$msg

            $nombre_depositante = obtener_campo($msg, "nuestro(a) cliente", "ha efectuado", 18, 0);
            print ("<BR>(1) " . $nombre_depositante);

            //Para obtener el nombre del destinatario del dinero:
            $nombre_destinatario = obtener_campo($msg, "Estimado(a)", "Le informamos", 12, 0);
            print ("<BR>(2) " . $nombre_destinatario);


            //Para obtener los siguientes datos:
            //<TD width='176' nowrap>: <B> XXXXXXXX </B></TD>
            //Primera ocurrencia: Banco de destino

            $nombre_banco = obtener_campo($msg, "Banco", "Email", 7, 0);
//print ("<BR>" . $temp);
            //$nombre_banco = obtener_campo($temp."***", " de ", "***", 4, 0);
            print ("<BR>(3) " . $nombre_banco);


            //Segunda ocurrencia: Cuenta de destino
            $cuenta_destino = obtener_campo($msg, "Cuenta", "Banco", 6, 1);
            print ("<BR>(4) " . $cuenta_destino);


            //Tercera ocurrencia: Rut destinatario NO TIENE

            $rut_destinatario = "";
            $rut_destinatario = obtener_campo($msg, "RUT", "Cuenta", 6, 0);
            print ("<BR>(5) " . $rut_destinatario);


            //Cuarta ocurrencia: Monto operación
            $monto_operacion = obtener_campo($msg, "Monto", "=", 26, 0);

            $monto_operacion = str_replace(":", "", $monto_operacion);
            $monto_operacion = str_replace("$", "", $monto_operacion);
            $monto_operacion = str_replace(".", "", $monto_operacion);
            $monto_operacion = trim($monto_operacion);
            $monto_operacion = str_replace("&nbsp;", "", $monto_operacion);
            $monto_operacion = str_replace("*", "", $monto_operacion);
            $monto_operacion = str_replace("=", "", $monto_operacion);
            $monto_operacion = str_replace(" ", "", $monto_operacion);
            $monto_operacion = trim($monto_operacion);

            print ("<BR>(6) " . $monto_operacion);


            //Para obtener La glosa:
            $glosa = "";
            $glosa = obtener_campo($msg, "Asun", " de ", 8, 14);
            print ("<BR>(7) " . $glosa);


        }


        /*******************************************
         *
         * BANCO SECURITY
         *******************************************/

        if ($host == "security.cl") {
            $bank = "Banco Security";

            print "<br><br>Nuevo mail de transferencia desde Banco Security: $msg <br><br><br>"; //$msg

            $nombre_depositante = obtener_campo($msg, "Nuestro(a) cliente", " le ha ", 18, 1);
            print ("<BR>(1) " . $nombre_depositante);

            //Para obtener el nombre del destinatario del dinero:
            $nombre_destinatario = obtener_campo($msg, "Estimado(a)", "Nuestro(a) cliente", 12, 9);
            print ("<BR>(2) " . $nombre_destinatario);


            //Para obtener los siguientes datos:
            //<TD width='176' nowrap>: <B> XXXXXXXX </B></TD>
            //Primera ocurrencia: Banco de destino

            $tmp = obtener_campo($msg, "Cuenta de destino:", " Fecha", 18, 0);
            $nombre_banco = obtener_campo($tmp . "***", " de ", "***", 4, 0);
//print ("<BR>" . $temp);
            //$nombre_banco = obtener_campo($temp."***", " de ", "***", 4, 0);
            print ("<BR>(3) " . $nombre_banco);


            //Segunda ocurrencia: Cuenta de destino
            $cuenta_destino = obtener_campo($msg, "Cuenta de destino:", " de ", 18, 1);
            print ("<BR>(4) " . $cuenta_destino);


            //Tercera ocurrencia: Rut destinatario NO TIENE

            $rut_destinatario = "";
            //$rut_destinatario = obtener_campo($msg, "RUT", "Cuenta", 6, 0);
            print ("<BR>(5) " . $rut_destinatario);


            //Cuarta ocurrencia: Monto operación
            $monto_operacion = obtener_campo($msg, "Monto:", "Motivo", 6, 0);

            $monto_operacion = str_replace(":", "", $monto_operacion);
            $monto_operacion = str_replace("$", "", $monto_operacion);
            $monto_operacion = str_replace(".", "", $monto_operacion);
            $monto_operacion = trim($monto_operacion);
            $monto_operacion = str_replace("&nbsp;", "", $monto_operacion);
            $monto_operacion = str_replace("*", "", $monto_operacion);
            $monto_operacion = str_replace("=", "", $monto_operacion);
            $monto_operacion = str_replace(" ", "", $monto_operacion);
            $monto_operacion = trim($monto_operacion);

            print ("<BR>(6) " . $monto_operacion);


            //Para obtener La glosa:
            $glosa = "";
            $glosa = obtener_campo($msg, "Motivo", "Cuenta", 7, 7);
            print ("<BR>(7) " . $glosa);


        }


        if ($bank != "") {
            //se guarda en base de datos:
            $sql = "INSERT INTO `transferencias_info`( `host`, `value`, `bank`, `remite`, ";
            $sql .= " `dest_name`, `dest_bank`, `dest_account`, `dest_rut`, `detail`, `unix_time`) ";
            $sql .= "VALUES ('$host',$monto_operacion,'$bank','$nombre_depositante'";
            $sql .= " ,'$nombre_destinatario','$nombre_banco','$cuenta_destino','$rut_destinatario','$glosa','$udate')";
            //print $sql;
            //DESCOMENTAR

            $fecha_registro = $udate;
            $monto = $monto_operacion;
            $buscar_rut = str_replace('.', '', $rut_destinatario);

            $mysqli->query($sql);  //or die('Error on trying to insert data: ' . mysql_error());

            //$rut_pagador = "17487145-0";
            $pagado = false;
            $id_transaccion = obtener_id_descripcion($glosa);
            //$id_transaccion = $glosa;

            if ($id_transaccion != "codigo no encontrado") {
                $tipo_pago = obtener_tipo_a_pagar($id_transaccion);
                if ($tipo_pago == "co") {
                    //cobros individual
                    $sql = "SELECT idCobros 
								FROM cobros P
								INNER JOIN usuarios U ON P.idUsuarios = U.idUsuarios
								WHERE idunico_pago = '" . $id_transaccion . "' AND monto = '" . $monto . "' AND U.rut = '" . $buscar_rut . "' AND pagado = 0 LIMIT 1";

                    $rs = $conexion_portal->query($sql);// or die('Error (1) : ' . mysql_error());
                    if (mysql_num_rows($rs) > 0) {
                        $row = mysql_fetch_array($rs);
                        $id = $row['idCobros'];

                        $fecha_pago = date("Y-m-d", $udate);
                        $sql = "UPDATE cobros 
									SET monto = '$monto', pagado = 1, fecha_pago = '$fecha_pago'
									WHERE  idCobros = '$id'";
                        $conexion_portal->query($sql); //mysql_query($sql, $conexion_portal) or die('Error (2): ' . mysql_error());
                        $pagado = true;
                    } else {
                        echo "no exite registor para insertar (cobros)";
                    }
                }

                if ($tipo_pago == "no") { //cobros nóminas
                    $sql = "SELECT idnominasdetalle,P.idnominas
								FROM nominasdetalle P
								INNER JOIN nominas N ON P.idnominas = N.idnominas
								INNER JOIN usuarios U ON N.idUsuarios = U.idUsuarios
								WHERE idunico_pago = '" . $id_transaccion . "' AND monto = '" . $monto . "' AND U.rut = '" . $buscar_rut . "' AND P.pagado = 0 LIMIT 1";

                    //$rs = mysql_query($sql, $conexion_portal) or die('Error (3): <br/>'.$sql ."<br/>". mysql_error());
                    $rs = $conexion_portal->query($sql);
                    if ($rs->num_rows > 0) {
                        $row = $rs->fetch_assoc();
                        $id = $row['idnominasdetalle'];
                        $idnominas = $row['idnominas'];

                        $fecha_pago = date("Y-m-d", $udate);
                        $sql = "UPDATE nominasdetalle 
									SET monto = '$monto', monto_pago = '$monto',pagado = 1, fecha_pago = '$fecha_pago'
									WHERE  idnominasdetalle = '$id'";
                        //$d = mysql_query($sql, $conexion_portal) or die('Error (4): ' . mysql_error());
                        $d = $conexion_portal->query($sql);

                        if ($d) {
                            $sql = "SELECT COUNT(*) as 'total'
										FROM nominasdetalle 
										WHERE idnominas = '$idnominas'";
                            //$rs = mysql_query($sql, $conexion_portal) or die('Error (5): ' . mysql_error());
                            //$row = mysql_fetch_array($rs);
                            $rs = $conexion_portal->query($sql);
                            $row = $rs->fetch_assoc();
                            $total_detalle = $row['total'];

                            $sql = "SELECT COUNT(*) as 'total'
										FROM nominasdetalle 
										WHERE idnominas = '$idnominas' AND pagado = 1 ";
                            //$rs = mysql_query($sql, $conexion_portal) or die('Error (6): ' . mysql_error());
                            //$row = mysql_fetch_array($rs);
                            $rs = $conexion_portal->query($sql);
                            $row = $rs->fetch_assoc();

                            $total_pagadas = $row['total'];
                            /*
                            echo "<br/> total_detalle: ".$total_detalle. '<br/>';
                            echo "total_pagadas: ".$total_pagadas;
                            exit;*/
                            if ($total_detalle == $total_pagadas) {
                                $sql = "UPDATE nominas
									SET todo_pagado = 1
									WHERE  idnominas = '$idnominas'";
                                //$d = mysql_query($sql, $conexion_portal) or die('Error (7): ' . mysql_error());
                                $d = $conexion_portal->query($sql);
                            }
                        }
                        $pagado = true;
                    } else {
                        echo "no exite registor para insertar (cobros nóminas)";
                    }
                }
            }
            print "<br>EL código de transacción no es válido, banco: $bank";
        } else
            print "<br>El nuevo mensaje no proviene de un remitente o Banco conocido.";
    } else {
        ;//print "<br>Mensaje Antiguo.";

    }
    $n_msgs = $n_msgs - 1;
}


//MOSTRAR DATOS DE BD:
$sql = "SELECT `id`, `host`, `value`, `bank`, `remite`, `dest_name`, `dest_bank`, `dest_account`, `dest_rut`, `detail`, `unix_time` ";
$sql .= " FROM `transferencias_info` WHERE 1";

$result = $mysqli->query($sql);
$last_udate = "";

print "<table>";

print "</tr>";
print "<th>ID</th>";
print "<th>HOST</th>";
print "<th>MONTO</th>";
print "<th>BANCO</th>";
print "<th>DEPOSITANTE</th>";
print "<th>DESTINATARIO</th>";
print "<th>BANCO DESTINO</th>";
print "<th>CUENTA DESTINO</th>";
print "<th>RUT DESTINO</th>";
print "<th>DETALLE</th>";
print "<th>ID MAIL</th>";
print "</tr>";

while ($row = $result->fetch_assoc()) {
    print "<tr>";
    $id = $row["id"];
    $host = $row["host"];
    $valor = $row["value"];
    $banco = $row["bank"];
    $remite = $row["remite"];
    $dest_name = $row["dest_name"];
    $dest_bank = $row["dest_bank"];
    $dest_account = $row["dest_account"];
    $dest_rut = $row["dest_rut"];
    $detail = $row["detail"];

    $last_udate = $row["unix_time"];

    print "<td> $id </td>";
    print "<td> $host </td>";
    print "<td> $valor </td>";
    print "<td> $banco </td>";
    print "<td> $remite </td>";
    print "<td> $dest_name </td>";
    print "<td> $dest_bank </td>";
    print "<td> $dest_account </td>";
    print "<td> $dest_rut </td>";
    print "<td> $detail </td>";
    print "<td> $last_udate </td>";


    print "</tr>";

}


$result->free();
$mysqli->close();
$conexion_portal->close();
imap_close($gmail_inbox);
?>


