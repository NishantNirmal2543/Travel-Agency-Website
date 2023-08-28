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
    include 'dbcon.php';
    $place = $_GET['hotel_place'];

    ?>
    <?php include 'includes/whatsapp.php'; ?>

    <section class="about-header" style="background-image: url(images/bg/varanasibg.webp);">
        <div class="auto-container">
            <div class="content-box">
                <h1>Hotels in<span style="color:red"></span><?= $place ?></h1>
            </div>
        </div>
    </section>

    <?php
    $post_id = $_GET['id'];
    $postQuery = "SELECT * from hotel_details where hotel_id=$post_id ";
    $runPQ = mysqli_query($con, $postQuery);
    while ($post = mysqli_fetch_assoc($runPQ)) {
    ?>

        <div class="hotel-container">

            <div class="hotel-desc row">
                <div class="hotel-image col-lg-6 col-sm-12">
                    <img src="images/<?= $post['image'] ?>">
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="hotel-details">
                        <div class="hotel-name">
                            <h2><?= $post['name'] ?></h2>
                        </div>
                        <div class="hotel-description">
                            <p><?= $post['description'] ?>p>
                            <div class="button-division">
                                <?php include('includes/book.php'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    <?php
    }
    ?>

    <?php include_once('includes/footer.php'); ?>
</body>

</html>