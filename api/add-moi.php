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

if (empty($_POST['organizer_id'])) {
    $response['success'] = false;
    $response['message'] = "Organizer Id is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['mobile'])) {
    $response['success'] = false;
    $response['message'] = "Mobilenumber is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['function_id'])) {
    $response['success'] = false;
    $response['message'] = "Function Id is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['amount'])) {
    $response['success'] = false;
    $response['message'] = "Amount is Empty";
    print_r(json_encode($response));
    return false;
}
$organizer_id = $db->escapeString($_POST['organizer_id']);
$mobile = $db->escapeString($_POST['mobile']);
$function_id = $db->escapeString($_POST['function_id']);
$amount = $db->escapeString($_POST['amount']);

$sql = "SELECT * FROM users WHERE mobile = '$mobile'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num == 1) {
    $user_id = $res[0]['id'];
    $sql = "INSERT INTO moi (`user_id`,`organizer_id`,`function_id`,`amount`)VALUES('$user_id','$organizer_id','$function_id','$amount')";
    $db->sql($sql);
    $response['success'] = true;
    $response['message'] ="MOi Added Successfully";
    print_r(json_encode($response));
    return false;
}
else{
    
    $response['success'] = false;
    $response['message'] ="Mobile Number Not Registered";
    print_r(json_encode($response));
    return false;

}

?>