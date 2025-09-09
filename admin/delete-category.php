<?php
include("../admin/partials/config.php");
if (isset($_GET['id']) and isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if ($image_name != "") {
        $path = "../images/category/" . $image_name;
        $remove = unlink($path);

        if ($remove == FALSE) {
            $_SESSION['remove'] = "<div class='error'> Failed To Remove Image</div>";
            header("location:" . SITEURL . "admin/manage-category.php");
            die();
        }
    }

    $sql = "DELETE FROM category WHERE id=$id;";
    $result = mysqli_query($connection, $sql);

    if ($result == TRUE) {
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
        header("location:" . SITEURL . "admin/manage-category.php");
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed TO Delete Category Try Again Later.<div>";
        header("location:" . SITEURL . "admin/manage-category.php");
    }
} else {
}
