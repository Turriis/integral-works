<?php 

    include '../db/connection.php';

	$info = [];
    $data = [];

    //Codigo para la paginacion
    if ($_POST['pageno'] !== 'null' && isset($_POST['pageno'])) {
        $pageno = $_POST['pageno'];
    } else {
        $pageno = "1";
        $_POST['pageno'] = 1;
    }

    
    //Codigo de selector de numero de registros
    if (isset($_POST['recordno'])) {
        $no_of_records_per_page = $_POST['recordno'];
        //Variable para el ciclo for validando el selector de numero de registros
        $paramRecord = '&recordno='.$_POST['recordno'].'';
    } else {
        $no_of_records_per_page = 10;
        $paramRecord = '';
    }
    
    $filter = 'WHERE 1=1';
    $filter2 = ' AND 1=1';
    $disabledVal = '1 = 1';

    //VALIDAMOS LOS FILTROS
    if (isset($_POST['user_id_filt']) && $_POST['user_id_filt'] !== '') {
        $filter .= " AND u.user_id = ".$_POST['user_id_filt']." ";
        $filter2 .= " AND u.user_id = ".$_POST['user_id_filt']." ";
    }

    if (isset($_POST['user_name_filt']) && $_POST['user_name_filt'] !== '') {
        $filter .= " AND u.user_name LIKE '%".$_POST['user_name_filt']."%' ";
        $filter2 .= " AND u.user_name LIKE '%".$_POST['user_name_filt']."%' ";
    }

    if (isset($_POST['user_lastname_filt']) && $_POST['user_lastname_filt'] !== '') {
        $filter .= " AND u.user_lastname LIKE '%".$_POST['user_lastname_filt']."%' ";
        $filter2 .= " AND u.user_lastname LIKE '%".$_POST['user_lastname_filt']."%' ";
    }

    if (isset($_POST['user_email_filt']) && $_POST['user_email_filt'] !== '') {
        $filter .= " AND u.user_email LIKE '%".$_POST['user_email_filt']."%' ";
        $filter2 .= " AND u.user_email LIKE '%".$_POST['user_email_filt']."%' ";
    }

    if (isset($_POST['user_privileges_filt']) && $_POST['user_privileges_filt'] !== '') {
        $filter .= " AND p.privilege_name LIKE '%".$_POST['user_privileges_filt']."%' ";
        $filter2 .= " AND p.privilege_name LIKE '%".$_POST['user_privileges_filt']."%' ";
    }

    if (isset($_POST['user_disabled_filt']) && $_POST['user_disabled_filt'] !== '') {
        switch (true) {
            case stristr('Activo', $_POST['user_disabled_filt']) !== FALSE:
                $filter .= " AND user_disabled = '0'";
                $filter2 .= " AND user_disabled = '0'";
                break;
            case stristr('Inactivo', $_POST['user_disabled_filt']) !== FALSE:
                $filter .= " AND user_disabled = '1'";
                $filter2 .= " AND user_disabled = '1'";
                break;
            default:
        }
    }
    
    
    //Obtenemos el numero de registros por pagina
    $offset = ($pageno-1) * $no_of_records_per_page;
    
    //Query del conteo de los registros, con filtros
    $total_pages_sql = "SELECT COUNT(*) FROM users_tb as u ".$filter." AND ".$disabledVal."";
    $result = mysqli_query($conn,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    
    
    //Si el numero total de maginas es menor a 10 ponlas, si no, llega hasta 10
    if (intval($total_pages)<=10) {
        $total_pagination = $total_pages;
    }else{
        $total_pagination = 10;
    }

    //Codigo para la paginacion

    if ($_POST['getUsersActive']) {
        $queryList = "SELECT u.*, p.privilege_name as privilege FROM users_tb as u
        LEFT JOIN privileges_tb as p ON p.privilege_id = u.user_privileges
        WHERE u.user_disabled = '0' AND u.user_name LIKE '%".$_POST['word']."%' OR u.user_disabled = '0' AND u.user_lastname LIKE '%".$_POST['word']."%'";
        $rsList = mysqli_query($conn,$queryList);
        $rowsList = mysqli_fetch_assoc($rsList);
        $totalRowsList = mysqli_num_rows($rsList);
    }else{
        //Query para los resultados
        $queryList = "SELECT u.*, p.privilege_name as privilege FROM users_tb as u
        LEFT JOIN privileges_tb as p ON p.privilege_id = u.user_privileges
        WHERE 1=1".$filter2." LIMIT ".$offset.", ".$no_of_records_per_page."";
        $rsList = mysqli_query($conn,$queryList);
        $rowsList = mysqli_fetch_assoc($rsList);
        $totalRowsList = mysqli_num_rows($rsList);
    }


    //Guardamos el total de registros
    $total_rows = $rowsResult['total'];

    if ($totalRowsList>0) {
        do {

			array_push($data, array(
				'id' => $rowsList['user_id'], 
				'name' => $rowsList['user_name'],
                'lastname' => $rowsList['user_lastname'],
                'email' => $rowsList['user_email'],
                'privilege' => $rowsList['privilege'],
                'status' => $rowsList['user_disabled']
			));

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
            $msg_error,
        "total_pagination" =>
            $total_pagination,
        "page_number" =>
            $pageno
    ];


    echo json_encode($info);

?>