<?php
include "../classes/dbh.classes.php";

$errors = []; // Array to hold error messages
$files = $_FILES['files']; // Get the files from the form
$total = count($files['name']); // Count the total number of files
$table = $_GET['ta'];
// Loop through each file
for($i=0; $i<$total; $i++) {
    // Check if the file was uploaded successfully
    if($files['error'][$i] == 0) {
        // Generate a random filename
        $filename = rand(1000000000,9999999999).'_'.md5($files['name'][$i]).'_'.time().'_'.rand(1000,9999);
        $target_file = '../images/'.$filename; // Define the path to save the file

        // Move the file to the target directory
        if(move_uploaded_file($files['tmp_name'][$i], $target_file)){
            // Insert the file info into the database
            $sql = "INSERT INTO portfolio (Host, Image) VALUES ('".$table."', '".$target_file."')";
            mysqli_query($conn, $sql);
        } else {
            // If the file wasn't moved, add an error message
            $errors[] = "Couldn't upload file ".$files['name'][$i];
        }
    } else {
        // If there was an error, add an error message
        $errors[] = "Error uploading file ".$files['name'][$i];
    }
}

// If there were any errors, print them out
if(!empty($errors)){
    foreach($errors as $error){
        echo $error . "\n";
    }
}
header("location: gallery.php")
?>
