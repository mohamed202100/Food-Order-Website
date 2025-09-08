<?php
include('partials/menu.php');
?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Admin</h1><br><br>

            <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            ?>
            <br><br><br>

            <a href="add-admin.php" class="btn-primary">Add Admin</a><br><br>

            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Full Name</th>
                    <th>User Name</th>
                    <th>Action</th>
                </tr>

                <?php
                $sql = "SELECT * FROM admin";
                $result = mysqli_query($connection,$sql);
                if($result == TRUE){
                    $count = mysqli_num_rows($result);
                    $sn = 1;
                    if($count>0){
                        while($rows = mysqli_fetch_assoc($result)){
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];

                            ?>
                            <tr>
                                <td><?php echo $sn++ ?></td>
                                <td><?php echo $full_name ?></td>
                                <td><?php echo $username ?></td>
                                <td><a href="" class="btn-secondary">Update Admin</a>
                                    <a href="" class="btn-danger">Delete Admin</a>
                                </td>
                            </tr>

                            <?php

                        }
                    }
                    else{

                    }
                }
                ?>

            </table>
        </div>
    </div>

<?php
include('partials/footer.php');
?>