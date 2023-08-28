<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sacred tours and travels</title>

    <?php include_once('includes/links.php'); ?>
    <link rel="stylesheet" href="css/blog.css">

</head>

<body>
    <?php include_once('includes/navbar.php');
    include 'dbcon.php';
    ?>
    <?php include 'includes/whatsapp.php'; ?>

    <div class="title about-header" style="background-image: url(images/bg/banner.jpg);">
        <h1>Our Travel <span style="color:red">Diaries</span></h1>
    </div>

    <section class="featured">
        <?php

        $post_id = $_GET['id'];
        $postQuery = "SELECT * from blog WHERE id=$post_id";
        $runPQ = mysqli_query($con, $postQuery);
        $post = mysqli_fetch_assoc($runPQ);

        ?>
        <div class="row featured_container">
            <h2 class="blog-title"><?= $post['title'] ?></h2>
            <div class="blog-upload-info">
                <p class="card-text"><small class="text-muted">Posted on
                        <?= date('F jS, Y', strtotime($post['created_at'])) ?></small></p>
            </div>

            <div class="blog_thumbnail col-lg-12 col-sm-12">
                <img src="images/blogs/<?= $post['image'] ?>">
            </div>
            <div class="blog_info col-lg-12 col-sm-12">
                <div class="blog_body">
                    <?= $post['content'] ?>
                </div>

            </div>
        </div>
    </section>

    <section class="moreblogs">
        <div class="title">
            <h4>Read Our<span>Latest Blogs </span></h4>
        </div>
        <div class="row g-5">

            <?php
            $post_id = $_GET['id'];
            $postQuery = "SELECT * from blog  WHERE id!=$post_id ORDER BY id DESC LIMIT 3";
            $runPQ = mysqli_query($con, $postQuery);
            while ($post = mysqli_fetch_assoc($runPQ)) {
            ?>
            <div class="blogcards col-lg-4 col-md-6 col-sm-12">

                <div class="card">
                    <div class="card-image">
                        <a href="single_blog.php?id=<?= $post['id'] ?>" style="text-decoration:none; color:black">
                            <img src="images/blogs/<?= $post['image'] ?>">
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"> <?= $post['title'] ?> </h5>
                        <p class="card-text text-truncate"><?= substr($post['content'], 0, 50) . '...' ?></p>
                        <p class="card-text time"><small class="text-muted">Posted on
                                <?= date('F jS, Y', strtotime($post['created_at'])) ?></small></p>
                    </div>
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
</body>

</html>