<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('location:login.php');
}

?>
<?php include 'includes/header.php'; ?>

<body>
    <?php include 'includes/navbar.php'; ?>

    <?php


    include('../dbcon.php');

    if (isset($_POST['submit'])) {

        $question = mysqli_real_escape_string($con, $_POST["question"]);
        $answer = mysqli_real_escape_string($con, $_POST["answer"]);

        // Insert the values into the MySQL database
        $sql = "INSERT INTO faqs (question, answer) VALUES ('$question', '$answer')";

        if ($con->query($sql) === TRUE) {
    ?>
    <script>
    alert("FAQ added successfully");
    location.replace('addfaq.php');
    </script>
    <?php
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }
    ?>

    <div id="main" class="main p-5" style="align-content: center;">
        <div class="title" style="text-align: center;">
            <h2>
                Add FAQs
            </h2>
        </div>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST">
            <div class="form-group">
                <label for="question">Question:</label>
                <input type="text" class="form-control" id="question" name="question">
            </div>
            <div class="form-group">
                <label for="answer">Answer:</label>
                <textarea class="form-control" id="answer" name="answer"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-5" name="submit">Add FAQ</button>
        </form>
    </div>

    <?php include 'includes/links.php'; ?>

</body>