<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/e353ffb60a.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css">

  <link rel="stylesheet" href="../css/owl.carousel.min.css">
  <link rel="stylesheet" href="../css/owl.theme.default.min.css">

  <link rel="stylesheet" href="../css/aos.css">

  <link rel="stylesheet" href="../css/test.css">

  <title>WAVE | AGENCY</title>
</head>

<body>
  <!--------------- Header --------------->
  <header>
    <div class="logo" id="home">
      <img src="../img/sea.png" alt="">
      <h1>WAVE</h1>
    </div>
    <nav>
      <!-- اضاف ال menutoggle() كالهدر غرم -->
      <ul id='menulist'>
        <li onclick="menutoggle()"><a href="#connect">Contact</a></li>
        <li onclick="menutoggle()"><a href="#offers">All Offers</a></li>
        <li onclick="menutoggle()"><a href="#events">Special Events</a></li>
        <li onclick="menutoggle()"><a href="#services">Services</a></li>
        <button class="btnLogin-popup" onclick="menutoggle()">login</button>
      </ul>
      <span class="bar" onclick="menutoggle()"><ion-icon name="list"></ion-icon>
      </span>
    </nav>
  </header>
  <!-------x------- Header -------x------->
  <!--------------- VIDEO --------------->
  <div class="video">
    <div class="video-container">
      <video autoplay muted loop>
        <source src="../img/sea4.mp4" type="video/mp4" />
      </video>
      <!-------x------- VIDEO -------x------->

      <!--------------- Wave Shape --------------->
      <img src="../img/bbb.png" alt="">
    </div>
    <!-------x------- Wave Shape -------x------->

    <!-- <div class="words"><h1>Vacation Rental ^-^</h1></div> -->

    <!--------------- Login Wrapper --------------->
    <div class="wrapper">
      <span class="icon-close"><ion-icon name="close"></ion-icon></span>
      <div class="form-box login">
        <h2>Login </h2>
        <br><br>
        <form action="../includes/login.inc.php" method="post">
          <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
          <?php } ?>
          <div class="input-box">
            <span class="icon"><ion-icon name="person"></ion-icon></span>
            <input type="text" name="uname" dir="ltr" required>
            <label>Email </label>
          </div>
          <div class="input-box">
            <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
            <input type="password" name="password" dir="ltr" required>
            <label> Password</label>
          </div>
          <div class="remember-forgot">
            <label><input type="checkbox">Remember Me</label>
            Forgot Password¿
          </div>
          <br>
          <br>
          <button type="sumbit" name="submit" class="btnn"> Sign In</button>
        </form>
      </div>
    </div>
  </div>
  <!-------x------- Wave Shape -------x------->
 
  <!--------------- Cards ------------>
  <main>
    <section>
      <div class="blog" id="services">
        <div class="container">
          <div class="owl-carousel owl-theme blog-post">
            <div class="blog-content" data-aos="fade-right" data-aos-delay="200">
              <img src="../img/booking.png" alt="post-1">
              <div class="blog-title">
                <h3>Verified Customer Reviews</h3>
                <span>Benefit from our customer review service, where you can read experiences of previous customers and inquiries about rentals and available rooms. These reviews give you a comprehensive view of the quality of service and facilities available.</span>
              </div>
            </div>

            <div class="blog-content" data-aos="fade-in" data-aos-delay="200">
              <img src="../img/feature-selection.png" alt="post-1">
              <div class="blog-title">
                <h3>A Wide Range of Options</h3>
                <span>We offer a wide range of options for room bookings in various areas and luxurious villas at varying prices to suit all tastes, as well as exclusive offers for events taking place.</span>
              </div>
            </div>

            <div class="blog-content" data-aos="fade-left" data-aos-delay="200">
              <img src="../img/percent.png" alt="post-1">
              <div class="blog-title">
                <h3>Exclusive Discounts</h3>
                <span>We offer regular discounts and special promotions on villa rentals. Take advantage of our promotional deals to save money on your booking. Be ready to follow our limited-time offers and seasonal discounts to ensure you get the best value for the money you spend.</span>
              </div>
            </div>

          </div>
          <div class="owl-navigation">
            <span class="owl-nav-prev"><i class="fas fa-long-arrow-alt-left"></i></span>
            <span class="owl-nav-next"><i class="fas fa-long-arrow-alt-right"></i></span>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!-- -------x------- Cards -----x------ -->

  <!--------------- Level Slider ------------>
  <section class="section-gray">
    <div class="container">
      <div class="row">

        <div class="col-lg-8">
          <div class="level-slider">

            <?php
            include "../classes/dbh.classes.php";
            $query = mysqli_query($conn, "SELECT * FROM hosts");
            if (mysqli_num_rows($query) > 0) {

              while ($row = mysqli_fetch_assoc($query)) {
                $host = $row['Table_Name'];
                if ($row['Table_Name'] != 'administrator' && $row['ID'] != 3) {
                  $imagePath = $row["Image"];
            ?>

<article class="level-slider-item">
<div class="imageslider">
  <img src="<?php echo $imagePath ; ?>" alt="" />
                 <?php 
                 $images = mysqli_query($conn, "SELECT * FROM  portfolio WHERE Host='$host'");
            if (mysqli_num_rows($images) > 0) {
              while ($rowi = mysqli_fetch_assoc($images)) {?>
             
                    <img src="<?php echo $rowi["Image"]; ?>" alt="" />
                 
                    <?php }
            } ?>   </div>
                    <div class="level-slider-item-container">
                      <h2><?php echo $row["Table_Name"]; ?></h2>
                      <p dir="ltr">Available Communication Methods 'click' </p>
                      <div class="list-host"></div>
                      <ul>
                        <li><a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo $row["Location"]; ?>&dirflg=d" target="_blank" rel="noopener noreferrer"><ion-icon name="map"></ion-icon></a></li>
                        <li><a href="mailto:<?php echo $row["Email"]; ?>?subject=From%20Wave" target="_blank" rel="noopener noreferrer"><ion-icon name="mail"></ion-icon></a></li>
                        <li><a href="https://wa.me/<?php echo $row["Phone_Number"];  ?>?text=From%20Wave" target="_blank" rel="noopener noreferrer"><ion-icon name="logo-whatsapp"></ion-icon></a></li>
                      </ul>
                    </div>
                  </article>
            <?php }
              }
            }
            ?>
          </div>
        </div>
        <!-------x------- Level Slider -------x------->

        <!--------------- Star Place --------------->
        <div class="col-lg-4">
          <div class="star-places" id="events">

          <div class="star-places-header">
              <h3>Special Offers</h3>
              <p>For a Limited Time</p>
            </div>
            <div class="star-places-body">
              <?php
              $query = mysqli_query($conn, "SELECT * FROM special_offers");
              if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                  $imagePath = $row["Image"];
                  $post_id = $row['Offer_ID'];
                  if (!is_null($row['Offer_Price']) && $row['Offer_Price'] != "") {
                    // Add 'LY'
                    $row['Offer_Price'] .= ' LY';
                  }
              ?>
                  <div class="card" dir="ltr">
                  <img src="<?php echo $imagePath;?>" alt="place image">
                    <p><?php echo $row["About"];?></p>
                    <h1>The Price <?php echo $row["Offer_Price"];?> </h1>
                    <h2>Starts <?php echo $row["Offer_Start_Date"];?></h2>
                    <h2>Ends <?php echo $row["Offer_End_Date"];?></h2>
                    <h2 dir="ltr"><?php echo $row["table"];?></h2>
                  </div>
              <?php }
              } else {
                echo '<p class="empty">no posts added yet!</p>';
              } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--------x------- Star Place -------x------->

  <!--------------- All Offers --------------->
  <div class="all" id="offers">
    <div class="filters">
      <form method="POST" action="">
        <div class="select" >
          <select name="price" dir="ltr" >
            <?php
            // Fetch all unique prices from your database
            $result = mysqli_query($conn, "SELECT DISTINCT price FROM all_c");
            echo "<option value=''>Maximum Cost: All</option>";
            while ($row = mysqli_fetch_assoc($result)) {
              $price = $row['price'];
              echo "<option value='$price' >$price LY</option>";
            }
            ?>
          </select>

          <select name="Type" dir="ltr">
            <?php

            // Fetch all unique Type from your database
            $result = mysqli_query($conn, "SELECT DISTINCT Type FROM all_c");
            echo "<option value=''>Offer Type: All</option>";
            while ($row = mysqli_fetch_assoc($result)) {
              $type = $row['Type'];
              echo "<option value='$type'>$type</option>";
            }
            ?>
          </select>
          <select name="number_ppl" dir="ltr">
            <?php

            // Fetch all unique Type from your database
            $result = mysqli_query($conn, "SELECT DISTINCT number_ppl FROM all_c");
            echo "<option value=''>>Number of People Allowed: All</option>";
            while ($row = mysqli_fetch_assoc($result)) {
              $number_ppl = $row['number_ppl'];
              if ($number_ppl != 0)
                echo "<option value='$number_ppl'>$number_ppl</option>";
            }
            ?>
          </select>
          <input class="botten" type="submit" value="filter">
      </form>
    </div>

    <form method="POST" action="">
      <input type="text" name="search" placeholder="Search by price, location name, number of people, or other...." dir="ltr">
      <input type="submit" value="Search">
    </form>
  </div>
  <div class="offers">
    <div class="container">
      <?php
      $query = "SELECT * FROM all_c";
      $conditions = array();

      if (isset($_POST['Type'])  && $_POST['Type'] != '') {
        $type = $_POST['Type'];
        $conditions[] = "Type = '$type'";
      }

      if (isset($_POST['price'])  && $_POST['price'] != '') {
        $price = $_POST['price'];
        $conditions[] = "price <= '$price'";
      }

      if (isset($_POST['number_ppl'])  && $_POST['number_ppl'] != '') {
        $number_ppl = $_POST['number_ppl'];
        $conditions[] = "number_ppl = '$number_ppl'";
      }

      if (isset($_POST['search'])) {
        $searchTerm = $_POST['search'];
        $conditions[] = "Type LIKE '%$searchTerm%' OR price LIKE '%$searchTerm%' OR CONCAT(price, ' LY') LIKE '%$searchTerm%' OR name LIKE '%$searchTerm%' OR tata LIKE '%$searchTerm%'";
      }

      if (!empty($conditions)) {
        $query .= " WHERE " . implode(' AND ', $conditions);
      }


      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $post_id = $row['id'];
         
        

          $count_reviews = $con->prepare("SELECT * FROM `reviews` WHERE post_id = ?");
          $count_reviews->execute([$post_id]);
          $total_reviews = $count_reviews->rowCount();
      ?>
          <div class="col-md-4">
            <div class="box"> <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
  <div class="carousel-inner">
              <div class="data"> 
                <?php
              $images = mysqli_query($conn, "SELECT * FROM images WHERE ID='$post_id' AND TableN='$row[tata]'") or die(mysqli_error($conn));
          if ($images && mysqli_num_rows($images) > 0) {
            for ($i = 1; $i < 2; $i++) {
              $ROW = mysqli_fetch_array($images);
                  ?> <div class="carousel-item active">
         <img src="<?php echo "$ROW[Image]"; ?>" alt="" /> </div>
      <?php 
      }
      while ($ROW = mysqli_fetch_array($images)) {
        ?> <div class="carousel-item ">
<img src="<?php echo "$ROW[Image]"; ?>" alt="" /> </div>
<?php
    }}
              ?>
              </div>
             
   
   
    
   
 
  </div>

