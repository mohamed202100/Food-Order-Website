<?php
include("partials/menu.php");
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1><br><br>

        <?php
        session_echo_unset('add');
        session_echo_unset('upload');
        ?>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Food Title">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description Of The Food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
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
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>
                                    <option value="<?php echo $id ?>"><?php echo $title ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">No Category Found!</option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="yes">yes
                        <input type="radio" name="featured" value="no">no
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="yes">yes
                        <input type="radio" name="active" value="no">no
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Add Food" name="submit" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "no";
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "no";
            }
            if (isset($_FILES['image']['name'])) {

                $image_name = $_FILES['image']['name'];
                if ($image_name != "") {
                    $exe = end(explode('.', $image_name));
                    $image_name = "Food_Name_" . rand(000, 999) . '.' . $exe;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/food/" . $image_name;
                    $upload = move_uploaded_file($source_path, $destination_path);

                    if ($upload == FALSE) {
                        $_SESSION['upload'] = "<div class='error'>Failed To Upload Image.</div>";
                        header("location:" . SITEURL . "admin/add-food.php");
                        die();
                    }
                }
            } else {
                $image_name = "";
            }

            $sql2 = "INSERT INTO food SET 
            title='$title',
            description='$description',
            price=$price,
            category_id='$category',
            image_name='$image_name',
            featured='$featured',
            active='$active';";

            $result2 = mysqli_query($connection, $sql2);

            if ($result2 == TRUE) {
                $_SESSION['add'] = "<div class='success'>Food Added successfully.</div>";
                header("location:" . $SITEURL . 'manage-food.php');
            } else {
                $_SESSION['add'] = "<div class='success'>Failed To Add Category</div>";
                header("location:" . $SITEURL . 'add-food.php');
            }
        } else {
        }
        ?>

    </div>
</div>



<?php
include("partials/footer.php");
