<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


include_once('../includes/crud.php');

$db = new Database();
$db->connect();

if (empty($_POST['user_id'])) {
    $response['success'] = false;
    $response['message'] = "User Id is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['function_name'])) {
    $response['success'] = false;
    $response['message'] = "Function Name is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['place'])) {
    $response['success'] = false;
    $response['message'] = "Place is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['date'])) {
    $response['success'] = false;
    $response['message'] = "Date is Empty";
    print_r(json_encode($response));
    return false;
}
$user_id = $db->escapeString($_POST['user_id']);
$function_name = $db->escapeString($_POST['function_name']);
$place = $db->escapeString($_POST['place']);
$date = $db->escapeString($_POST['date']);
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num == 1) {
    $sql = "INSERT INTO functions (`user_id`,`function_name`,`place`,`date`)VALUES('$user_id','$function_name','$place','$date')";
    $db->sql($sql);
    $response['success'] = true;
    $response['message'] ="Function Added Successfully";
    print_r(json_encode($response));
    return false;
}
else{
    
    $response['success'] = false;
    $response['message'] ="User Id not found";
    print_r(json_encode($response));
    return false;

}



?>