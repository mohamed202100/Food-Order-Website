<?php
    include("../admin/partials/config.php");

    $id = $_GET['id'];
    $sql = "DELETE FROM admin WHERE ID=$id;";
    $result = mysqli_query($connection,$sql);

    if($result == TRUE){
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
        header("location:".SITEURL."admin/manage-admin.php");
    }
    else{
        $_SESSION['delete'] = "<div class='error'>Failed TO Delete Admin Try Again Later.<div>";
        header("location:".SITEURL."admin/manage-admin.php");
    }

?>