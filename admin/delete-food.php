<?php
include("../admin/partials/config.php");
if (isset($_GET['id']) && isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if ($image_name != "") {
        $path = "../images/food/" . $image_name;
        $remove = unlink($path);

        if ($remove == FALSE) {
            $_SESSION['remove'] = "<div class='error'> Failed To Remove Image</div>";
            header("location:" . SITEURL . "admin/manage-food.php");
            die();
        }
    }

    $sql = "DELETE FROM food WHERE id=$id;";
    $result = mysqli_query($connection, $sql);

    if ($result == TRUE) {
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
        header("location:" . SITEURL . "admin/manage-food.php");
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed TO Delete Food Try Again Later.<div>";
        header("location:" . SITEURL . "admin/manage-food.php");
    }
} else {
}
