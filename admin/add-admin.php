<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1><br><br>

        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Full Name">
                    </td>
                </tr>
                <tr>
                    <td>UserName:</td>
                    <td>
                        <input type="text" name="user_name" placeholder="Enter Your UserName">
                    </td>
                </tr>
                <tr>
                    <td>password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Enter Your Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
include('partials/footer.php');
?>

<?php
if(isset($_POST['submit'])){
    $full_name = $_POST['full_name'];
    $user_name = $_POST['user_name'];
    $password = md5($_POST['password']); // Password Encryption
    $sql = "INSERT INTO admin SET
    full_name = '$full_name',
    username = '$user_name',
    password = '$password';";

    $result = mysqli_query($connection,$sql);
    if($result == TRUE){
        $_SESSION['add'] = "<div class='success'>Admin Added successfully.</div>";
        header("location:".$SITEURL.'manage-admin.php');
    }
    else{
        $_SESSION['add'] = "<div class='error'>Failed To Add Admin.</div>";
        header("location:".$SITEURL.'admin/add-admin.php');
    }
}
else{
    
}
?>