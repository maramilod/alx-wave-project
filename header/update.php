<?php

include "../classes/dbh.classes.php";

if (isset($_POST['submit'])) {

   $select_user = $con->prepare("SELECT * FROM `clients` WHERE id = ? LIMIT 1");
   $select_user->execute([$user_id]);
   $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);

   if (!empty($name)) {
      $update_name = $con->prepare("UPDATE `clients` SET name = ? WHERE id = ?");
      $update_name->execute([$name, $user_id]);
      $success_msg[] = '  Username updated successfully ';
   }

   if (!empty($email)) {
      $verify_email = $con->prepare("SELECT * FROM `clients` WHERE email = ?");
      $verify_email->execute([$email]);
      if ($verify_email->rowCount() == 0) {
         $update_email = $con->prepare("UPDATE `clients` SET email = ? WHERE id = ?");
         $update_email->execute([$email, $user_id]);
         $success_msg[] = 'Email updated successfully ';
      }
   }

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = create_unique_id() . '.' . $ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../images/' . $rename;

   if (!empty($image)) {
      if ($image_size > 2000000) {
         $warning_msg[] = 'Image size is too large!';
      } else {
         $update_image = $con->prepare("UPDATE `clients` SET image = ? WHERE id = ?");
         $update_image->execute([$rename, $user_id]);
         move_uploaded_file($image_tmp_name, $image_folder);
         if ($fetch_user['image'] != '') {
            $file = '../images/' . $fetch_user['image'];
            if (file_exists($file)) {
                unlink($file);
            }
         }
         $success_msg[] = ' The profile picture updated successfully';
      }
   }

   $prev_pass = $fetch_user['password'];

   $old_pass = password_hash($_POST['old_pass'], PASSWORD_DEFAULT);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);

   $empty_old = password_verify('', $old_pass);

   $new_pass = password_hash($_POST['new_pass'], PASSWORD_DEFAULT);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);

   $empty_new = password_verify('', $new_pass);

   $c_pass = password_verify($_POST['c_pass'], $new_pass);
   $c_pass = filter_var($c_pass, FILTER_SANITIZE_STRING);

   if ($empty_old != 1) {
      $verify_old_pass = password_verify($_POST['old_pass'], $prev_pass);
      if ($verify_old_pass == 1) {
         if ($c_pass == 1) {
            if ($empty_new != 1) {
               $update_pass = $con->prepare("UPDATE `clients` SET password = ? WHERE id = ?");
               $update_pass->execute([$new_pass, $user_id]);
               $success_msg[] = 'Password updated successfully   ';
            }
         } else {
            $warning_msg[] = 'The password was not confirmed correctly';
         }
      } else {
         $warning_msg[] = ' The password is incorrect  ';
      }
   }
}

if (isset($_POST['delete_image'])) {

   $select_old_pic = $con->prepare("SELECT * FROM `clients` WHERE id = ? LIMIT 1");
   $select_old_pic->execute([$user_id]);
   $fetch_old_pic = $select_old_pic->fetch(PDO::FETCH_ASSOC);

   if ($fetch_old_pic['image'] == '') {
      $warning_msg[] = 'The photo has already been deleted';
   } else {
      $update_old_pic = $con->prepare("UPDATE `clients` SET image = ? WHERE id = ?");
      $update_old_pic->execute(['', $user_id]);
      if ($fetch_old_pic['image'] != '') {
         unlink('../images/' . $fetch_old_pic['image']);
      }
      $success_msg[] = 'The image deleted successfully ';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">

</head>

<body>

   <!-- header section starts  -->
   <?php include '../components/header.php'; ?>
   <!-- header section ends -->

   <!-- update section starts  -->

   <section class="account-form" dir="ltr">

      <form action="" method="post" enctype="multipart/form-data">
         <h3>تعديل حسابك</h3>
         <p class="placeholder">اسمك</p>
         <input type="text" name="name" maxlength="50" placeholder="<?= $fetch_profile['name']; ?>" class="box">
         <p class="placeholder">بريدك الالكتروني</p>
         <input type="email" name="email" maxlength="50" placeholder="<?= $fetch_profile['email']; ?>" class="box">
         <p class="placeholder">كلمة المرور القديمة</p>
         <input type="password" name="old_pass" maxlength="50" placeholder="ادخل كلمة المرور" class="box">
         <p class="placeholder">كلمة المرور الجديدة</p>
         <input type="password" name="new_pass" maxlength="50" placeholder="اختر كلمة مرور جديده" class="box">
         <p class="placeholder">تأكيد كلمة المرور</p>
         <input type="password" name="c_pass" maxlength="50" placeholder="تأكيد كلمة المرور الجديده" class="box">
         <?php if ($fetch_profile['image'] != '') { ?>
            <img src="../images/<?= $fetch_profile['image']; ?>" alt="" class="image">
            <input type="submit" value="delete image" name="delete_image" class="delete-btn" onclick="return confirm('delete this image?');">
         <?php }; ?>
         <p class="placeholder">الصورة الشخصية</p>
         <input type="file" name="image" class="box" accept="image/*">
         <input type="submit" value="تعديل الان" name="submit" class="btn">
      </form>

   </section>

   <!-- update section ends -->















   <!-- sweetalert cdn link  -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

   <!-- custom js file link  -->
   <script src="../js/script.js"></script>

   <?php include '../components/alers.php'; ?>

</body>

</html>