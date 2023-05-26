<?php

include('../Config/config.php');
$config = new Config();

header('Content-Type: application/json');
header('Access-Control-Allow-Methods:GET');

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    if (isset($_GET['id']) == null) {
        $result  = $config->fetch_record();
        $recodes = [];
        while ($recode = mysqli_fetch_assoc($result)) {
            foreach ($recode as $k => $v) {
                $new_recode[$k] = $v;
            }
            array_push($recodes, $new_recode);
        }
        header('location: api_all_record.php');
        $res['data'] = $recodes;
    } else {
        $id     = $_GET['id'];
        $result = $config->fetch_single_record($id);
        $recode = mysqli_fetch_assoc($result);
        if ($recode == null) {
            $res['data'] = "Record Not found...";
        } else {
            http_response_code(200);
            $res["data"] = $recode;
        }
    }

    http_response_code(200);
} else {
    $res['msg'] = "Only GET Method Allowd....";
}

echo json_encode($res);
