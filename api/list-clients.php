<?php 

error_reporting(0);

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
    if (isset($_POST['client_id_filt']) && $_POST['client_id_filt'] !== '') {
        $filter .= " AND client_id = ".$_POST['client_id_filt']." ";
        $filter2 .= " AND client_id = ".$_POST['client_id_filt']." ";
    }

    if (isset($_POST['client_name_filt']) && $_POST['client_name_filt'] !== '') {
        $filter .= " AND client_name LIKE '%".$_POST['client_name_filt']."%' OR client_enterprise LIKE '%".$_POST['client_name_filt']."%'";
        $filter2 .= " AND client_name LIKE '%".$_POST['client_name_filt']."%' OR client_enterprise LIKE '%".$_POST['client_name_filt']."%'";
    }

    if (isset($_POST['client_email_filt']) && $_POST['client_email_filt'] !== '') {
        $filter .= " AND client_email LIKE '%".$_POST['client_email_filt']."%' ";
        $filter2 .= " AND client_email LIKE '%".$_POST['client_email_filt']."%' ";
    }

    if (isset($_POST['client_rfc_filt']) && $_POST['client_rfc_filt'] !== '') {
        $filter .= " AND client_rfc LIKE '%".$_POST['client_rfc_filt']."%' ";
        $filter2 .= " AND client_rfc LIKE '%".$_POST['client_rfc_filt']."%' ";
    }

    if (isset($_POST['client_phone_filt']) && $_POST['client_phone_filt'] !== '') {
        $filter .= " AND client_phone LIKE '%".$_POST['client_phone_filt']."%' ";
        $filter2 .= " AND client_phone LIKE '%".$_POST['client_phone_filt']."%' ";
    }

    if (isset($_POST['client_disabled_filt']) && $_POST['client_disabled_filt'] !== '') {
        switch (true) {
            case stristr('Activo', $_POST['client_disabled_filt']) !== FALSE:
                $filter .= " AND client_disabled = '0'";
                $filter2 .= " AND client_disabled = '0'";
                break;
            case stristr('Inactivo', $_POST['client_disabled_filt']) !== FALSE:
                $filter .= " AND client_disabled = '1'";
                $filter2 .= " AND client_disabled = '1'";
                break;
            default:
        }
    }

    if (isset($_POST['client_type_filt']) && $_POST['client_type_filt'] !== '') {
        if(stristr('Moral', $_POST['client_type_filt']) !== FALSE) {
            $filter .= " AND client_is_enterprise = '1'";
            $filter2 .= " AND client_is_enterprise = '1'";
        }elseif (stristr('Física', $_POST['client_type_filt']) !== FALSE) {
            $filter .= " AND client_is_enterprise = '0'";
            $filter2 .= " AND client_is_enterprise = '0'";
        }else{
            $filter .= " AND 1=1";
            $filter2 .= " AND 1=1";
        }

    }

    //Obtenemos el numero de registros por pagina
    $offset = ($pageno-1) * $no_of_records_per_page;
    
    //Query del conteo de los registros, con filtros
    $total_pages_sql = "SELECT COUNT(*) FROM clients_tb ".$filter." AND ".$disabledVal."";
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

    //Query para los resultados
    $queryList = "SELECT * FROM clients_tb WHERE 1=1".$filter2." LIMIT ".$offset.", ".$no_of_records_per_page."";
	$rsList = mysqli_query($conn,$queryList);
	$rowsList = mysqli_fetch_assoc($rsList);
	$totalRowsList = mysqli_num_rows($rsList);


    //Guardamos el total de registros
    $total_rows = $rowsResult['total'];

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
                    'status' => $rowsList['client_disabled'],
                    'is_enterprise' => '1'
                ));
            //Si es cliente normal
            } else {
                array_push($data, array(
                    'id' => $rowsList['client_id'], 
                    'name' => $rowsList['client_name'].' '.$rowsList['client_lastname'],
                    'email' => $rowsList['client_email'],
                    'rfc' => $rowsList['client_rfc'],
                    'address' => $rowsList['client_address'],
                    'phone' => $rowsList['client_phone'],
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
            $msg_error,
        "total_pagination" =>
            $total_pagination,
        "page_number" =>
            $pageno
    ];


    echo json_encode($info);
