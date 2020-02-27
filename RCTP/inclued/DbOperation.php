<?php

class DbOperation
{
    //database connection link
    private $con;

    //class constructor
    function __construct()
    {
        //getting the DbConnect.php
        require_once dirname(__FILE__) . '/DbConnect.php';
        
        //creating  a DbConnect object to connect to the database
        $db = new DbConnect();

         //Initializing our connection link of this class
        //by calling the method connect of DbConnect class

        $this->con = $db->connect();

    }

    public function createRegistration($RCTP_APIkey, $MOBILENO, $PASSWORD)
    {
        if($this->isMObileExist($MOBILENO))
        {
            return 0;
        }else{
            $PASSWORD = md5($PASSWORD);
            $stmt = $this->con->prepare("INSERT INTO rctpreg (RCTP_APIkey, MOBILENO, PASSWORD) VALUES (?, ?, ?)");
            $stmt->bind_param("sss",$RCTP_APIkey, $MOBILENO, $PASSWORD);
           if($stmt->execute())
           {
               return 1;
           }else{
               return 2;
           } 
        }
    }

    private function isMobileExist($MOBILENO)
    {
        $stmt = $this->con->prepare("SELECT id FROM rctpreg WHERE MOBILENO = ?");
        $stmt->bind_param("s", $MOBILENO);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows >0;
    }

    public function userDb ($RCTP_APIkey, $RCTP_ID, $NAME, $MOBILENO, $DOB, $AGE, $ORGANIZATION, $CLASSIFICATION, $VOCATION, $SUBVOCATION, $SPOUSENAME, $SPOUSEGENDER, $SPOUSENUMEBR, $SPOUSEBIRTHDATE, $ANNIVERSARYDATE, $KIDS_DETAILS, $PASSWORD, $Email_Id, $PROFILEPHOTO)
    {
        $PASSWORD = md5($PASSWORD);
        $stmt = $this->con->prepare("INSERT INTO userDb (RCTP_APIkey, RCTP_ID, NAME, MOBILENO, DOB, AGE, ORGANIZATION, CLASSIFICATION, VOCATION, SUBVOCATION, SPOUSENAME, SPOUSEGENDER, SPOUSENUMEBR, SPOUSEBIRTHDATE, ANNIVERSARYDATE, KIDS_DETAILS, PASSWORD, Email_Id, PROFILEPHOTO) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssssssssssss", $RCTP_APIkey, $RCTP_ID, $NAME, $MOBILENO, $DOB, $AGE, $ORGANIZATION, $CLASSIFICATION, $VOCATION, $SUBVOCATION, $SPOUSENAME, $SPOUSEGENDER, $SPOUSENUMEBR, $SPOUSEBIRTHDATE, $ANNIVERSARYDATE, $KIDS_DETAILS, $PASSWORD, $Email_Id, $PROFILEPHOTO);
        if($stmt->execute())
        {
            return 1;
        }else{
            return 2;
        }    
    }

    public function userLogin($MOBILENO, $PASSWORD)
    {
        $PASSWORD = md5($PASSWORD);
        $stmt = $this->con->prepare("SELECT id FROM userdb WHERE MOBILENO = ? AND PASSWORD = ?");
        $stmt->bind_param("ss",$MOBILENO,$PASSWORD);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows>0;  //if above query returns any result that means its authentic    
    }
    //fetch user details from database 
    public function getUserbyMObileNO($MOBILENO)
    {
        $stmt = $this->con->prepare("SELECT * FROM userdb WHERE MOBILENO = ?");
        $stmt->bind_param("s",$MOBILENO);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();  
         //get_result property becouse we fetching details using post method

    }

    public function eventmanagement ($RCTP_APIkey, $RCTP_ID, $TittleOfEvent, $EventDateTime, $EndDateTime, $TravelTime, $message, $Location, $Notification_Data)
    {
        $stmt = $this->con->prepare("INSERT INTO eventManagment (RCTP_APIkey, RCTP_ID, TittleOfEvent, EventDateTime, EndDateTime, TravelTime, message, Location, Notification_Data) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss",$RCTP_APIkey, $RCTP_ID, $TittleOfEvent, $EventDateTime, $EndDateTime, $TravelTime, $message, $Location, $Notification_Data);
        if($stmt->execute())
        {
            return 1;
        }else{
            return 2;
        }    
    }

    // public function showEvent($RCTP_APIkey)
    // {
    //     $stmt = $this->con->prepare("SELECT * FROM eventManagment WHERE RCTP_APIkey = ?");
    //     $stmt->bind_param("s",$RCTP_APIkey);
    //     $stmt->execute();
    //     return $stmt->get_result()->fetch_assoc();  
    // }

    public function getEventbykey ($RCTP_APIkey)
    {
        $stmt = $this->con->prepare("SELECT * FROM userdb WHERE RCTP_APIkey = ?");
        $stmt->bind_param("s",$RCTP_APIkey);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    function getEvents()
    {
        $stmt = $this->con->prepare("SELECT TittleOfEvent,EventDateTime,EndDateTime,TravelTime,message,Location FROM eventmanagment");
        $stmt->execute();
        $stmt->bind_result($TittleOfEvent,$EventDateTime,$EndDateTime,$TravelTime,$message,$Location);

        $EventList = array();
        while($stmt->fetch())
        {
            $event = array();
            $event['TittleOfEvent'] = $TittleOfEvent; 
            $event['EventDateTime'] = $EventDateTime; 
            $event['EndDateTime'] = $EndDateTime; 
            $event['TravelTime'] = $TravelTime;
            $event['message'] = $message;
            $event['Location'] = $Location; 

            array_push($EventList, $event);

        }
        return $EventList;
    }

}