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
if (empty($_POST['function_id'])) {
    $response['success'] = false;
    $response['message'] = "Function Id is Empty";
    print_r(json_encode($response));
    return false;
}
$function_id = $db->escapeString($_POST['function_id']);

$sql = "SELECT *,m.id AS id FROM moi m,users u WHERE m.user_id = u.id AND m.function_id = '$function_id'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    foreach ($res as $row) {
        $temp['id'] = $row['id'];
        $temp['name'] = $row['name'];
        $temp['mobile'] = $row['mobile'];
        $temp['location'] = $row['location'];
        $temp['amount'] = $row['amount'];
        $rows[] = $temp;
        
    }
    $response['success'] = true;
    $response['message'] = "MOI listed Successfully";
    $response['data'] = $rows;
    print_r(json_encode($response));

}else{
    $response['success'] = false;
    $response['message'] = "No Functions Found";
    print_r(json_encode($response));

}

?>