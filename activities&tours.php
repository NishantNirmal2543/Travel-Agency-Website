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
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $post_per_page = 6;
    $result = ($page - 1) * $post_per_page; ?>

    <?php include 'includes/whatsapp.php'; ?>

    <section class="title about-header" style="background-image: url(images/bg/banner.jpg);">
        <h1>Activities & <span style="color:red">Tours</span></h1>
    </section>

    <div class="bookbutton">
        <?php include_once('includes/book.php'); ?>
    </div>

    <section class="dom">

        <div class="row dom1 g-5 ">
            <?php
            $postQuery = "SELECT * from activityiternary ORDER BY id DESC LIMIT $result, $post_per_page";
            $runPQ = mysqli_query($con, $postQuery);
            while ($post = mysqli_fetch_assoc($runPQ)) {
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <a href="activity.php?id=<?= $post['id'] ?>" style="text-decoration: none; color:black;">
                    <div class="image-content">
                        <span class="overlay"></span>
                        <div class="card-image">
                            <img src="images/activity/<?= $post['image'] ?>" alt="1" class="card-img">
                            <div class="short-info">
                                <div class="tourname">

                                    <i class="fa-solid fa-person-walking"></i>
                                    <?= $post['activity_title'] ?>
                                </div>
                                <div class="tourprice">

                                    <span style="font-size: 20px;  float: right;" class="price">
                                        ₹<?= $post['amount'] ?>/
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-content-home">
                        <div class="cardd">


                            <div class="name">
                                <strong>Highlights:</strong><?= $post['highlights'] ?>
                            </div>

                        </div>


                        <div class="butn">
                            <button class="button" onclick="document.location='activity.php?id=<?= $post['id'] ?>'">Know
                                More</button>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            }
            ?>



        </div>

    </section>


    <?php include_once('includes/footer.php'); ?>


</body>

</html>