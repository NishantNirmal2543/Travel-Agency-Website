<?php

include('../dbcon.php');

if(isset($_POST['delete'])){

    $id = $_POST['delete'];
    
    $query = "SELECT * FROM blog WHERE id=$id";
    $result = mysqli_query($con, $query);
    
    if(mysqli_num_rows($result)==1){
        $post = mysqli_fetch_assoc($result);
        $image = $post['image'];
        $folder = '../images/blogs' . $image;

        if($folder){
            unlink($folder);
            $delete_query = "DELETE FROM blog WHERE id=$id";
            $run = mysqli_query($con, $delete_query);
            if($run){
        
                ?>
                <script>
                    alert('Post deleted successfully');
                    location.replace('managepost.php');
        
                </script>
                <?php
            }else{
                ?>
                <script>
                    alert('Something went wrong');
                    location.replace('managepost.php');
        
                </script>
                <?php
               
            }
        }
    }

    

    
}



?>