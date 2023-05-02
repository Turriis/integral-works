<?php 

    include '../db/connection.php';

    $id = $_POST['id'];
    $flagEnterprise = $_POST['edit-flag-enterprise'];
    $name = $_POST['edit-name-client'];
    $lastname = $_POST['edit-lastname-client'];
    $nameEnterprise = $_POST['edit-name-enterprise'];
    $email = $_POST['edit-email-client'];
    $phone = $_POST['edit-phone-client'];
    $address = $_POST['edit-address-client'];
    $rfc = $_POST['edit-rfc-client'];
    $credit_days = $_POST['edit-credit-days-client'];
    $contact_name = $_POST['edit_client_contact_name'];
    $contact_phone = $_POST['edit_client_contact_phone'];
    $status = $_POST['edit-status-client'];
    $idUser = $_POST['idUser'];
    $img = $_FILES['img']['name'][0];

	$info = [];
    $data = [];

    //Variables para validar si hay imagen o no
    $queryAdd1 = '';

    //Si existe la imagen, llenamos las variables
    if ($_FILES['img']['name'][0] != '') {
        $queryAdd1 .= ", client_image = '".$img."'";
    }

    //Definimos si es empresa o cliente normal
    if ($flagEnterprise == '1') {
        $queryUpdate = "UPDATE clients_tb SET client_name = '', client_lastname = '', client_enterprise = '".$nameEnterprise."', client_email = '".$email."', client_phone = '".$phone."', client_address = '".$address."', client_rfc = '".$rfc."', client_is_enterprise = '1', client_update = '".date("Y-m-d")."', client_user_update = '".$idUser."', client_credit_days = '".$credit_days."', client_contact_name = '".$contact_name."', client_contact_phone = '".$contact_phone."', client_disabled = '".$status."'".$queryAdd1." WHERE client_id = '".$id."'";
	    $rsUpdate = mysqli_query($conn,$queryUpdate);
    } else {
        $queryUpdate = "UPDATE clients_tb SET client_name = '".$name."', client_lastname = '".$lastname."', client_enterprise = '', client_email = '".$email."', client_phone = '".$phone."', client_address = '".$address."', client_rfc = '".$rfc."', client_is_enterprise = '0', client_update = '".date("Y-m-d")."', client_user_update = '".$idUser."', client_credit_days = '".$credit_days."', client_disabled = '".$status."'".$queryAdd1." WHERE client_id = '".$id."'";
	    $rsUpdate = mysqli_query($conn,$queryUpdate);
    }


    if ($rsUpdate) {

        if ($img != '') {

			$validextensions = array("jpeg", "jpg", "png");
			$temporary = explode(".", $_FILES["img"]["name"][0]);
			$file_extension = end($temporary);
			$folder = "../uploads/clients/image_perfil/".$id."";

			if (!file_exists($folder)) {
				mkdir($folder, 0755, true);
			}else{
				//unlink($folder);
				array_map('unlink', glob("$folder/*.*"));
				mkdir($folder, 0755, true);
			}

			$sourcePath = $_FILES['img']['tmp_name'][0];
			$targetPath = "".$folder."/".$_FILES['img']['name'][0];
			move_uploaded_file($sourcePath,$targetPath);

		}

        $error = false;
        $msg_error = 'Guardado con exito';
    } else {
        $error = true;
        $msg_error = 'Lo sentimos, algo salio mal, intenta de nuevo.';
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