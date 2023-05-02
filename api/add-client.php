<?php 

    include '../db/connection.php';

    $info = [];
    $flagEnterprise = $_POST['flag-enterprise'];
    $name = $_POST['name-client'];
    $lastname = $_POST['lastname-client'];
    $nameEnterprise = $_POST['name-enterprise'];
    $email = $_POST['email-client'];
    $phone = $_POST['phone-client'];
    $address = $_POST['address-client'];
    $rfc = $_POST['rfc-client'];
    $credit_days = $_POST['credit-days-client'];
    $pass = md5($_POST['pass-client']);
    $contact_name = $_POST['client_contact_name'];
    $contact_phone = $_POST['client_contact_phone'];
    $idUser = $_POST['idUser'];
    $img = $_FILES['img']['name'][0];

    //Variables para validar si hay imagen o no
    $queryAdd1 = '';
    $queryAdd2 = '';

    //Si existe la imagen, llenamos las variables
    if ($_FILES['img']['name'][0] != '') {
        $queryAdd1 .= ", client_image";
        $queryAdd2 .= ", '%s'";
    }

    //Definimos si es empresa o cliente normal
    if ($flagEnterprise == '1') {
        $queryRegister = sprintf("INSERT INTO clients_tb (client_enterprise, client_email, client_phone, client_address, client_rfc, client_password, client_is_enterprise, client_user_create, client_credit_days, client_contact_name, client_contact_phone".$queryAdd1.") VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'".$queryAdd2.")", $nameEnterprise, $email, $phone, $address, $rfc, $pass, 1, $idUser, $credit_days, $contact_name, $contact_phone, $img);
	    $rsRegister = mysqli_query($conn,$queryRegister);
    } else {
        $queryRegister = sprintf("INSERT INTO clients_tb (client_name, client_lastname, client_email, client_phone, client_address, client_rfc, client_password, client_is_enterprise, client_user_create, client_credit_days".$queryAdd1.") VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'".$queryAdd2.")", $name, $lastname, $email, $phone, $address, $rfc, $pass, 0, $idUser, $credit_days, $img);
	    $rsRegister = mysqli_query($conn,$queryRegister);
    }

    if ($rsRegister) {
        $elid = $conn->insert_id;
        
        $validextensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["img"]["name"][0]);
        $file_extension = end($temporary);
        $folder = "../uploads/clients/image_perfil/".$elid."";
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }
        $sourcePath = $_FILES['img']['tmp_name'][0];
        $targetPath = "".$folder."/".$_FILES['img']['name'][0];
        move_uploaded_file($sourcePath,$targetPath);

        $error = false;
        $msg_error = 'Cliente creado con exito.';
    } else {
        $error = true;
        $msg_error = 'Lo sentimos, ha ocurrido un error, por favor intentalo de nuevo.';
    }
    

    $info = [
        "error" => 
            $error,
        "message" => 
            $msg_error
    ];


    print_r(json_encode($info));

?>