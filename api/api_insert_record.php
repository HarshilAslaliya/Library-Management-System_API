<?php

include('../Config/config.php');
$confing = new Config();
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $book_name        = $_POST['book_name'];
    $author_name      = $_POST['author_name'];
    $price            = $_POST['price'];
    $year = $_POST['year'];
    $language         = $_POST['language'];
    $image            = $_FILES['image'];

    $img = uniqid() . "_" . $image['name'];

    $inserted_res = $confing->insert_record($book_name, $author_name, $price, $year, $language, $img);

    $filename = "../photos/store/" . $img;
    $path     = $image['tmp_name'];
    if (move_uploaded_file($path, $filename)) {
        $res['data'] = "Insert image Successfully...";
    } else {
        $res['data'] = "Insert image failed...";
    }

    if ($inserted_res) {
        $res['data'] = "Insert Record Successfully...";
    } else {
        $res['data'] = "Insert Record failed...";
    }
} else {
    $res['data'] = "Use POST Method...";
}
echo json_encode($res);
