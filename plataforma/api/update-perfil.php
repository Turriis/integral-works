<?php 

    include '../db/connection.php';

    $id = $_POST['id'];
    $name = $_POST['name-perfil'];
    $lastname = $_POST['lastname-perfil'];
    $img = $_FILES['img']['name'][0];

	$info = [];
    $data = [];

    //Variables para validar si hay imagen o no
    $queryAdd1 = '';

    //Si existe la imagen, llenamos las variables
    if ($_FILES['img']['name'][0] != '') {
        $queryAdd1 .= ", user_image = '".$img."'";
    }

    $queryUpdate = "UPDATE users_tb SET user_name = '".$name."', user_lastname = '".$lastname."'".$queryAdd1." WHERE user_id = '".$id."'";
	$rsUpdate = mysqli_query($conn,$queryUpdate);

    $queryInsert = sprintf("SELECT u.*, p.privilege_name FROM users_tb as u
    LEFT JOIN privileges_tb as p ON p.privilege_id = u.user_privileges
    WHERE u.user_id = '%s'", $id);
	$rsInsert = mysqli_query($conn,$queryInsert);
	$rowsInsert = mysqli_fetch_assoc($rsInsert);
	$totalRowsInsert = mysqli_num_rows($rsInsert);

    if ($rsUpdate) {

        if ($img != '') {

			$validextensions = array("jpeg", "jpg", "png");
			$temporary = explode(".", $_FILES["img"]["name"][0]);
			$file_extension = end($temporary);
			$folder = "../uploads/users/image_perfil/".$id."";

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

        array_push($data, array(
            'id' => $rowsInsert['user_id'], 
            'name' => $rowsInsert['user_name'].' '.$rowsInsert['user_lastname'],
            'image' => $rowsInsert['user_image'],
            'email' => $rowsInsert['user_email'],
            'privilege_name' => $rowsInsert['privilege_name'],
            'privileges' => $rowsInsert['user_privileges'])
        );

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