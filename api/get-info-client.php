<?php 

    include '../db/connection.php';

	$info = [];
    $data = [];
    $data2 = [];

    $id = $_POST['id'];

    $queryList = sprintf("SELECT * FROM clients_tb WHERE client_id = '%s'", $id);
	$rsList = mysqli_query($conn,$queryList);
	$rowsList = mysqli_fetch_assoc($rsList);
	$totalRowsList = mysqli_num_rows($rsList);

    if ($totalRowsList>0) {
        do {

			//Si es empresa
            if ($rowsList['client_is_enterprise'] == '1') {
                array_push($data, array(
                    'id' => $rowsList['client_id'], 
                    'name' => $rowsList['client_enterprise'],
                    'email' => $rowsList['client_email'],
                    'rfc' => $rowsList['client_rfc'],
                    'address' => $rowsList['client_address'],
                    'phone' => $rowsList['client_phone'],
                    'credit_days' => $rowsList['client_credit_days'],
                    'contact_name' => $rowsList['client_contact_name'],
                    'contact_phone' => $rowsList['client_contact_phone'],
                    'status' => $rowsList['client_disabled'],
                    'is_enterprise' => '1'
                ));
            //Si es cliente normal
            } else {
                array_push($data, array(
                    'id' => $rowsList['client_id'], 
                    'name' => $rowsList['client_name'],
                    'lastname' => $rowsList['client_lastname'],
                    'email' => $rowsList['client_email'],
                    'rfc' => $rowsList['client_rfc'],
                    'address' => $rowsList['client_address'],
                    'phone' => $rowsList['client_phone'],
                    'credit_days' => $rowsList['client_credit_days'],
                    'status' => $rowsList['client_disabled'],
                    'is_enterprise' => '0'
                ));
            }

		} while ($rowsList = mysqli_fetch_assoc($rsList));


        $error = false;
        $msg_error = 'Lista obtenida con exito';
    } else {
        $error = false;
        $msg_error = 'Lo sentimos, no hay usuarios dados de alta.';
    }
    

    $info = [
        "data" => 
            $data,
        "error" => 
            $error,
        "message" => 
            $msg_error
    ];


    echo json_encode($info);

?>