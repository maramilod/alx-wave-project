<?php

include "../classes/dbh.classes.php";

if (isset($_GET['get_id'])) {
   $get_id = $_GET['get_id'];
} else {
   $get_id = '';
   header('location:../index/index.php');
}

if (isset($_POST['delete_review'])) {

   $delete_id = $_POST['delete_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $verify_delete = $con->prepare("SELECT * FROM `reviews` WHERE id = ?");
   $verify_delete->execute([$delete_id]);

   if ($verify_delete->rowCount() > 0) {
      $delete_review = $con->prepare("DELETE FROM `reviews` WHERE id = ?");
      $delete_review->execute([$delete_id]);
      $success_msg[] = 'Review deleted!';
   } else {
      $warning_msg[] = 'Review already deleted!';
   }
}

?>

<!DOCTYPE html;
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Review</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">

   <!-- custom js file link  -->
   <script src="../js/script.js" defer></script>

</head>

<body>

   <!-- header section starts  -->
   <?php include '../components/header.php'; ?>
   <!-- header section ends -->

   <!-- view posts section starts  -->

   <section class="view-post">

      <div class="heading">
         <h1>post details</h1>
      </div>


      <?php
      $select_post = $con->prepare("SELECT * FROM `all_c` WHERE id = ? LIMIT 1");
     
      $select_post->execute([$get_id]);
      if ($select_post->rowCount() > 0) {
         while ($fetch_post = $select_post->fetch(PDO::FETCH_ASSOC)) {

            $total_ratings = 0;
            $rating_1 = 0;
            $rating_2 = 0;
            $rating_3 = 0;
            $rating_4 = 0;
            $rating_5 = 0;

            
            $select_photo = $con->prepare("SELECT * FROM `images` WHERE ID = ?");
            $select_photo->execute([$fetch_post['id']]); // Execut
            ?>

<div class="container">
      <div class="slider-wrapper">
        <button id="prev-slide" class="slide-button material-symbols-rounded">
        <i class="fa-solid fa-arrow-left"></i>
        </button>
        <ul class="image-list">
                  <?php
            if ($select_photo->rowCount() > 0) {
              echo "feeey";
  while ($fetch_photo = $select_photo->fetch(PDO::FETCH_ASSOC)) {
     echo "weeey";
?>
           <img class="image-item" src="<?= $fetch_photo['Image']; ?>" alt="" >
           <?php
        }}
        ?>
         </ul>
        <button id="next-slide" class="slide-button material-symbols-rounded">
        <i class="fa-solid fa-arrow-right"></i>
        </button>
      </div>
      <div class="slider-scrollbar">
        <div class="scrollbar-track">
          <div class="scrollbar-thumb"></div>
        </div>
      </div>
    </div>
    <?php

            $select_ratings = $con->prepare("SELECT * FROM `reviews` WHERE post_id = ?");
            $select_ratings->execute([$fetch_post['id']]);
            $total_reivews = $select_ratings->rowCount();
            while ($fetch_rating = $select_ratings->fetch(PDO::FETCH_ASSOC)) {
               $total_ratings += $fetch_rating['rating'];
               if ($fetch_rating['rating'] == 1) {
                  $rating_1 += $fetch_rating['rating'];
               }
               if ($fetch_rating['rating'] == 2) {
                  $rating_2 += $fetch_rating['rating'];
               }
               if ($fetch_rating['rating'] == 3) {
                  $rating_3 += $fetch_rating['rating'];
               }
               if ($fetch_rating['rating'] == 4) {
                  $rating_4 += $fetch_rating['rating'];
               }
               if ($fetch_rating['rating'] == 5) {
                  $rating_5 += $fetch_rating['rating'];
               }
            }

            if ($total_reivews != 0) {
               $average = round($total_ratings / $total_reivews, 1);
            } else {
               $average = 0;
            }
            if (!is_null($fetch_post['number_ppl']) && $fetch_post['number_ppl'] != "" && $fetch_post['number_ppl'] != "0") {
            $fetch_post['number_ppl'] .= '  Number of People Allowed';
            }else {
               $fetch_post['number_ppl'] = "";
            }
      ?>
            <div class="row">
               <div class="col" dir="ltr">
                 
               <h3 class="title" ><?= $fetch_post['tata']; ?></h3>
                  <br>
                  <h3 class="title"><?= $fetch_post['name']; ?></h3>
                  <br>
                  <h3 class="title"><?= $fetch_post['number_ppl']; ?></h3>
                  
               </div>
               <div class="col">
                  <div class="flex">
                     <div class="total-reviews">
                        <h3><?= $average; ?><i class="fas fa-star"></i></h3>
                        <p><?= $total_reivews; ?> Reviews</p>
                     </div>
                     <div class="total-ratings">
                        <p>
                           <i class="fas fa-star"></i>
                           <i class="fas fa-star"></i>
                           <i class="fas fa-star"></i>
                           <i class="fas fa-star"></i>
                           <i class="fas fa-star"></i>
                           <span><?= $rating_5; ?></span>
                        </p>
                        <p>
                           <i class="fas fa-star"></i>
                           <i class="fas fa-star"></i>
                           <i class="fas fa-star"></i>
                           <i class="fas fa-star"></i>
                           <span><?= $rating_4; ?></span>
                        </p>
                        <p>
                           <i class="fas fa-star"></i>
                           <i class="fas fa-star"></i>
                           <i class="fas fa-star"></i>
                           <span><?= $rating_3; ?></span>
                        </p>
                        <p>
                           <i class="fas fa-star"></i>
                           <i class="fas fa-star"></i>
                           <span><?= $rating_2; ?></span>
                        </p>
                        <p>
                           <i class="fas fa-star"></i>
                           <span><?= $rating_1; ?></span>
                        </p>
                     </div>
                  </div>
               </div>
            </div>
      <?php
         }
      } else {
         echo '<p class="empty">post is missing!</p>';
      }
      ?>

   </section>

   <!-- view posts section ends -->

   <!-- reviews section starts  -->

   <section class="reviews-container">

      <div class="heading">
       <a href="add_review.php?get_id=<?= $get_id; ?>" class="inline-btn" style="margin-top: 0;">Add Review </a>  <h1>Users Review </h1> 
      </div>

      <div class="box-container">

         <?php
         $select_reviews = $con->prepare("SELECT * FROM `reviews` WHERE post_id = ?");
         $select_reviews->execute([$get_id]);
         if ($select_reviews->rowCount() > 0) {
            while ($fetch_review = $select_reviews->fetch(PDO::FETCH_ASSOC)) {
         ?>
               <div class="box" <?php if ($fetch_review['user_id'] == $user_id) {
                                    echo 'style="order: -1;"';
                                 }; ?>>
                  <?php
                  $select_user = $con->prepare("SELECT * FROM `clients` WHERE id = ?");
                  $select_user->execute([$fetch_review['user_id']]);
                  while ($fetch_user = $select_user->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                     <div class="user" dir="ltr">
                        <?php if ($fetch_user['image'] != '') { ?>
                           <img src="../images/<?= $fetch_user['image']; ?>" alt="">
                        <?php } else { ?>
                           <h3><?= substr($fetch_user['name'], 0, 1); ?></h3>
                        <?php }; ?>
                        <div>
                           <p ><?= $fetch_user['name']; ?></p>
                           <span><?= $fetch_review['date']; ?></span>
                        </div>
                     </div>
                  <?php }; ?>
                  <div class="ratings" dir="ltr">
                     <?php if ($fetch_review['rating'] == 1) { ?>
                        <p style="background:var(--red);"><i class="fas fa-star"></i> <span><?= $fetch_review['rating']; ?></span></p>
                     <?php }; ?>
                     <?php if ($fetch_review['rating'] == 2) { ?>
                        <p style="background:var(--orange);"><i class="fas fa-star"></i> <span><?= $fetch_review['rating']; ?></span></p>
                     <?php }; ?>
                     <?php if ($fetch_review['rating'] == 3) { ?>
                        <p style="background:var(--orange);"><i class="fas fa-star"></i> <span><?= $fetch_review['rating']; ?></span></p>
                     <?php }; ?>
                     <?php if ($fetch_review['rating'] == 4) { ?>
                        <p style="background:var(--orange);"><i class="fas fa-star"></i> <span><?= $fetch_review['rating']; ?></span></p>
                     <?php }; ?>
                     <?php if ($fetch_review['rating'] == 5) { ?>
                        <p style="background:var(--orange);" ><i class="fas fa-star"></i> <span><?= $fetch_review['rating']; ?> </span></p>
                     <?php }; ?>
                  </div>
                  <h3 class="title" dir="ltr" ><?= $fetch_review['title']; ?></h3>
                  <?php if ($fetch_review['description'] != '') { ?>
                     <p class="description" dir="ltr"><?= $fetch_review['description']; ?></p>
                  <?php }; ?>
                  <?php if ($fetch_review['user_id'] == $user_id) { ?>
                     <form action="" method="post" class="flex-btn">
                        <input type="hidden" name="delete_id" value="<?= $fetch_review['id']; ?>">
                        <a href="update_review.php?get_id=<?= $fetch_review['id']; ?>" class="inline-option-btn"> Update Review</a>
                        <input type="submit" value="Delete Review " class="inline-delete-btn" name="delete_review" onclick="return confirm('delete this review?');">
                     </form>
                  <?php }; ?>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">no reviews added yet!</p>';
         }
         ?>

      </div>

   </section>

   <!-- reviews section ends -->


   <!-- sweetalert cdn link  -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

   <?php include '../components/alers.php'; ?>

</body>

</html>