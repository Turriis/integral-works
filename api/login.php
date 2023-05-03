<?php 

    include '../db/connection.php';

    $email = $_POST['email'];
    $password = md5($_POST['password']);

	$info = [];
    $data = [];

    $queryInsert = sprintf("SELECT u.*, p.privilege_name FROM users_tb as u
    LEFT JOIN privileges_tb as p ON p.privilege_id = u.user_privileges
    WHERE u.user_email = '%s' AND u.user_password = '%s' AND u.user_disabled = '%s'", $email, $password, 0);
	$rsInsert = mysqli_query($conn,$queryInsert);
	$rowsInsert = mysqli_fetch_assoc($rsInsert);
	$totalRowsInsert = mysqli_num_rows($rsInsert);

    if ($totalRowsInsert>0) {

        array_push($data, array(
            'id' => $rowsInsert['user_id'], 
            'name' => $rowsInsert['user_name'].' '.$rowsInsert['user_lastname'],
            'email' => $rowsInsert['user_email'],
            'image' => $rowsInsert['user_image'],
            'privilege_name' => $rowsInsert['privilege_name'],
            'privileges' => $rowsInsert['user_privileges'])
        );

        $error = false;
        $msg_error = 'Logueado con exito';
    } else {

        //Si no esta en la tabla de usuarios lo buscamos en la tabla de clientes
        $queryClient = sprintf("SELECT * FROM clients_tb 
        WHERE client_email = '%s' AND client_password = '%s' AND client_disabled = '%s'", $email, $password, 0);
        $rsClient = mysqli_query($conn,$queryClient);
        $rowsClient = mysqli_fetch_assoc($rsClient);
        $totalRowsClient = mysqli_num_rows($rsClient);

        //Si existe en clientes entonces...
        if ($totalRowsClient>0) {
            //Si es empresa o normal
            if ($rowsClient['client_is_enterprise'] == '1') {
                $name = $rowsClient['client_enterprise'];
            } else {
                $name = $rowsClient['client_name'].' '.$rowsClient['client_lastname'];
            }
            
            array_push($data, array(
                'id' => $rowsClient['client_id'], 
                'name' => $name,
                'email' => $rowsClient['client_email'],
                'privilege_name' => 'Cliente',
                'image' => $rowsClient['client_image'],
                'privileges' => '10')
            );
    
            $error = false;
            $msg_error = 'Logueado con exito';
        } else {
            $error = true;
            $msg_error = 'Lo sentimos, por favor verifica tu correo electrónico y/o contraseña';
        }
    
    }
    

    $info = [
        "data" => 
            $data,
        "error" => 
            $error,
        "message" => 
            $msg_error
    ];


    print_r(json_encode($info));

?>