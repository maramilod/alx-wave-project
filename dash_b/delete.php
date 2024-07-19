<?php

session_start();
include "../classes/dbh.classes.php";
$ID = $_GET['id'];
mysqli_query($conn, "DELETE FROM portfolio WHERE ID = $ID");
header('location: gallery.php');
?>
