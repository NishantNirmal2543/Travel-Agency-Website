<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sacred tours and travels</title>

    <?php include_once('includes/links.php'); ?>

</head>

<body>
    <?php include_once('includes/navbar.php');
    include 'dbcon.php';
    ?>
    <?php include 'includes/whatsapp.php'; ?>

    <?php
    $post_id = $_GET['id'];
    $postQuery = "SELECT * from activityiternary WHERE id='$post_id'";
    $runPQ = mysqli_query($con, $postQuery);
    $post = mysqli_fetch_assoc($runPQ);
    ?>
    <div class="title about-header" style="background-image: url(images/activity/<?= $post['bgimage'] ?>);">
        <div class="iternary-title title">
            <h3><?= $post['activity_title'] ?></h3>
        </div>
    </div>

    <section class="sec">

        <div class="iternary-data row">
            <div class="iternary-left col-lg-4">
                <div class="iternary-left-data">
                    <h2 class="tourprice">
                        <i class="fa-solid fa-indian-rupee-sign"></i> <?= $post['amount'] ?>
                        <span>(Onwards Per Person)</span>
                    </h2>

                    <ul class="tourtype">

                        <li>
                            <i class="fa-solid fa-arrow-right"></i>
                            Highlights :<br />
                            <span><?= $post['highlights'] ?>
                            </span>
                        </li>
                    </ul>
                    <div class="iternarybookbtn">
                        <?php include_once('includes/book.php'); ?>
                    </div>
                </div>
            </div>

            <div class="iternary-right col-lg-8">
                <div class="iternary-right-data">
                    <?php
                    $post_id = $_GET['id'];
                    $postQuery = "SELECT * from activityiternary WHERE id=$post_id";
                    $runPQ = mysqli_query($con, $postQuery);
                    $post = mysqli_fetch_assoc($runPQ);
                    ?>
                    <div class="inc-exc">
                        <div class="inc-exc-title">
                            <h3>About Tour</h3>
                        </div>
                        <div class="inclusion">
                            <?= nl2br($post['tourdesc']) ?>
                        </div>
                    </div>

                    <?php
                    $postQuery = "SELECT * from activity  WHERE tour_id=$post_id";
                    $runPQ = mysqli_query($con, $postQuery);
                    while ($post = mysqli_fetch_assoc($runPQ)) {
                    ?>
                        <div>
                            <div class="day-title">
                                <div class="day">
                                    <div class="day-num">Activity</div>
                                </div>
                                <div class="desc"><?= $post['activitytitle'] ?></div>
                            </div>

                            <div class="day-desc">
                                <p>
                                    <?= nl2br($post['description']) ?>
                                </p>
                            </div>
                        </div>



                    <?php

                    }

                    ?>

                </div>
            </div>
        </div>
    </section>



    <?php include_once('includes/footer.php'); ?>
</body>

</html>