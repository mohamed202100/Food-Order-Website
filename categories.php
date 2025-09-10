<?php
include("partials-front/menu.php");
?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        $sql = "SELECT * FROM category WHERE active='yes';";
        $result = mysqli_query($connection, $sql);

        $count = mysqli_num_rows($result);
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>
                <a href="category-foods.html">
                    <div class="box-3 float-container">
                        <?php
                        if ($image_name == "") {
                            echo "<div class='error'>Image Not Found!</div>";
                        } else {
                        ?>
                            <img src="<?php SITEURL ?>images/category/<?php echo $image_name ?>" class="img-responsive img-curve">
                        <?php
                        }
                        ?>
                        <h3 class="float-text text-white"><?php echo $title ?></h3>
                    </div>
                </a>
        <?php
            }
        } else {
            echo "<div class='error'>Not Category Found!</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->


<?php
include("partials-front/footer.php");
?>