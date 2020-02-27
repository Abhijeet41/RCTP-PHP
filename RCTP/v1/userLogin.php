<?php

require_once '../inclued/DbOperation.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_POST['MOBILENO']) and isset($_POST['PASSWORD']))
    {
        $db = new DbOperation();

        if($db->userLogin($_POST['MOBILENO'], $_POST['PASSWORD']))   //check user authenicated or not, if this method true then user can login
        {
           $user = $db->getUserbyMObileNO($_POST['MOBILENO']);    //store user data on variable name $user
           $response['error']=false;
           $response['Status']="1";
           $response['id']=$user['id'];
           $response['NAME']=$user['NAME'];
           $response['RCTP_ID']=$user['RCTP_ID'];
           $response['DOB']=$user['DOB'];
        }else{
        $response['error'] = true;
        $response['message'] = "Invalid user name and password";
        }

    }else{
        $response['error'] = true;
        $response['message'] = "Required field are missing";
    }
}

echo json_encode($response);