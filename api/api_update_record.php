<?php
include('../Config/config.php');

header('Content-Type: applicaion/json');
header('Access-control-Allow-Method: PUT,PATCH');

$config = new Config();


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id               = $_POST['id'];
    $book_name        = $_POST['book_name'];
    $author_name      = $_POST['author_name'];
    $price            = $_POST['price'];
    $year = $_POST['year'];
    $language         = $_POST['language'];
    $image            = $_FILES['image'];

    $img = uniqid() . "_" . $image['name'];


    $filename = "../photos/store/" . $img;
    $path     = $image['tmp_name'];


    $update_res = $config->update($id, $book_name, $author_name, $price, $year, $language, $img);


    if (move_uploaded_file($path, $filename)) {
        $res['data'] = "Record image update Successfully...";
    } else {
        $res['data'] = "Insert image update failed...";
    }


    if ($update_res) {
        $res['msg'] = "Record Update Successfully....";
    } else {
        $res['msg'] = "Record Updation Failed...";
    }
} else {
    $res['msg'] = "Only POST Requests Are Allowed.........";
}

echo json_encode($res);
