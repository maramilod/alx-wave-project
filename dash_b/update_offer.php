<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="../css/dash.css">
</head>

<body>
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="">
                        <span class="icon"><img src="../img/sea.png" alt=""></span>
                        <span class="title">WAVE</span>
                    </a>
                </li>

                <li>
                    <a href="dash.php">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="title"> Update Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="offers.php">
                        <span class="icon"><ion-icon name="sparkles-outline"></ion-icon></span>
                        <span class="title">Back To The Offers</span>
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
            </div>

            <?php
            include "../classes/dbh.classes.php";
            $ID = $_GET['id'];
            $_SESSION['ID'] = $ID;
            $up = mysqli_query($conn, "SELECT * FROM special_offers WHERE Offer_ID = $ID") or die(mysqli_error($conn));
            $data = mysqli_fetch_array($up);
            ?>
            <center>
                <br><br><br><br><br><br>
                <div class="add">
                    <br>
                    <br>
                    <h3>تعديل المنتجات</h3>
                    <form action="up.php" method="post" enctype="multipart/form-data">
                        <h2>ادخل البيانات</h2>
                        <br>
                           <input type="hidden" name="id" value="<?php echo $ID ?>">
                        <input type="text" name='name' value='<?php echo $data['About'] ?>'>
                        <br>
                        <input type="text" name='price' value='<?php echo $data['Offer_Price'] ?>'>
                        <br>
                        <input type="text" name='s_date' placeholder="<?php echo $data['Offer_Start_Date'] ?>">
                        <br>
                        <input type="text" name='e_date' placeholder="<?php echo $data['Offer_End_Date'] ?>">
                        <br>

                        <input type="file" id="file" name='image' value='<?php echo $data['Image'] ?>' style='display:none;'>

                        <label for="file">تحديث صورة للمنتج</label>
                        <button name='update' type='submit'>تعديل المنتج</button>

                        <br>
                        <br>
                    </form>
                </div>

            </center>

            </head>
            <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
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
</body>

</html>