<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM category WHERE id=$id;";
            $result = mysqli_query($connection, $sql);

            if ($result == TRUE) {
                $count = mysqli_num_rows($result);
                if ($count == 1) {
                    $rows = mysqli_fetch_assoc($result);
                    $title = $rows['title'];
                    $current_image = $rows['image_name'];
                    $featured = $rows['featured'];
                    $active = $rows['active'];
                } else {
                    $_SESSION['no-category-found'] = "<div class='error'>Category Not Found!</div>";
                    header("location:" . SITEURL . "admin/manage-category.php");
                    exit;
                }
            }
        } else {
            header("location:" . SITEURL . "admin/manage-category.php");
            exit;
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current image:</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                        ?>
                            <img src="../images/category/<?php echo $current_image ?>" width="80px" height="80px">
                        <?php
                        } else {
                            echo "<div class='error'>Image Not Added!</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image_name">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($featured == "yes") echo "checked"; ?> type="radio" name="featured" value="yes">yes
                        <input <?php if ($featured == "no") echo "checked"; ?> type="radio" name="featured" value="no">no

                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($active == "yes") echo "checked"; ?> type="radio" name="active" value="yes">yes
                        <input <?php if ($active == "no") echo "checked"; ?> type="radio" name="active" value="no">no

                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="update" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $current_image = $_POST['current_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    if (isset($_FILES['image_name']['name']) && $_FILES['image_name']['name'] != "") {

        $image_name = $_FILES['image_name']['name'];
        $ext = end(explode('.', $image_name));
        $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;

        $source_path = $_FILES['image_name']['tmp_name'];
        $destination_path = "../images/category/" . $image_name;

        $upload = move_uploaded_file($source_path, $destination_path);

        if ($upload == false) {
            $_SESSION['upload'] = "<div class='error'>Failed To Upload New Image.</div>";
            header("location:" . SITEURL . "admin/manage-category.php");
            exit();
        }

        if ($current_image != "") {
            $remove_path = "../images/category/" . $current_image;
            if (file_exists($remove_path)) {
                unlink($remove_path);
            }
        }
    } else {
        $image_name = $current_image;
    }

    $sql2 = "UPDATE category SET 
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'
        WHERE id=$id;";

    $result2 = mysqli_query($connection, $sql2);

    if ($result2 == TRUE) {
        $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
    } else {
        $_SESSION['update'] = "<div class='error'>Failed To Update Category.</div>";
    }
    header("location:" . SITEURL . "admin/manage-category.php");
    exit();
}
?>

<?php
include('partials/footer.php');
?>