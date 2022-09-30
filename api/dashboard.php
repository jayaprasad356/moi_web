<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
date_default_timezone_set('Asia/Kolkata');

include_once('../includes/crud.php');

$db = new Database();
$db->connect();

if (empty($_POST['user_id'])) {
    $response['success'] = false;
    $response['message'] = "User Id is Empty";
    print_r(json_encode($response));
    return false;
}
$user_id = $db->escapeString($_POST['user_id']);


$sql = "SELECT * FROM users WHERE id = '$user_id'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num == 1) {
    $name = $res[0]['name'];
    $mobile = $res[0]['mobile'];
    $location = $res[0]['location'];
    $sql = "SELECT SUM(amount) AS debitmoi FROM moi WHERE user_id = '$user_id'";
    $db->sql($sql);
    $res = $db->getResult();
    $debitmoi = ($res[0]['debitmoi'] != null )? $res[0]['debitmoi'] : "0";
    $sql = "SELECT SUM(amount) AS creditmoi FROM moi WHERE organizer_id = '$user_id'";
    $db->sql($sql);
    $res = $db->getResult();
    $creditmoi = ($res[0]['creditmoi'] != null ) ? $res[0]['creditmoi'] : "0";
    $response['success'] = true;
    $response['message'] ="Dashboard Retrived Successfully";
    $response['name'] = $name;
    $response['mobile'] = $mobile;
    $response['location'] = $location;
    $response['debitmoi'] = $debitmoi;
    $response['creditmoi'] = $creditmoi;
    // $response['recent_functions'] = $rows;
    print_r(json_encode($response));
    return false;
}
else{
    $response['success'] = false;
    $response['message'] ="User Not Found";
    print_r(json_encode($response));
    return false;
}



?>