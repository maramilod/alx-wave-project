<?php
session_start();

if (isset($_POST['upload'])) {

    include "../classes/dbh.classes.php";
    $table = $_SESSION['Table_Name'];
    $Type = $_SESSION['Type'];
    $NAME = $_POST['name'];
    $PRICE = $_POST['price'];
    $NUMBER = $_POST['number_ppl'];
    $IMAGES = $_FILES['image'];

    $directory = '../images/';
    if (!is_dir($directory)) {
        mkdir($directory, 0777, true);
    }
    if (!is_writable($directory)) {
        chmod($directory, 0777);
    }

    $insert = "INSERT INTO $table (name , price , number_ppl) VALUES ('$NAME','$PRICE','$NUMBER')";
    mysqli_query($conn, $insert);

    $id = mysqli_insert_id($conn);

    $insert_all_c = "INSERT INTO all_c (id, name , price ,tata , Type , number_ppl) VALUES ('$id','$NAME','$PRICE', '$table','$Type','$NUMBER')";
    mysqli_query($conn, $insert_all_c);
    foreach ($IMAGES['name'] as $key => $image_name) {
        $image_location = $IMAGES['tmp_name'][$key];
        $image_up = "../images/" . $image_name;
$insert_images = "INSERT INTO images (ID, Image, TableN) VALUES ('$id',  '$image_up' ,'$table') ";
mysqli_query($conn, $insert_images);

        move_uploaded_file($image_location, '../images/' . $image_name);
    }

    header('location: ../dash_b/dash.php');
    exit();
}

