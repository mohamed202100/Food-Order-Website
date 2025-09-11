<?php
include("partials-front/menu.php");

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $sql = "SELECT title FROM category WHERE id=$category_id;";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    $category_title = $row['title'];
} else {
    header("location:" . SITEURL);
}

?>
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title ?>"</a></h2>

    </div>
</section>

<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        $sql2 = "SELECT * FROM food WHERE category_id=$category_id;";
        $result2 = mysqli_query($connection, $sql2);
        $count = mysqli_num_rows($result2);
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($result2)) {
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
        ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if ($image_name == "") {
                            echo "<div class='error'>Food Not Available!</div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name ?>" class="img-responsive img-curve">
                        <?php
                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title ?></h4>
                        <p class="food-price"><?php echo $price ?></p>
                        <p class="food-detail">
                            <?php echo $description ?>
                        </p>
                        <br>

                        <a href="#" class="btn btn-primary">Order Now</a>
                    </div>
                </div>


        <?php
            }
        } else {
            echo "<div class='error'>Food Not Available!</div>";
        }
        ?>

        <div class="clearfix"></div>

    </div>

</section>
<?php
include("partials-front/footer.php");
?>