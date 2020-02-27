<?php

require_once '../inclued/DbOperation.php';

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_POST['RCTP_APIkey']) and
       isset($_POST['RCTP_ID']) and 
       isset($_POST['TittleOfEvent']) and
       isset($_POST['EventDateTime']) and
       isset($_POST['EndDateTime']) and
       isset($_POST['TravelTime']) and
       isset($_POST['message']) and
       isset($_POST['Location']) and
       isset($_POST['Notification_Data']))
       {
          //Operate data further
          $db = new DbOperation();

          $result = $db-> eventmanagement(
            $_POST['RCTP_APIkey'],
            $_POST['RCTP_ID'],
            $_POST['TittleOfEvent'],
            $_POST['EventDateTime'],
            $_POST['EndDateTime'],
            $_POST['TravelTime'],
            $_POST['message'],
            $_POST['Location'],
            $_POST['Notification_Data']);

            if($result == 1)
            {
                $response['error'] = false;
                $response['message'] = "event details added successfully";
                $response['Status'] = "1";
            }else{
                $response['error'] = true;
                $response['message'] = "Something went wrong";
            }

       }else{
        $response['error'] = true;		
        $response['message'] = "Invalid REQUST";
       }
}
echo json_encode($response);