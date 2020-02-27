<?php

require_once '../inclued/DbOperation.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    // if($isset($_POST['RCTP_APIkey']))
    // {
        $db = new DbOperation();
        $response['EventList'] = $db->getEvents();
    // }else{
    //     $response['error'] = true;
    //     $response['message'] = "Invalid primary key";
        
    // }

}else{
    $response['error'] = true;
    $response['message'] = "Required field are missing";
}
echo json_encode($response);