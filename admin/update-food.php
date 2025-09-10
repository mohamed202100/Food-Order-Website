<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql2 = "SELECT * FROM food WHERE id=$id;";
            $result2 = mysqli_query($connection, $sql2);

            if ($result2 == TRUE) {
                $count2 = mysqli_num_rows($result2);
                if ($count2 == 1) {
                    $rows2 = mysqli_fetch_assoc($result2);
                    $title = $rows2['title'];
                    $description = $rows2['description'];
                    $price = $rows2['price'];
                    $current_image = $rows2['image_name'];
                    $current_category = $rows2['category_id'];
                    $featured = $rows2['featured'];
                    $active = $rows2['active'];
                } else {
                    $_SESSION['no-food-found'] = "<div class='error'>Food Not Found!</div>";
                    header("location:" . SITEURL . "admin/manage-food.php");
                    exit;
                }
            }
        } else {
            header("location:" . SITEURL . "admin/manage-food.php");
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
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current image:</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                        ?>
                            <img src="../images/food/<?php echo $current_image ?>" width="80px" height="80px">
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
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            $sql = "SELECT * FROM category WHERE active='yes';";
                            $result = mysqli_query($connection, $sql);
                            $count = mysqli_num_rows($result);
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];
                            ?>
                                    <option <?php if ($current_category == $category_id) echo "selected" ?> value="<?php echo $category_id ?>"><?php echo $category_title ?></option>;

                            <?php
                                }
                            } else {
                                echo "<option value='0'>No Category Found!</option>";
                            }
                            ?>
                        </select>
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
                        <input type="submit" name="update" value="Update Food" class="btn-secondary">
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
    $description = $_POST['description'];
    $price = $_POST['price'];
    $current_image = $_POST['current_image'];
    $category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    if (isset($_FILES['image_name']['name']) && $_FILES['image_name']['name'] != "") {

        $image_name = $_FILES['image_name']['name'];
        $ext = end(explode('.', $image_name));
        $image_name = "Food_Name_" . rand(0000, 9999) . '.' . $ext;

        $source_path = $_FILES['image_name']['tmp_name'];
        $destination_path = "../images/food/" . $image_name;

        $upload = move_uploaded_file($source_path, $destination_path);

        if ($upload == false) {
            $_SESSION['upload'] = "<div class='error'>Failed To Upload New Image.</div>";
            header("location:" . SITEURL . "admin/manage-food.php");
            exit();
        }

        if ($current_image != "") {
            $remove_path = "../images/food/" . $current_image;
            if (file_exists($remove_path)) {
                unlink($remove_path);
            }
        }
    } else {
        $image_name = $current_image;
    }

    $sql3 = "UPDATE food SET 
        title='$title',
        price='$price',
        description='$description',
        image_name='$image_name',
        category_id = '$category',
        featured='$featured',
        active='$active'
        WHERE id=$id;";

    $result3 = mysqli_query($connection, $sql3);

    if ($result3 == TRUE) {
        $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
    } else {
        $_SESSION['update'] = "<div class='error'>Failed To Update Food.</div>";
    }
    header("location:" . SITEURL . "admin/manage-food.php");
    exit();
}
?>

<?php
include('partials/footer.php');
?>