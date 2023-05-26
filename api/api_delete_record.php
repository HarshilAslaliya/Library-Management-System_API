<?php

include('../Config/config.php');
$config = new Config();


if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
    parse_str(file_get_contents('php://input'), $_DELETE);

    $delete_res = $config->delete($_DELETE['id']);

    http_response_code(200);
    if ($delete_res) {
        $res['msg'] = "Record Deleted Successfully...";
    } else {
        $res['msg'] = "Record Deletion Failed...";
    }
} else {
    $res['msg'] = "Only Delete Request Is Allowed";
}

echo json_encode($res);
