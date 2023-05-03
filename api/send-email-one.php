<?php

    $email = $_POST['email'];
    $message = $_POST['message'];
    $subject = $_POST['subject'];

    $body = '
    <style type="text/css">

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        
        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        
        #customers tr:nth-child(even){background-color: #f2f2f2;}
        
        #customers tr:hover {background-color: #ddd;}
        
        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #001737;
            color: white;
        }

    </style>
    <h1 style="text-align: center;">Plataforma HM Consultores</h1>
    <table id="customers">
    <tr>
        <th>'.$subject.'</th>
    </tr>
    <tr>
        <td style="text-align: center;">'.$message.'</td>
    </tr>
    </table>
    <a href="#" style="color: blue; text-align: center; margin-top: 40px; display: block;">HM Consultores todos los derechos reservados</a>'; 

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= 'From: HM Consultores <info@cencerro.com.mx>' . "\r\n";

    $send = mail($email, $subject, $body, $headers);

    if ($send) {
        echo 1;
    }else{
        echo 0;
    }

?>