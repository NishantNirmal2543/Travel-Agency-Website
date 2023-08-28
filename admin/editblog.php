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
    if (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $title = isset($_POST['title']) ? mysqli_real_escape_string($con, $_POST['title']) : '';
        $content = isset($_POST['content']) ? mysqli_real_escape_string($con, $_POST['content']) : '';
        
        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $image = $_FILES['image']['name'];
            $img_tmp = $_FILES['image']['tmp_name'];
            $folder = "../images/blogs" . $image;
    
            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            if (in_array($extension, $allowed_files)) {
                $size = getimagesize($img_tmp);
                if ($size[0] < 2000 && $size[1] < 2000 && $_FILES['image']['size'] < 2097152) {
                    $updatequery = "UPDATE blog SET title='$title', content='$content', image='$image' WHERE id='$id'";
                    $uquery = mysqli_query($con, $updatequery);
                    if ($uquery) {
                        move_uploaded_file($img_tmp, $folder);
                        header("Location: managepost.php");
                        exit();
                    } else {
                        echo "Error updating post: " . mysqli_error($con);
                    }
                } else {
                    echo "File size too big. Should be less than 2MB and dimensions less than 2000x2000.";
                }
            } else {
                echo "File should be png, jpg, or jpeg. The uploaded file has an extension of .$extension";
            }
        } else {
            $updatequery = "UPDATE blog SET title='$title', content='$content' WHERE id='$id'";
            $uquery = mysqli_query($con, $updatequery);
            if ($uquery) {
                header("Location: managepost.php");
                exit();
            } else {
                echo "Error updating post: " . mysqli_error($con);
            }
        }
    
    
    } else {
        $id = $_GET['id'];
        $selectquery = "SELECT * FROM blog WHERE id=$id";
        $squery = mysqli_query($con, $selectquery);
        $post = mysqli_fetch_assoc($squery);



    ?>
    <?php include 'includes/navbar.php'; ?>

        <div id="main" class="main p-5">
            <section class="form__section">
                <div class="row">
                    <div class="col-lg-8 col-sm-12">
                        <div class="contact-details ">
                            <div class="title">
                                <h3>Edit Post</h3>
                            </div>
                            <div class="contact-form">
                                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $post['id'] ?>">
                                    <div class="form-outline mb-4">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control" value="<?php echo $post['title'] ?>" required>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label for="content">Content</label>
                                        <textarea rows="10" name="content" class="form-control" required><?php echo $post['content'] ?></textarea>
                                        <script>
                                            CKEDITOR.replace('content');
                                        </script>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label for="image">Image:</label>
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                    </div>
                                    <div class="form-outline mb-4">
                                        <button type="submit" name="edit" class="btn btn-primary btn-lg">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    <?php
    }
    ?>
    </main>
    <?php include 'includes/links.php'; ?>

</body>

</html>