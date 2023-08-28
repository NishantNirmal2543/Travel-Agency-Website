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
        $hotel_place = isset($_POST['place']) ? mysqli_real_escape_string($con, $_POST['place']) : '';
        $price = isset($_POST['price']) ? mysqli_real_escape_string($con, $_POST['price']) : '';
        $highlights = isset($_POST['highlights']) ? mysqli_real_escape_string($con, $_POST['highlights']) : '';
        $hotel_name = isset($_POST['name']) ? $_POST['name'] : array();
        $hotel_desc = isset($_POST['description']) ? $_POST['description'] : array();

        $image_updated = false;
        if (isset($_FILES['image']) && $_FILES['image']['error'] != 4 && !empty($_FILES['image']['name'])) {
            $image = $_FILES['image']['name'];
            $img_tmp = $_FILES['image']['tmp_name'];
            $folder = "../images/hotel" . $image;

            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            if (in_array($extension, $allowed_files)) {
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
            $updatequery = "UPDATE vehicle_details SET vehicle_name='$vehicle_name', vehicle_category='$vehicle_category', price='$price', image='$image' WHERE id='$id'";
        } else {
            $updatequery = "UPDATE vehicle_details SET vehicle_name='$vehicle_name', vehicle_category='$vehicle_category', price='$price' WHERE id='$id'";
        }

        $uquery = mysqli_query($con, $updatequery);
        if ($uquery) {
            if ($image_updated) {
                move_uploaded_file($img_tmp, $folder);
            }
            if (count($features) > 0) {


                for ($i = 0; $i < count($features); $i++) {
                    $feature = $features[$i];

                    // Check if day already exists in database
                    $check_sql = "SELECT * FROM vehicle_features WHERE vehicle_id='$id' AND feature='$features'";
                    $result = mysqli_query($con, $check_sql);

                    if (mysqli_num_rows($result) > 0) {
                        // Day already exists, update the day
                        $sql = "UPDATE vehicle_features SET feature='$feature',vehicle_id='$id'";
                        mysqli_query($con, $sql);
                    } else {
                        // Day doesn't exist, insert new day
                        $sql = "INSERT INTO vehicle_features (vehicle_id, feature) VALUES ('$id', '$features')";
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
    } else {
        $id = $_GET['id'];
        $selectquery = "SELECT * FROM hotel WHERE id=$id";
        $squery = mysqli_query($con, $selectquery);
        $tour = mysqli_fetch_assoc($squery);
        $selectquery2 = "SELECT * FROM hotel_details WHERE hotel_id=$id";
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
                                <h3>Update Hotel Details</h3>
                            </div>
                            <div class="contact-form">
                                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $tour['id'] ?>">
                                    <div class="form-outline mb-4">
                                        <label for="place">Name of Place</label>
                                        <input type="text" name="place" value="<?php echo $tour['hotel_place'] ?>" class="form-control" required></input>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label for="price">Enter Price</label>
                                        <input type="text" name="price" value="<?php echo $tour['price'] ?>" class="form-control" required></input>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label for="highlights">Enter Highlights</label>
                                        <input type="text" name="highlights" value="<?php echo $tour['highlights'] ?>" class="form-control" required></input>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label for="main_image">Add Image</label>
                                        <input type="file" name="main_image" class="form-control" accept="image">
                                    </div>

                                    <h3>Itinerary</h3>
                                    <?php foreach ($itinerary as $day) { ?>
                                        <div class="form-outline mb-4 mt-4 " id="itinerary-container">
                                            <label class="pt-3" for="name">Enter Hotel Name: </label>
                                            <input type="text" name="name[]" value="<?php echo $day['name'] ?>" class="form-control" required></input>
                                            <label class="pt-3" for="image">Add Image</label>
                                            <input type="file" name="hotel_image[]" value="<?php echo $tour['image'] ?>" class="form-control" required></input>
                                            <label class="pt-3" for="description">Add Description</label>
                                            <input type="text" name="description[]" value="<?php echo $tour['description'] ?>" class="form-control" required></input>
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