<?php
include 'db.php';


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['username'])) {
    header("Location: login");
    exit();
}


$sql = "SELECT * FROM users";
$result = $conn->query($sql);


$is_admin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
?>

<!doctype html>
<html lang="en">

<head>
    <title>Users</title>
    <link rel="stylesheet" href="./bootstrap.css">
    <link rel="stylesheet" href="./bootstrap-icons.css">
    <script>
        function confirmDelete(userId) {
            if (confirm("Are you sure you want to delete this user?")) {
                window.location.href = 'delete_user.php?id=' + userId;
            }
        }
    </script>
</head>

<body>
    <div class="container" style="padding-left: 10em;">
        <h1 class="text-center">Users</h1>

        <?php if (isset($_SESSION['update_success'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['update_success'];
                unset($_SESSION['update_success']); ?>
            </div>
        <?php endif; ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Office</th>
                    <th>Admin</th>
                    <?php if ($is_admin): ?>
                        <th>Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['office']); ?></td>
                        <td><?php echo $row['is_admin'] ? 'Yes' : 'No'; ?></td>
                        <?php if ($is_admin): ?>
                            <td>
                                <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                                <button onclick="confirmDelete(<?php echo $row['id']; ?>)" class="btn btn-danger">Delete</button>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endwhile; ?>

                <?php if ($is_admin): ?>
                    <form action="add_user.php" method="post">
                        <tr>
                            <td>
                                <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                                <input type="text" name="last_name" class="form-control mt-2" placeholder="Last Name" required>
                            </td>
                            <td><input type="email" name="email" class="form-control" placeholder="Email" required>
                                <input type="password" name="password" class="form-control mt-2" placeholder="Password">
                            </td>
                            <td><input type="text" name="phone" class="form-control" placeholder="Phone"></td>
                            <td><input type="text" name="office" class="form-control" placeholder="Office"></td>
                            <td><input type="checkbox" name="is_admin"></td>
                            <td>
                                <button type="submit" class="btn btn-primary">Add User</button>
                            </td>
                        </tr>
                    </form>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>