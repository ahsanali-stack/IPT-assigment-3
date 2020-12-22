<?php
include 'db_connect.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class DB_FUNCTIONS
{

    private $__conn;
    private $__db;

    public $SMS_API;
    public $SMS_API_USERNAME;
    public $SMS_API_PASSWORD;
    public $SMS_API_MASK;
    public $SMS_API_COUNTRYCODE;

    public function __construct()
    {

        $this->db   = new DB_CONNECT();
        $this->conn = $this->db->connect();
        // echo 'connection ';
        if ($this->conn) {
            // echo 'connected';
        } else {
            // echo 'error while connecting';
        }
    }

    public function register_driver($branch_id,$user_name,$email,$gender,$timezone,$password,$pin_code ,$api_token,$auth_token,$city,$emergency_contact,$country_code,$mobile_no,$mobile_token,$mobile_verified,$mobile_verified_ip,$os_login,$brand_login,$api_level_login,$model_login,$imei,$cnic_no,$cnic_expiry,$license_no,$license_expiry,$lat,$lng,$registration_date
    ,$category_id,$sub_category_id,$description,$make,$model,$engine_power_cc,$registration_no,$color,$capacity,$dimension)
    {
    
        //echo $branch;
        // $branch   = $this->getBranchName($branch);
        $response = array();
    
        if (!$this->no_exist2($mobile_no)) {
    
            $maxIdStmt = "SELECT driver_id FROM drivers ORDER BY driver_id DESC LIMIT 1";
            $myResult  = $this->conn->query($maxIdStmt);
            $maxId     = 1;
    
            if ($myResult->num_rows > 0) {
                $row   = $myResult->fetch_assoc();
                $maxId = $row['driver_id'];
                $maxId = $maxId + 1;
            }
    
            $maxIdStmt = "SELECT vehicle_id FROM vehicles ORDER BY vehicle_id DESC LIMIT 1";
            $myResult  = $this->conn->query($maxIdStmt);
            $vehicle_id     = 1;
    
            if ($myResult->num_rows > 0) {
                $row   = $myResult->fetch_assoc();
                $vehicle_id = $row['vehicle_id'];
                $vehicle_id = $vehicle_id + 1;
            }
    
                // $var_merchant_profile;
                // $var_global_options;
                $profile_pic=$maxId."_p_".time();
                $cnic_front=$maxId."_fnic_".time();
                $cnic_back=$maxId."_bnic_".time();
                $license_front=$maxId."_flicense_".time();
                $license_back=$maxId."_blicense_".time();
    
                $enc_password = md5($password);
                $stmt = "INSERT INTO drivers(`driver_id`, `vehicle_id`,`branch_id`, `user_name`,`email`,`gender`,`timezone`, `password`,`pin_code`, `api_token`,`auth_token`,`city`,`emergency_contact`,`country_code`,`mobile_no`,`mobile_token`,`mobile_verified`,`mobile_verified_ip`,`os_login`,`brand_login`,`api_level_login`,`model_login`,`imei`,`cnic_no`,`cnic_expiry`,`license_no`,`license_expiry`,`lat`,`lng`,`registration_date`,`profile_pic`,`cnic_front`,`cnic_back`,`license_front`,`license_back`) VALUES ('$maxId','$vehicle_id','$branch_id','$user_name','$email','$gender','$timezone', '$enc_password','$pin_code','$api_token','$auth_token','$city','$emergency_contact', '$country_code','$mobile_no','$mobile_token','$mobile_verified','$mobile_verified_ip','$os_login','$brand_login','$api_level_login','$model_login','$imei','$cnic_no','$cnic_expiry','$license_no','$license_expiry','$lat','$lng','$registration_date','$profile_pic','$cnic_front','$cnic_back','$license_front','$license_back')";
    
                if ($this->conn->query($stmt)) 
                {
                    $photo_front=$vehicle_id."_fphoto_".time();
                    $photo_rear=$vehicle_id."_rearphoto_".time();
                    $photo_left=$vehicle_id."_lphoto_".time();
                    $photo_right=$vehicle_id."_rphoto_".time();
                    $photo_running_part=$vehicle_id."_rpart_".time();
    
                    $stmt2 = "INSERT INTO vehicles(`vehicle_id`,`driver_id`, `category_id`,`sub_category_id`,`description`,`make`, `model`,`engine_power_cc`,`registration_no`,`color`,`capacity`,`dimension`,`photo_front`,`photo_rear`,`photo_left`,`photo_right`,`photo_running_part`) VALUES ('$vehicle_id','$maxId','$category_id','$sub_category_id','$description','$make','$model','$engine_power_cc','$registration_no','$color', '$capacity','$dimension','$photo_front','$photo_rear','$photo_left','$photo_right','$photo_running_part')";
    
                     if($this->conn->query($stmt2))
                     {
                         //returning the array of pictures 
                        $return = array();
                        $return['profile_pic']=$profile_pic;
                        $return['cnic_front']=$cnic_front;
                        $return['cnic_back']=$cnic_back;
                        $return['license_front']=$license_front;
                        $return['license_back']=$license_back;
                        $return['vehicle_front']=$photo_front;
                        $return['vehicle_rear']=$photo_rear;
                        $return['vehicle_left']=$photo_left;
                        $return['vehicle_right']=$photo_right;
                        $return['runnig_part']=$photo_running_part;
    
                        $stmt3 = "INSERT INTO wallet_driver(`wallet_id`) VALUES ('$maxId')";
                        if ($this->conn->query($stmt3)) 
                        {
                            $response['error']   = false;
                            $response['message'] = 'Acount Created Succefully';
                            $response['member']  =$return;
                        }
                        else
                        {
                            $response['error']   = true;
                            $response['message'] = 'Failed to create account ' . $stmt3;
                            $response['member']  = null;
                        }
                     }
                     else
                     {
                        $response['error']   = true;
                        $response['message'] = 'Failed to create account ' . $stmt;
                        $response['member']  = null;
                     }
    
                } else {
                    $response['error']   = true;
                    $response['message'] = 'Failed to create account ' . $stmt;
                    $response['member']  = null;
                }
    
        } else {
            $response['error']   = true;
            $response['message'] = 'Account Already exist';
            $response['member']  = null;
        }
    
        echo json_encode($response);
    
    }
}
