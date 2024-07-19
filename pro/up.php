<?php

if (isset($_POST['update'])) {
   include "../classes/dbh.classes.php";
   $table = $_POST['table'];
   $ID = $_POST['id'];
   $NAME = $_POST['name'];
   $PRICE = $_POST['price'];
   $IMAGE = $_FILES['image'];

   if (isset($IMAGE['tmp_name']) && $IMAGE['tmp_name'] != '') {
       $image_location = $IMAGE['tmp_name'];
       $image_name = $IMAGE['name'];
       $image_up = "../images/" . $image_name;
       if (move_uploaded_file($image_location, $image_up)) {
           $update = "UPDATE $table SET name='$NAME' , price='$PRICE' WHERE id=$ID";
           mysqli_query($conn, $update);
           $update_all_c = "UPDATE all_c SET name='$NAME' , price='$PRICE' WHERE id=$ID AND tata='$table'";
           mysqli_query($conn, $update_all_c);
           $update_img =  "INSERT INTO images (ID, Image, TableN) VALUES ('$ID',  '$image_up' ,'$table') ";
           mysqli_query($conn, $update_img);
           header('location: ../dash_b/dash.php');
   exit();
       } else {
           echo "<scripe>alert ('error!')</script>";
       }
   } else {
       $update = "UPDATE $table SET name='$NAME' , price='$PRICE' WHERE id=$ID";
       mysqli_query($conn, $update);
       $update_all_c = "UPDATE all_c SET name='$NAME' , price='$PRICE' WHERE id=$ID AND tata='$table'";
       mysqli_query($conn, $update_all_c);
   }
   header('location: ../dash_b/dash.php');
   exit();
}
?>