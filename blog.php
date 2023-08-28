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


    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $post_per_page = 6;
    $result = ($page - 1) * $post_per_page;

    ?>
    <?php include 'includes/whatsapp.php'; ?>

    <div class="title about-header" style="background-image: url(images/banner.jpg);">
        <h1 style="font-size:40px">Our Travel <span style="color:red">Diaries</span></h1>
    </div>
    <section class="bg">

        <section class="posts">
            <div class="row g-5">

                <?php
                $postQuery = "SELECT * from blog ORDER BY id DESC LIMIT $result, $post_per_page";
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
        <!--pagination-->
        <?php
        $q = "SELECT * from blog";
        $r = mysqli_query($con, $q);
        $total_posts = mysqli_num_rows($r);
        $total_pages = ceil($total_posts / $post_per_page);


        ?>
        <section class="blogp">
            <nav aria-label="Page navigation ">
                <ul class="pagination">
                    <?php
                    if ($page > 1) {
                        $switch = "";
                    } else {
                        $switch = "disabled";
                    }

                    if ($page < $total_pages) {
                        $nswitch = "";
                    } else {
                        $nswitch = "disabled";
                    }
                    ?>
                    <li class="page-item <?= $switch ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <?php
                    for ($opage = 1; $opage <= $total_pages; $opage++) {
                    ?>
                    <li class="page-item"><a class="page-link" href="?page=<?= $opage ?>"><?= $opage ?></a></li>

                    <?php
                    }
                    ?>

                    <li class="page-item <?= $nswitch ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </section>
    </section>

    <?php include_once('includes/footer.php'); ?>
</body>

</html>