<?php

include "../classes/dbh.classes.php";

if(isset($_POST['submit'])){

   $id = create_unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $c_pass = password_verify($_POST['c_pass'], $pass);
   $c_pass = filter_var($c_pass, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = create_unique_id().'.'.$ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../images/'.$rename;

   if(!empty($image)){
      if($image_size > 2000000){
         $warning_msg[] = 'The images is large';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);
      }
   }else{
      $rename = '';
   }

   $verify_email = $con->prepare("SELECT * FROM `clients` WHERE email = ?");
   $verify_email->execute([$email]);

   if($verify_email->rowCount() > 0){
      $warning_msg[] = ' This email address already been used';
   }else{
      if($c_pass == 1){
         $insert_user = $con->prepare("INSERT INTO `clients`(id, name, email, password, image) VALUES(?,?,?,?,?)");
         $insert_user->execute([$id, $name, $email, $pass, $rename]);
         $success_msg[] = 'The account was successfully created ';
      }else{
         $warning_msg[] = 'لم يتم تأكيد كلمة المرور بشكل صحيح';
      }
   }
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include '../components/header.php'; ?>
<!-- header section ends -->

<section class="account-form" dir="ltr">

<form action="" method="post" enctype="multipart/form-data">
    <h3>Create Account</h3>
    <p class="placeholder">Name<span>*</span></p>
    <input type="text" name="name" required maxlength="50" class="box">
    <p class="placeholder">Email Address <span>*</span></p>
    <input type="email" name="email" required maxlength="50" class="box">
    <p class="placeholder">Password<span>*</span></p>
    <input type="password" name="pass" required maxlength="50" class="box">
    <p class="placeholder">Confirm Password<span>*</span></p>
    <input type="password" name="c_pass" required maxlength="50" class="box">
    <p class="placeholder">Profile Picture</p>
    <input type="file" name="image" class="box" accept="image/*">
    <p class="link">Already Have an Account? <a href="login.php">Login</a></p>
    <input type="submit" value="Create Account" name="submit" class="btn">
</form>


</section>


<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="../js/script.js"></script>

<?php include '../components/alers.php'; ?>

</body>
</html>