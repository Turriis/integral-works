<?php 

    include '../db/connection.php';

    $email = $_POST['email'];

    //Validamos que exista un usuario con ese correo
    $queryInsert = sprintf("SELECT * FROM users_tb WHERE user_email = '%s'", $email);
	$rsInsert = mysqli_query($conn,$queryInsert);
	$rowsInsert = mysqli_fetch_assoc($rsInsert);
	$totalRowsInsert = mysqli_num_rows($rsInsert);

    //Si existe restablecemos y mandamos correo
    if ($totalRowsInsert>0) {
    
        $rand = substr(md5(microtime()),rand(0,26),5);
        $new_password = md5($rand);

        $info = [];

        $queryUpdate = "UPDATE users_tb SET user_password = '".$new_password."' WHERE user_email = '".$email."'";
        $rsUpdate = mysqli_query($conn,$queryUpdate);

        if ($rsUpdate) {

            //Mandamos el correo con la nueva contrasena
            $subject = "Recuperación de contraseña HM Consultores Admin";

            $message = "
            <html>
            <head>
            <title>Recuperación de contraseña HM Consultores Admin</title>
            </head>
            <body>
            <p>Has restablecido tu contraseña desde el Admin de HM Consultores, la cual es la siguiente:</p>
            <table>
            <tr>
            <th>Contraseña nueva: </th>
            <th>".$rand."</th>
            </tr>
            </table>
            </body>
            </html>
            ";

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: <info@cencerro.com.mx>' . "\r\n";

            mail($email,$subject,$message,$headers);
            //Fin de correo

            $error = false;
            $msg_error = 'Contraseña restablecida con exito, te hemos enviado un correo electrónico con la misma.';
        } else {
            $error = true;
            $msg_error = 'Lo sentimos, algo salio mal, intenta de nuevo.';
        }
    
    //Si no existe el usuario mandamos mensaje de error
    } else {
        $error = true;
        $msg_error = 'No se encuentra ningún usuario registrado con ese correo electrónico.';        
    }
    

    $info = [
        "error" => 
            $error,
        "message" => 
            $msg_error
    ];


    print_r(json_encode($info));

?>