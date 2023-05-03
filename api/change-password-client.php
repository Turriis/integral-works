<?php 

    include '../db/connection.php';

    $id = $_POST['id'];
    $password = md5($_POST['edit-pass-client']);

	$info = [];

    $queryUpdate = "UPDATE clients_tb SET client_password = '".$password."' WHERE client_id = '".$id."'";
    $rsUpdate = mysqli_query($conn,$queryUpdate);

    if ($rsUpdate) {
        $error = false;
        $msg_error = 'Guardado con exito';
    } else {
        $error = true;
        $msg_error = 'Lo sentimos, algo salio mal, intenta de nuevo.';
    }
    

    $info = [
        "error" => 
            $error,
        "message" => 
            $msg_error
    ];


    print_r(json_encode($info));

?>