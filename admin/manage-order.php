<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        
        <br />
        <br />
        <br />
        <table class="tbl-full">
            <tr>
                <th>Admin ID</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Action</th>
            </tr>

            <tr>
                <td>1</td>
                <td>Admin</td>
                <td>admin</td>
                <td>
                    <a href="edit-admin.php" class="btn-secondary">Edit</a>
                    <a href="delete-admin.php" class="btn-danger">Delete</a>
                </td>
            </tr>

            <tr>
                <td>2</td>
                <td>Admin</td>
                <td>admin</td>
                <td>
                    <a href="edit-admin.php" class="btn-secondary">Edit</a>
                    <a href="delete-admin.php" class="btn-danger">Delete</a>
                </td>
            </tr>

            <tr>
                <td>3</td>
                <td>Admin</td>
                <td>admin</td>
                <td>
                    <a href="edit-admin.php" class="btn-secondary">Edit</a>
                    <a href="delete-admin.php" class="btn-danger">Delete</a>
                </td>
            </tr>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>