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
    $sql = "SELECT SUM(amount) AS debitmoi FROM moi WHERE user_id = '$user_id'";
    $db->sql($sql);
    $res = $db->getResult();
    $debitmoi = ($res[0]['debitmoi'] == 'NULL') ? $res[0]['debitmoi'] : "0";
    $sql = "SELECT SUM(amount) AS creditmoi FROM moi WHERE organizer_id = '$user_id'";
    $db->sql($sql);
    $res = $db->getResult();
    $creditmoi = ($res[0]['creditmoi'] == 'NULL') ? $res[0]['creditmoi'] : "0";

    // $sql = "SELECT * FROM functions WHERE user_id='$user_id' ORDER BY id DESC LIMIT 10";
    // $db->sql($sql);
    // $res = $db->getResult();
    // $rows = array();
    // foreach ($res as $row) {
    //     $temp['id'] = $row['id'];
    //     $temp['user_id'] = $row['user_id'];
    //     $temp['function_name'] = $row['function_name'];
    //     $temp['image'] = DOMAIN_URL . $row['image'];
    //     $temp['place'] = $row['place'];
    //     $temp['date'] = $row['date'];
    //     $rows[] = $temp;
        
    // }
    $response['success'] = false;
    $response['message'] ="Dashboard Retrived Successfully";
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