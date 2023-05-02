<?php 

    include '../db/connection.php';

	$info = [];
    $data = [];

    $word = $_POST['word'];
    $field = $_POST['field'];
    $table = $_POST['table'];
    $leftjoin = $_POST['leftjoin'];

    //Filtramos usuarios
    if ($table == 'users') {

        //Si no requerimos buscar en la otra tabla, entonces
        if ($leftjoin == '1') {
            $queryList = "SELECT u.*, p.privilege_name as privilege FROM users_tb as u
            LEFT JOIN privileges_tb as p ON p.privilege_id = u.user_privileges
            WHERE u.".$field." LIKE '%".$word."%'";
            $rsList = mysqli_query($conn,$queryList);
            $rowsList = mysqli_fetch_assoc($rsList);
            $totalRowsList = mysqli_num_rows($rsList);
        //Si requerimos buscar en la tabla de privilegios, entonces
        } else {
            $queryList = "SELECT u.*, p.privilege_name as privilege FROM users_tb as u
            LEFT JOIN privileges_tb as p ON p.privilege_id = u.user_privileges
            WHERE p.privilege_name LIKE '%".$word."%'";
            $rsList = mysqli_query($conn,$queryList);
            $rowsList = mysqli_fetch_assoc($rsList);
            $totalRowsList = mysqli_num_rows($rsList);
        }


        if ($totalRowsList>0) {
            do {

                array_push($data, array(

                    'id' => $rowsList['user_id'], 
                    'name' => $rowsList['user_name'],
                    'lastname' => $rowsList['user_lastname'],
                    'email' => $rowsList['user_email'],
                    'privileges' => $rowsList['privilege']

                ));

            } while ($rowsList = mysqli_fetch_assoc($rsList));


            $error = false;
            $msg_error = 'Lista obtenida con exito';
        } else {
            $error = false;
            $msg_error = 'Lo sentimos, no hay registros.';
        }

    }//Se acaba validacion de filtros de usuarios

    //Filtramos oficinas
    if ($table == 'offices') {


        $queryList = "SELECT * FROM offices_tb
        WHERE ".$field." LIKE '%".$word."%'";
        $rsList = mysqli_query($conn,$queryList);
        $rowsList = mysqli_fetch_assoc($rsList);
        $totalRowsList = mysqli_num_rows($rsList);


        if ($totalRowsList>0) {
            do {

                array_push($data, array(

                    'id' => $rowsList['office_id'], 
                    'name' => $rowsList['office_name'],
                    'address' => $rowsList['office_address'],
                    'phone' => $rowsList['office_phone']

                ));

            } while ($rowsList = mysqli_fetch_assoc($rsList));


            $error = false;
            $msg_error = 'Lista obtenida con exito';
        } else {
            $error = false;
            $msg_error = 'Lo sentimos, no hay registros.';
        }

    }//Se acaba validacion de filtros de oficinas

    //Filtramos clientes
    if ($table == 'clients') {

        if ($field == 'client_name') {
            $queryList = "SELECT * FROM clients_tb
            WHERE client_name LIKE '%".$word."%' OR client_enterprise LIKE '%".$word."%'";
            $rsList = mysqli_query($conn,$queryList);
            $rowsList = mysqli_fetch_assoc($rsList);
            $totalRowsList = mysqli_num_rows($rsList);

        } else if($field == 'client_type'){

            //Si la palabra coincide con 'Empresa'
            if(stristr('Empresa', $word) !== FALSE) {
                $queryList = "SELECT * FROM clients_tb
                WHERE client_is_enterprise = '1'";
                $rsList = mysqli_query($conn,$queryList);
                $rowsList = mysqli_fetch_assoc($rsList);
                $totalRowsList = mysqli_num_rows($rsList);
            //Si no la buscamos por 'Normal'
            }elseif (stristr('Normal', $word) !== FALSE) {
                $queryList = "SELECT * FROM clients_tb
                WHERE client_is_enterprise = '0'";
                $rsList = mysqli_query($conn,$queryList);
                $rowsList = mysqli_fetch_assoc($rsList);
                $totalRowsList = mysqli_num_rows($rsList);
            }else{
                $queryList = "SELECT * FROM clients_tb
                WHERE 1=1";
                $rsList = mysqli_query($conn,$queryList);
                $rowsList = mysqli_fetch_assoc($rsList);
                $totalRowsList = mysqli_num_rows($rsList);
            }
            

        } else {
            $queryList = "SELECT * FROM clients_tb
            WHERE ".$field." LIKE '%".$word."%'";
            $rsList = mysqli_query($conn,$queryList);
            $rowsList = mysqli_fetch_assoc($rsList);
            $totalRowsList = mysqli_num_rows($rsList);
        }

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
                        'is_enterprise' => '0'
                    ));
                }

            } while ($rowsList = mysqli_fetch_assoc($rsList));


            $error = false;
            $msg_error = 'Lista obtenida con exito';
        } else {
            $error = false;
            $msg_error = 'Lo sentimos, no hay registros.';
        }

    }//Se acaba validacion de filtros de clientes

    //Filtramos cobranza
    if ($table == 'debts') {
    
        if ($field == 'debt_client_id') {
            $queryList = "SELECT d.*, c.client_name, c.client_lastname, c.client_enterprise, c.client_is_enterprise 
            FROM debts_tb as d
            LEFT JOIN clients_tb as c ON c.client_id = d.debt_client_id
            WHERE c.client_name LIKE '%".$word."%' OR c.client_enterprise LIKE '%".$word."%'";
            $rsList = mysqli_query($conn,$queryList);
            $rowsList = mysqli_fetch_assoc($rsList);
            $totalRowsList = mysqli_num_rows($rsList);

        } else if($field == 'debt_status'){

            //Si la palabra coincide con 'Empresa'
            if(stristr('Sin pagar', $word) !== FALSE) {
                $queryList = "SELECT d.*, c.client_name, c.client_lastname, c.client_enterprise, c.client_is_enterprise 
                FROM debts_tb as d
                LEFT JOIN clients_tb as c ON c.client_id = d.debt_client_id
                WHERE d.debt_status = '0'";
                $rsList = mysqli_query($conn,$queryList);
                $rowsList = mysqli_fetch_assoc($rsList);
                $totalRowsList = mysqli_num_rows($rsList);
            //Si no la buscamos por 'Normal'
            }elseif (stristr('Pagado', $word) !== FALSE) {
                $queryList = "SELECT d.*, c.client_name, c.client_lastname, c.client_enterprise, c.client_is_enterprise 
                FROM debts_tb as d
                LEFT JOIN clients_tb as c ON c.client_id = d.debt_client_id
                WHERE d.debt_status = '1'";
                $rsList = mysqli_query($conn,$queryList);
                $rowsList = mysqli_fetch_assoc($rsList);
                $totalRowsList = mysqli_num_rows($rsList);
            }else{
                $queryList = "SELECT d.*, c.client_name, c.client_lastname, c.client_enterprise, c.client_is_enterprise  
                FROM debts_tb as d
                LEFT JOIN clients_tb as c ON c.client_id = d.debt_client_id
                WHERE 1=1";
                $rsList = mysqli_query($conn,$queryList);
                $rowsList = mysqli_fetch_assoc($rsList);
                $totalRowsList = mysqli_num_rows($rsList);
            }
            

        } else {
            $queryList = "SELECT d.*, c.client_name, c.client_lastname, c.client_enterprise, c.client_is_enterprise  
            FROM debts_tb as d
            LEFT JOIN clients_tb as c ON c.client_id = d.debt_client_id
            WHERE d.".$field." LIKE '%".$word."%'";
            $rsList = mysqli_query($conn,$queryList);
            $rowsList = mysqli_fetch_assoc($rsList);
            $totalRowsList = mysqli_num_rows($rsList);
        }

        if ($totalRowsList>0) {
            do {

                if ($rowsList['client_is_enterprise'] == '1') {
                    $clientVal = $rowsList['client_enterprise'];
                } else {
                    $clientVal = $rowsList['client_name'].' '.$rowsList['client_lastname'];
                }
                
    
                array_push($data, array(
                    'id' => $rowsList['debt_id'], 
                    'client_id' => $rowsList['debt_client_id'],
                    'description' => $rowsList['debt_description'],
                    'amount' => '$'.number_format($rowsList['debt_amount']),
                    'status' => $rowsList['debt_status'],
                    'client_name' => $rowsList['client_name'],
                    'client_lastname' => $rowsList['client_lastname'],
                    'enterprise' => $rowsList['client_enterprise'],
                    'is_enterprise' => $rowsList['client_is_enterprise'],
                    'client' => $clientVal
                ));

            } while ($rowsList = mysqli_fetch_assoc($rsList));


            $error = false;
            $msg_error = 'Lista obtenida con exito';
        } else {
            $error = false;
            $msg_error = 'Lo sentimos, no hay registros.';
        }

    }//Fin del filtro de cobranza

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