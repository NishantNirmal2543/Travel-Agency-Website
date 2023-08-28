<?php

session_start();

if (!isset($_SESSION['email'])) {
    header('location:login.php');
}
?>
<?php include 'includes/header.php'; ?>

<body>
    <?php include('../includes/message.php'); ?>

    <?php
    include '../dbcon.php';
    ?>
    <?php include 'includes/navbar.php'; ?>
    <div id="main" class="main p-5">

        <div class="form-container" id="table1">
            <table class="table table-striped table-advance table-hover">
                <thead>
                    <tr>
                        <th>Ouestion</th>
                        <th>Answer</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <?php
                $postQuery = "SELECT * from faqs ORDER BY id DESC";
                $runPQ = mysqli_query($con, $postQuery);
                while ($post = mysqli_fetch_assoc($runPQ)) {
                ?>
                    <tbody>
                        <tr>
                            <td><?= $post['question'] ?> </td>
                            <td><?= $post['answer'] ?> </td>

                            <td>
                                <form action="deletetour.php" method="POST">
                                    <button type="submit" name="delete6" value="<?= $post['id']; ?>" class="btn btn-danger">DELETE</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                <?php
                }
                ?>

            </table>
        </div>
    </div>


</body>