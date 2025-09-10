<?php
include('<partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1><br><br>

        <?php

        session_echo_unset('add');

        session_echo_unset('upload');
        ?><br><br>

        <a href="add-food.php" class="btn-primary">Add Food</a><br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            <?php
            $sn = 1;
            $sql = "SELECT * FROM food;";
            $result = mysqli_query($connection, $sql);
            $count = mysqli_num_rows($result);
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

            ?>
                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $title ?></td>
                        <td><?php echo $description ?></td>
                        <td><?php echo $price ?></td>
                        <td>
                            <?php
                            if ($image_name != "") {
                            ?>
                                <img src="../images/food/<?php echo $image_name ?>" width="80px" height="80px">
                            <?php
                            } else {
                                echo "<div class='error'>Image Not Added!</div>";
                            } ?>
                        </td>
                        <td><?php echo $featured ?></td>
                        <td><?php echo $active ?></td>
                        <td><a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Update Category</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="6">
                        <div class="error">No Food Added!</div>
                    </td>
                </tr>
            <?php
            }
            ?>

        </table>

    </div>
</div>
<?php
include('partials/footer.php');
?>