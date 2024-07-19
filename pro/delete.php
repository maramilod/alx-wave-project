<?php

session_start();
include "../classes/dbh.classes.php";
$ID = $_GET['id'];
$table = $_SESSION['Table_Name'];
mysqli_query($conn, "DELETE FROM $table WHERE id= $ID");
mysqli_query($conn, "DELETE FROM all_c WHERE id= $ID AND tata = '$table'");
mysqli_query($conn, "DELETE FROM images WHERE ID= $ID AND TableN = '$table'");
header('location: ../dash_b/dash.php');
?>
