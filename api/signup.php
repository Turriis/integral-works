<?php 

    include '../db/connection.php';

    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $perfil = $_POST['perfil'];

	$info = [];

    $queryInsert = sprintf("SELECT * FROM users_tb WHERE user_email = '%s'", $email);
	$rsInsert = mysqli_query($conn,$queryInsert);
	$rowsInsert = mysqli_fetch_assoc($rsInsert);
	$totalRowsInsert = mysqli_num_rows($rsInsert);

    if ($totalRowsInsert === 0) {

        $queryRegister = sprintf("INSERT INTO users_tb (user_name, user_lastname, user_email, user_password, user_privileges) VALUES ('%s', '%s', '%s', '%s', '%s')", $name, $lastname, $email, $password, $perfil);
		$rsRegister = mysqli_query($conn,$queryRegister);

        $error = false;
        $msg_error = 'Insertado con exito';
    } else {
        $error = true;
        $msg_error = 'Lo sentimos, Ese correo ya se encuentra registrado.';
    }
    

    $info = [
        "error" => 
            $error,
        "message" => 
            $msg_error
    ];


    print_r(json_encode($info));

?>