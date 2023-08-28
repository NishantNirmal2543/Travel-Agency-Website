<?php

include('../dbcon.php');

if(isset($_POST['delete'])){

    $id = $_POST['delete'];
      
    $delete_query = "DELETE FROM booking WHERE id=$id";
    $run = mysqli_query($con, $delete_query);
    if($run){

        ?>
        <script>
            alert('Entry deleted successfully');
            location.replace('bookings.php');

        </script>
        <?php
    }else{
        ?>
        <script>
            alert('Something went wrong');
            location.replace('bookings.php');

        </script>
        <?php
       
    }
    
}



?>