<?php 

    include '../db/connection.php';

	$info = [];
    $data = [];
    $data2 = [];

    $id = $_POST['id'];
    $privileges = $_POST['privileges'];

    //Si es cliente
    if ($privileges == '10') {
        
        $queryList = sprintf("SELECT * FROM clients_tb WHERE client_id = '%s'", $id);
        $rsList = mysqli_query($conn,$queryList);
        $rowsList = mysqli_fetch_assoc($rsList);
        $totalRowsList = mysqli_num_rows($rsList);

        if ($totalRowsList>0) {

            //Si es empresa
            if ($rowsList['client_is_enterprise'] == '1') {
                array_push($data, array(
                    'id' => $rowsList['client_id'], 
                    'name' => $rowsList['client_enterprise'],
                    'email' => $rowsList['client_email'],
                    'privileges' => '10',
                    'status' => $rowsList['client_disabled'],
                    'type' => '1'
                ));
            //Si es cliente normal
            } else {
                array_push($data, array(
                    'id' => $rowsList['client_id'], 
                    'name' => $rowsList['client_name'],
                    'lastname' => $rowsList['client_lastname'],
                    'email' => $rowsList['client_email'],
                    'privileges' => '10',
                    'status' => $rowsList['client_disabled'],
                    'type' => '0'
                ));
            }

            $error = false;
            $msg_error = 'Lista obtenida con exito';
        } else {
            $error = false;
            $msg_error = 'Lo sentimos, no hay clientes dados de alta.';
        }

    //Si es usuario normal
    } else {
        $queryList = sprintf("SELECT * FROM users_tb WHERE user_id = '%s'", $id);
        $rsList = mysqli_query($conn,$queryList);
        $rowsList = mysqli_fetch_assoc($rsList);
        $totalRowsList = mysqli_num_rows($rsList);

        $queryList2 = sprintf("SELECT * FROM privileges_tb WHERE privilege_disabled = '%s'", 0);
        $rsList2 = mysqli_query($conn,$queryList2);
        $rowsList2 = mysqli_fetch_assoc($rsList2);
        $totalRowsList2 = mysqli_num_rows($rsList2);

        if ($totalRowsList>0) {
            do {

                array_push($data, array(

                    'id' => $rowsList['user_id'], 
                    'name' => $rowsList['user_name'],
                    'lastname' => $rowsList['user_lastname'],
                    'email' => $rowsList['user_email'],
                    'privileges' => $rowsList['user_privileges'],
                    'status' => $rowsList['user_disabled'],
                    'type' => '0'

                ));

            } while ($rowsList = mysqli_fetch_assoc($rsList));


            do {

                array_push($data2, array(

                    'id' => $rowsList2['privilege_id'], 
                    'name' => $rowsList2['privilege_name']

                ));

            } while ($rowsList2 = mysqli_fetch_assoc($rsList2));


            $error = false;
            $msg_error = 'Lista obtenida con exito';
        } else {
            $error = false;
            $msg_error = 'Lo sentimos, no hay usuarios dados de alta.';
        }

    }//Fin de validaciones
    

    $info = [
        "data" => 
            $data,
        "privileges" => 
            $data2,
        "error" => 
            $error,
        "message" => 
            $msg_error
    ];


    echo json_encode($info);

?>