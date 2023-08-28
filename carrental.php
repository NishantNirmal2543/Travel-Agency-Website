<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sacred tours and travels</title>

    <?php include_once('includes/links.php'); ?>

</head>

<body>

    <?php include_once('includes/navbar.php');
    include 'dbcon.php'; ?>
    <?php include 'includes/whatsapp.php'; ?>
    <section class="about-header" style="background-image: url(images/bg/banner.jpg);">
        <div class="auto-container">
            <div class="content-box">
                <h1>Car/Coach <span style="color:red">Rental</span></h1>
            </div>
        </div>
    </section>

    <section class="carsection">
        <div class="title">
            <h2><span>Transport at Sacred India Tours & Travels</span> comes with a huge bonus "Choice"</h2>
        </div>

        <div class="row car g-5">
            <?php
            $postQuery = "SELECT * from vehicle_details ORDER BY id DESC";
            $runPQ = mysqli_query($con, $postQuery);
            while ($post = mysqli_fetch_assoc($runPQ)) {
            ?>
                <div class="col-lg-4 col-md-6 col-mb-12">
                    <div class="car-img">
                        <img src="images/vehicle/<?= $post['image'] ?>" alt="car image">
                    </div>
                    <div class="car-desc">
                        <h5>
                            <?= $post['vehicle_category'] ?>
                        </h5>
                        <p> <?= $post['vehicle_name'] ?></p>
                        <ul class="sublist">
                            <?php
                            $post_id = $post['id'];
                            $featureQuery = "SELECT * from vehicle_features WHERE vehicle_id='$post_id'";
                            $runFQ = mysqli_query($con, $featureQuery);
                            while ($feature = mysqli_fetch_assoc($runFQ)) {
                            ?>
                                <li> <?= $feature['feature'] ?></li>
                            <?php
                            }
                            ?>
                        </ul>
                        <?php include('includes/book.php'); ?>
                        <?php include 'includes/whatsapp.php'; ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

    </section>

    <?php include_once('includes/footer.php'); ?>

</body>

</html>