</div>
              <div class="info">
                <h3><?php echo $row["name"]; ?></h3>
                <p><?php echo $row["price"]; ?> LY</p>
                <p class="total-reviews"><i class="fas fa-star"></i> <span><?= $total_reviews; ?></span></p>
                <a href="../rev/view_post.php?get_id=<?= $post_id; ?>" class="btn btn-primary btn-fit">Reviews</a>
              </div>
            </div>
          </div>
      <?php
        }
      } else {
        echo "0 results";
      }

      ?>
    </div>
  </div>
  </div>

  <button class="btn btn-danger center-block loadMore"> more...</button>
  <!-------x------- All Offers-------x------->

  <!--------------- Map & Form groups --------------->
  <section class="map-con">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="map-container"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d53581.432999183504!2d12.080776599999988!3d32.928836849999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13a961f3cd613c19%3A0x91852e54e28cdc3c!2sZuwara!5e0!3m2!1sen!2sly!4v1696422236717!5m2!1sen!2sly" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
        </div>
        <div class="col-lg-6">
          <section>
            <div class="container">
          

<form action="https://formspree.io/f/xayryonb" class="contact-form" method="POST">
  <div class="form-group" id="connect">
    <input type="text" name="name" class="form-control" placeholder="Name" dir="ltr" required>
    <i class="fa fa-user"></i>
  </div>

  <div class="form-group">
    <input type="email" name="email" class="form-control" placeholder="Email" dir="ltr" required>
    <i class="fa fa-envelope"></i>
  </div>

  <div class="form-group">
    <input type="text" name="subject" class="form-control" placeholder="Subject" dir="ltr" required>
    <i class="fa fa-book"></i>
  </div>

  <div class="form-group">
    <textarea type="text" name="message" class="form-control" placeholder="Message" rows="9" dir="ltr" required></textarea>
    <i class="fa fa-commenting"></i>
  </div>
  <button type="submit" class="btn btn-primary">Send Now</button>
