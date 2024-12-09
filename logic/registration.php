<?php
    header('Content-Type: application/json');
    if($_SERVER['REQUEST_METHOD']=='POST'){
        
        $abc=file_get_contents('php://input');
        //$json= file_get_contents('php://input');
        echo json_encode($abc);

    }
?>