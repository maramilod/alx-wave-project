<?php
session_start();

if (isset($_SESSION['ID']) && isset($_SESSION['Email'])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../css/styleslider.css">

        <link rel="stylesheet" href="../css/dash.css">
        
        <title>mangement</title>
    </head>
    <body>
        <!-- القائمة-->
        <div class="container">
            <div class="navigation">
                <ul>
                    <li>
                        <a href="">
                            <span class="icon"><img src="../img/sea.png" alt=""></span>
                            <span class="title"><?php echo $_SESSION['Table_Name']; ?></span>
                        </a>
                    </li>

                    <li>
                        <a href="dash.php">
                            <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="offers.php">
                            <span class="icon"><ion-icon name="sparkles-outline"></ion-icon></span>
                            <span class="title">Offers</span>
                        </a>
                    </li>

                    <li>
                        <a href="gallery.php">
                            <span class="icon"><ion-icon name="images"></ion-icon></ion-icon></span>
                            <span class="title">Gallery</span>
                        </a>
                    </li>


                    <li>
                        <a href="setting.php">
                            <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                            <span class="title">Settings</span>
                        </a>
                    </li>

                    <li>
                        <a href="../includes/logout.php">
                            <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                            <span class="title">Sign Out</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- main -->
            <div class="main">
                <div class="topbar">
                    <div class="toggle">
                        <ion-icon name="menu-outline"></ion-icon>
                    </div>

                    <!-- userImg -->
                    <div class="user">
                        <img src="<?php echo $_SESSION['Image']; ?>" alt="">
                    </div>
                </div>

                <!-- ADD form  -->

                <center>
                    <div class="add">
                    <form action=<?php echo "insert.php?ta=$_SESSION[Table_Name]"?> method="post" enctype="multipart/form-data">
    <label for="file">Choose the pics *</label>
    <input type="file" name="files[]" multiple/>
    <button name='upload'>Upload</button>
</form>

                    </div>


                </center>

               



                <?php
                $table = $_SESSION['Table_Name'] ?? '';
                $ID = $_SESSION['ID'] ?? '';
                include "../classes/dbh.classes.php";

                if (!$conn) {
                    die('Database connection failed');
                }

               
                    ?>



<section id="tranding">
      <div class="containerr">
        <h3 class="text-center section-subheading">- معرض الصور -</h3>
      </div>
      <div class="container">
        <div class="swiper tranding-slider">
          <div class="swiper-wrapper">
                 <?php 
                 $query = mysqli_query($conn, "SELECT * FROM portfolio WHERE Host='$table'") or die(mysqli_error($conn));
                
                if (mysqli_num_rows($query) > 0) {
                    while ($ROW = mysqli_fetch_array($query)) {?>
                   
                        <div class="swiper-slide tranding-slide">
              <div class="tranding-slide-img">
             
                    <img src="<?php echo $ROW["Image"]; ?>" alt="" />
             
              <div class="tranding-slide-content">
                <div class="tranding-slide-content-bottom">
                  
                    <div class="delete_g">
                  <a href=<?php echo "delete.php?id=$ROW[ID]"?> class='btn btn-danger'>Delete</a></div>
                 
                 
                </div>
              </div>
            </div>
                   
                                
                                </div>
                           
                         
                    <?php }
            } ?>  



</div>

<div class="tranding-slider-control">
  <div class="swiper-button-prev slider-arrow">
    <ion-icon name="arrow-back-outline"></ion-icon>
  </div>
  <div class="swiper-button-next slider-arrow">
    <ion-icon name="arrow-forward-outline"></ion-icon>
  </div>
  <div class="swiper-pagination"></div>
</div>

</div>
</div>
</section>
</div>

            <!-- Slide-end -->
       
       
                   
       <!-- روابط الجافا الي تفعالن كال icons-->
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
 <!-- الجافا سكريبت الي تتحكام كالقائمة -->
        <script>

            
            //Menu Toggle
            let toggle = document.querySelector('.toggle');
            let navigation = document.querySelector('.navigation');
            let main = document.querySelector('.main');

            toggle.onclick = function() {
                navigation.classList.toggle('active');
                main.classList.toggle('active');
            }

            //add hovered class selected list item
            let list = document.querySelectorAll('.navigation li');

            function activeLink() {
                list.forEach((item) =>
                    item.classList.remove('hovered'));
                this.classList.add('hovered');
            }
            list.forEach((item) =>
                item.addEvenrListener('mouseover', activeLink));
        </script>



<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="../js/scriptslider.js"></script>
    </body>

    </html>
<?php
} else {

    header("Location: /mynewproject/index/index.php");
    exit();
}
?>