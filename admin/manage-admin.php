<?php
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1><br><br>

        <?php

        function session_echo_unset($session_name)
        {
            if ($session_name != NULL) {
                if (isset($_SESSION[$session_name])) {
                    echo $_SESSION[$session_name];
                    unset($_SESSION[$session_name]);
                }
            }
        }

        session_echo_unset('add');

        session_echo_unset('delete');

        session_echo_unset('update');

        session_echo_unset('user-not-found');

        session_echo_unset('psd-not-match');

        session_echo_unset('change-psd');

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
            $result = mysqli_query($connection, $sql);
            if ($result == TRUE) {
                $count = mysqli_num_rows($result);
                $sn = 1;
                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($result)) {
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

            ?>
                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td><?php echo $full_name ?></td>
                            <td><?php echo $username ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                            </td>
                        </tr>

            <?php

                    }
                } else {
                }
            }
            ?>

        </table>
    </div>
</div>

<?php
include('partials/footer.php');
?>