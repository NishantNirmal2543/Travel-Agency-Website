<?php

session_start();

if (!isset($_SESSION['email'])) {
    header('location:login.php');
}
?>

<?php include 'includes/header.php'; ?>

<body>


    <?php
    include('../dbcon.php');

    if (isset($_POST['submit'])) {


        $title = mysqli_real_escape_string($con, $_POST['title']);
        $content = mysqli_real_escape_string($con, $_POST['content']);
        $image = $_FILES['image']['name'];
        $img_tmp = $_FILES['image']['tmp_name'];
        $folder  = "../images/blogs/" . $image;

        $allowed_files = ['png', 'jpg', 'jpeg'];
        $extension = explode('.', $image);
        $extension = end($extension);
        $size = getimagesize($image);
        if (in_array($extension, $allowed_files)) {
            if ($size < 2) {
                $insertquery = "INSERT INTO blog (title, content, image)
                            VALUES('$title', '$content', '$image')";

                $iquery = mysqli_query($con, $insertquery);
                move_uploaded_file($img_tmp, $folder);
    ?>
                <script>
                    alert("Post Added Successfully");
                    location.replace('index.php');
                </script>
            <?php


            } else {
            ?>
                <script>
                    alert("File size too big. Should be less than 2MB");
                </script>
            <?php
            }
        } else {
            ?>
            <script>
                alert("File should be png, jpg or jpeg");
            </script>
    <?php
        }
    }


    ?>

    <?php include 'includes/navbar.php'; ?>



    <div id="main" class="main p-5">


        <section class="form__section">


            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="contact-details ">
                        <div class="title">
                            <h3>Add Post</h3>
                        </div>
                        <div class="contact-form">
                            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-outline mb-4">
                                    <label for="title">Title</label>
                                    <input type="title" name="title" class="form-control" required></input>
                                </div>

                                <div class="form-outline mb-4">
                                    <label for="content">Content</label>
                                    <textarea rows="10" name="content" class="form-control" required></textarea>
                                    <script>
                                        CKEDITOR.replace('content');
                                    </script>
                                </div>


                                <!-- Image input -->
                                <div class="form-outline mb-4">
                                    <label for="image">Image:</label>
                                    <input type="file" name="image" class="form-control" accept="image" required>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">
                                    Add Post
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

        </section>


    </div>

    <?php include 'includes/links.php'; ?>

</body>

</html>