<?php 

    include '../db/connection.php';

    $id = $_POST['id'];
    $type = $_POST['type'];
    $password = md5($_POST['edit-pass-user']);

	$info = [];

    //Si es usuario
    if ($type == '1') {
        $queryUpdate = "UPDATE users_tb SET user_password = '".$password."' WHERE user_id = '".$id."'";
	    $rsUpdate = mysqli_query($conn,$queryUpdate);
    //Si es cliente
    } else {
        $queryUpdate = "UPDATE clients_tb SET client_password = '".$password."' WHERE client_id = '".$id."'";
	    $rsUpdate = mysqli_query($conn,$queryUpdate);
    }
    

    

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