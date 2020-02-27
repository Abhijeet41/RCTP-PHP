<?php

require_once '../inclued/DbOperation.php';

$response = array();


if ($_SERVER['REQUEST_METHOD']=='POST') {
    if (isset($_POST['RCTP_APIkey']) and 
        isset($_POST['MOBILENO']) and 
        isset($_POST['PASSWORD'])) 
            {
            //Operate data further
            $db = new DbOperation();
               //creating object

            $result = $db-> createRegistration(
                $_POST['RCTP_APIkey'],
                $_POST['MOBILENO'],
                $_POST['PASSWORD']); 

            if($result == 1){
                $response['error'] = false;
                $response['message'] = "User registered successfully";
                $response['Status'] = "0";
            }else if($result == 2){
                $response['error'] = true;
                $response['message'] = "Something went wrong";
            }else if ($result == 0) {
                $response['error'] = true;
                $response['Status'] = "1";
                $response['message'] = "User already exist in database";
            }

        }else
        {
            $response['error'] = true;
            $response['message'] = "Required field are missing";
        }
    }

    else
    {
        $response['error'] = true;		
        $response['message'] = "Invalid REQUST";
    }		

echo json_encode($response);