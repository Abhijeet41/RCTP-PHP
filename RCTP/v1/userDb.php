<?php

require_once '../inclued/DbOperation.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_POST['RCTP_APIkey']) and
       isset($_POST['RCTP_ID']) and
       isset($_POST['NAME']) and
       isset($_POST['MOBILENO']) and
       isset($_POST['DOB']) and
       isset($_POST['AGE']) and
       isset($_POST['ORGANIZATION']) and
       isset($_POST['CLASSIFICATION']) and
       isset($_POST['VOCATION']) and
       isset($_POST['SUBVOCATION']) and
       isset($_POST['SPOUSENAME']) and
       isset($_POST['SPOUSEGENDER']) and
       isset($_POST['SPOUSENUMEBR']) and
       isset($_POST['SPOUSEBIRTHDATE']) and
       isset($_POST['ANNIVERSARYDATE']) and
       isset($_POST['KIDS_DETAILS']) and
       isset($_POST['PASSWORD']) and
       isset($_POST['Email_Id']) and
       isset($_POST['PROFILEPHOTO']))
       {
             //Operate data further
             $db = new DbOperation();
             //creating object
             
             $result = $db-> userDb(
                $_POST['RCTP_APIkey'],
                $_POST['RCTP_ID'],
                $_POST['NAME'],
                $_POST['MOBILENO'],
                $_POST['DOB'],
                $_POST['AGE'],
                $_POST['ORGANIZATION'],
                $_POST['CLASSIFICATION'],
                $_POST['VOCATION'],
                $_POST['SUBVOCATION'],
                $_POST['SPOUSENAME'],
                $_POST['SPOUSEGENDER'],
                $_POST['SPOUSENUMEBR'],
                $_POST['SPOUSEBIRTHDATE'],
                $_POST['ANNIVERSARYDATE'],
                $_POST['KIDS_DETAILS'],
                $_POST['PASSWORD'],
                $_POST['Email_Id'],
                $_POST['PROFILEPHOTO']);
        
                if($result == 1)
                {
                    $response['error'] = false;
                    $response['message'] = "User information added successfully";
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