<?php
$response = array();
include 'db_functions.php';
$db = new DB_FUNCTIONS();


if (isset($_POST['branch_id']) && isset($_POST['user_name']) && isset($_POST['email'])
&& isset($_POST['gender']) && isset($_POST['timezone']) && isset($_POST['password']) && isset($_POST['pin_code']) && isset($_POST['api_token']) && isset($_POST['auth_token'])
&& isset($_POST['city']) && isset($_POST['emergency_contact']) && isset($_POST['country_code']) && isset($_POST['mobile_no']) && isset($_POST['mobile_token']) && isset($_POST['mobile_verified']) && isset($_POST['mobile_verified_ip']) 
&& isset($_POST['os_login']) && isset($_POST['brand_login']) && isset($_POST['api_level_login']) && isset($_POST['model_login']) && isset($_POST['imei'])
&& isset($_POST['cnic_no']) && isset($_POST['cnic_expiry']) 
&& isset($_POST['license_no']) && isset($_POST['license_expiry']) 
&& isset($_POST['lat'])&& isset($_POST['lng'])&& isset($_POST['registration_date'])
&& isset($_POST['category_id']) && isset($_POST['sub_category_id']) 
&& isset($_POST['description']) && isset($_POST['make']) && isset($_POST['model']) && isset($_POST['engine_power_cc']) 
&& isset($_POST['registration_no']) && isset($_POST['color']) && isset($_POST['capacity']) && isset($_POST['dimension']))
{
    $db->register_driver($_POST['branch_id'],$_POST['user_name'],$_POST['email'],
    $_POST['gender'],$_POST['timezone'],$_POST['password'],$_POST['pin_code'],$_POST['api_token'],$_POST['auth_token'],
    $_POST['city'],$_POST['emergency_contact'],$_POST['country_code'],$_POST['mobile_no'],$_POST['mobile_token'],$_POST['mobile_verified'],$_POST['mobile_verified_ip'],
    $_POST['os_login'],$_POST['brand_login'],$_POST['api_level_login'],$_POST['model_login'],$_POST['imei'],
    $_POST['cnic_no'],$_POST['cnic_expiry'],
    $_POST['license_no'],$_POST['license_expiry'],
    $_POST['lat'],$_POST['lng'],$_POST['registration_date'],
    $_POST['category_id'],$_POST['sub_category_id'],
    $_POST['description'],$_POST['make'],$_POST['model'],$_POST['engine_power_cc'],
    $_POST['registration_no'],$_POST['color'],$_POST['capacity'],$_POST['dimension']);

} else {
    $response['error']   = true;
    $response['message'] = 'Required parameters not found';
    echo json_encode($response);

}