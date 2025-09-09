<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "SELECT * FROM admin WHERE id=$id;";
            $result = mysqli_query($connection, $sql);

            if ($result == TRUE) {
                $count = mysqli_num_rows($result);
                if ($count == 1) {
                    $rows = mysqli_fetch_assoc($result);
                    $full_name = $rows['full_name'];
                    $username = $rows['username'];
                } else {
                    header("location:" . SITEURL . "admin/manage-admin.php");
                    exit;
                }
            }
        } else {
            header("location:" . SITEURL . "admin/manage-admin.php");
            exit;
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>UserName:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="update" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    $sql = "UPDATE admin SET 
        full_name='$full_name',
        username='$username'
        WHERE id=$id;";

    $result = mysqli_query($connection, $sql);

    if ($result == TRUE) {
        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
        header("location:" . SITEURL . "admin/manage-admin.php");
        exit;
    } else {
        $_SESSION['update'] = "<div class='error'>Failed TO Update Admin Try Again Later.</div>";
        header("location:" . SITEURL . "admin/manage-admin.php");
        exit;
    }
}
?>

<?php
include('partials/footer.php');
?>