</form>

            </div>
        </div>
      </div>
    </div>
    </div>
    </div>
  </section>
  <!-------x------- Map & Form groups -------x------->
  <!--------------- Footer --------------->
  <footer>
    <div class="waves">
      <div class="wave" id="wave1"></div>
      <div class="wave" id="wave2"></div>
      <div class="wave" id="wave3"></div>
      <div class="wave" id="wave4"></div>
    </div>
    <ul class="social_icon">
      <li><a href="#"><ion-icon name="logo-facebook"></ion-icon></a></li>
      <li><a href="#"><ion-icon name="logo-instagram"></ion-icon></a></li>
      <li><a href="#"><ion-icon name="logo-twitter"></ion-icon></a></li>
      <li><a href="#"><ion-icon name="logo-linkedin"></ion-icon></a></li>
    </ul>

    <ul class="menu" dir="ltr">
      <li><a href="#home"> login</a></li>
      <li><a href="#Service">Services</a></li>
      <li><a href="#events"> Special Events</a></li>
      <li><a href="#offers">All Offers</a></li>
      <li><a href="#connect">Contact</a></li>
    </ul>
    <p class="copyright">&copy; 2024 made by Maram Milod All Right Reserved </p>

  </footer>
  <!-------x------- the end YAY!-------x------->
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <script src="../js/owl.carousel.min.js"></script>
  <script src="../js/aos.js"></script>
  <script src="../js/test.js"></script>


</body>

</html>