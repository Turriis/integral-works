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
    if (isset($_POST['order_id_filt']) && $_POST['order_id_filt'] !== '') {
        $filter .= " AND order_id = ".$_POST['order_id_filt']." ";
        $filter2 .= " AND order_id = ".$_POST['order_id_filt']." ";
    }

    if (isset($_POST['order_office_id_filt']) && $_POST['order_office_id_filt'] !== '') {
        $filter .= " AND of.office_name LIKE '%".$_POST['order_office_id_filt']."%' ";
        $filter2 .= " AND of.office_name LIKE '%".$_POST['order_office_id_filt']."%' ";
    }

    if (isset($_POST['order_article_filt']) && $_POST['order_article_filt'] !== '') {
        $filter .= " AND order_article LIKE '%".$_POST['order_article_filt']."%' ";
        $filter2 .= " AND order_article LIKE '%".$_POST['order_article_filt']."%' ";
    }

    if (isset($_POST['order_cost_filt']) && $_POST['order_cost_filt'] !== '') {
        $filter .= " AND order_cost LIKE '%".$_POST['order_cost_filt']."%' ";
        $filter2 .= " AND order_cost LIKE '%".$_POST['order_cost_filt']."%' ";
    }

    if (isset($_POST['order_pieces_filt']) && $_POST['order_pieces_filt'] !== '') {
        $filter .= " AND order_pieces LIKE '%".$_POST['order_pieces_filt']."%' ";
        $filter2 .= " AND order_pieces LIKE '%".$_POST['order_pieces_filt']."%' ";
    }

    if (isset($_POST['order_total_filt']) && $_POST['order_total_filt'] !== '') {
        $filter .= " AND order_total LIKE '%".$_POST['order_total_filt']."%' ";
        $filter2 .= " AND order_total LIKE '%".$_POST['order_total_filt']."%' ";
    }

    //Obtenemos el numero de registros por pagina
    $offset = ($pageno-1) * $no_of_records_per_page;
    
    //Query del conteo de los registros, con filtros
    $total_pages_sql = "SELECT COUNT(*) FROM orders_tb ".$filter." AND ".$disabledVal."";
    $result = mysqli_query($conn,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);
    
    //Si el numero total de maginas es menor a 10 ponlas, si no, llega hasta 10
    if (intval($total_pages)<=10) {
        $total_pagination = $total_pages;
    }else{
        $total_pagination = 10;
    }

    $queryList = "SELECT o.*, of.office_name FROM orders_tb as o
    LEFT JOIN offices_tb as of ON of.office_id = o.order_office_id
    WHERE 1=1".$filter2." LIMIT ".$offset.", ".$no_of_records_per_page."";
	$rsList = mysqli_query($conn,$queryList);
	$rowsList = mysqli_fetch_assoc($rsList);
	$totalRowsList = mysqli_num_rows($rsList);

    //Guardamos el total de registros
    $total_rows = $rowsResult['total'];

    if ($totalRowsList>0) {
        do {

			array_push($data, array(
				'id' => $rowsList['order_id'], 
				'office' => $rowsList['office_name'],
                'article' => $rowsList['order_article'],
                'cost' => '$'.number_format($rowsList['order_cost']),
                'pieces' => $rowsList['order_pieces'],
                'total' => '$'.number_format($rowsList['order_total'])
			));

		} while ($rowsList = mysqli_fetch_assoc($rsList));


        $error = false;
        $msg_error = 'Lista obtenida con exito';
    } else {
        $error = false;
        $msg_error = 'Lo sentimos, no hay oficinas dados de alta.';
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