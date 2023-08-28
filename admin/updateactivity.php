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
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if (isset($_POST['update_tour'])) {
        $id = $_POST['id'];
        $tour_name = isset($_POST['tour_name']) ? mysqli_real_escape_string($con, $_POST['tour_name']) : '';
        $amount = isset($_POST['amount']) ? mysqli_real_escape_string($con, $_POST['amount']) : '';
        $category = isset($_POST['category']) ? mysqli_real_escape_string($con, $_POST['category']) : '';
        $description = isset($_POST['tour_desc']) ? mysqli_real_escape_string($con, $_POST['tour_desc']) : '';
        $highlights = isset($_POST['highlights']) ? mysqli_real_escape_string($con, $_POST['highlights']) : '';
        $activity_title =    isset($_POST['activity_title']) ? $_POST['activity_title'] : array();
        $activity_description = isset($_POST['activity_description']) ?  $_POST['activity_description'] : array();

        $image_updated = false;
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $image = $_FILES['image']['name'];
            $img_tmp = $_FILES['image']['tmp_name'];
            $folder = "../images/activity" . $image;

            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            if (in_array($extension, $allowed_files)) {
                $size = getimagesize($img_tmp);
                if ($size[0] < 2000 && $size[1] < 2000 && $_FILES['image']['size'] < 2097152) {
                    $size = getimagesize($img_tmp);
                    if ($size[0] < 2000 && $size[1] < 2000 && $_FILES['image']['size'] < 2097152) {
                        $image_updated = true;
                    } else {
                        echo "File size too big. Should be less than 2MB and dimensions less than 2000x2000.";
                    }
                } else {
                    echo "File should be png, jpg, or jpeg. The uploaded file has an extension of .$extension";
                }
            }

            if ($image_updated) {
                $updatequery = "UPDATE activityiternary SET activity_title='$tour_name', amount='$amount', tourdesc='$description', category='$category', highlights='$highlights', image='$image' WHERE id='$id'";
            } else {
                $updatequery = "UPDATE activityiternary SET activity_title='$tour_name', amount='$amount', tourdesc='$description', category='$category', highlights='$highlights' WHERE id='$id'";
            }

            $uquery = mysqli_query($con, $updatequery);
            if ($uquery) {
                if ($image_updated) {
                    move_uploaded_file($img_tmp, $folder);
                }

                if (count($activity_description) > 0) {
                    for ($i = 0; $i < count($activity_description); $i++) {
                        $title = $activity_title[$i];
                        $description = $activity_description[$i];

                        $check_sql = "SELECT * FROM activity WHERE tour_id='$id' AND activitytitle='$activity_title', description='$activity_description'";
                        $result = mysqli_query($con, $check_sql);

                        if (mysqli_num_rows($result) > 0) {
                            $sql = "UPDATE activity SET activitytitle='$title', description='$description' ,tour_id='$id' ";
                            mysqli_query($con, $sql);
                        } else {
                            $sql = "INSERT INTO activity (activitytitle, description, tour_id) VALUES ('$id', '$activity_title', '$activity_description";
                            mysqli_query($con, $sql);
                        }
                    }
                }

    ?>
                <script>
                    alert("Tour updated Successfully");
                    location.replace('managetours.php');
                </script>
        <?php
            } else {
                echo "Error updating tour: " . mysqli_error($con);
            }
        }
    } else {
        $id = $_GET['id'];
        $selectquery = "SELECT * FROM activityiternary WHERE id=$id";
        $squery = mysqli_query($con, $selectquery);
        $tour = mysqli_fetch_assoc($squery);
        $selectquery2 = "SELECT * FROM activity WHERE tour_id=$id";
        $squery2 = mysqli_query($con, $selectquery2);
        $itinerary = mysqli_fetch_all($squery2, MYSQLI_ASSOC);
        ?>

        <?php include 'includes/navbar.php'; ?>

        <div id="main" class="main p-5">
            <section class="form__section">
                <div class=" row">
                    <div class="col-lg-8 col-sm-12">
                        <div class="contact-details ">
                            <div class="title">
                                <h3>Update Activity</h3>
                            </div>
                            <div class="contact-form">
                                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $tour['id'] ?>">
                                    <div class="form-outline mb-4">
                                        <label for="tour_name">Activity Name</label>
                                        <input type="text" name="tour_name" value="<?php echo $tour['activity_title'] ?>" class="form-control" required></input>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label for="amount">Enter Amount</label>
                                        <input type="text" name="amount" value="<?php echo $tour['amount'] ?>" class="form-control" required></input>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label for="category">Enter Category</label>
                                        <input type="text" name="category" value="<?php echo $tour['category'] ?>" class="form-control" required></input>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label for="highlights">Enter Highlights</label>
                                        <input type="text" name="highlights" value="<?php echo $tour['highlights'] ?>" class="form-control" required></input>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label for="tour_desc">Enter Tour Description</label>
                                        <input type="text" name="tour_desc" value="<?php echo $tour['tourdesc'] ?>" class="form-control" rows="4" required></input>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label for="image">Add Image</label>
                                        <input type="file" name="image" class="form-control" accept="image">
                                    </div>

                                    <h3>Itinerary</h3>
                                    <?php foreach ($itinerary as $day) { ?>
                                        <div class="form-outline mb-4 mt-4" id="itinerary-container">
                                            <label for="activity_title">Activity Title</label>
                                            <input type="text" name="activity_title[]" value="<?php echo $day['activitytitle'] ?>" class="form-control" required></input>
                                            <label for="activity_description">Activity Description</label>
                                            <input rows="4" type="text" name="activity_description[]" value="<?php echo $day['description'] ?>" class="form-control" required></input>
                                            <button type="button" class="float-end remove-btn btn btn-danger m-3">Remove</button>
                                        </div>
                                    <?php } ?>

                                    <div class="paste-new-forms"></div>

                                    <button href="javascript:void(0)" type="button" class="add-day-btn float-end btn btn-primary btn-block mb-4">Add Day</button>
                                    <br>
                                    <br>

                                    <button type="submit" name="update_tour" class="btn btn-primary btn-block mb-4">
                                        Update Tour
                                    </button>
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