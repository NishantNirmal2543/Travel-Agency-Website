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

    <?php include_once('includes/navbar.php'); ?>
    <?php include 'includes/whatsapp.php'; ?>

    <section class="faq-header" style="background-image: url(images/bg/faq.jpg);">
        <div class="auto-container">
            <div class="faq">
                <h1>FAQs</h1>
            </div>
        </div>
    </section>


    <section class="faq-questions">
        <div class="questions">

            <?php
            include('dbcon.php');
            $sql = "SELECT * FROM faqs";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<h3 style="margin-top: 40px;">Q.' . $row["question"] . '</h3>';
                    echo '<p>Ans.' . $row["answer"] . '</p>';
                }
            } else {
                echo "No FAQs found.";
            }
            ?>

        </div>
    </section>


    <?php include_once('includes/footer.php'); ?>


</body>

</html>