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
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Users</h1>

        <?php if (isset($_SESSION['update_success'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['update_success'];
                unset($_SESSION['update_success']); ?>
            </div>
        <?php endif; ?>
        <div style="padding-left: 300px;">
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
                                    <button class="btn btn-danger delete-button" data-user-id="<?php echo $row['id']; ?>">Delete</button>
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
        <dialog id="dialog_delete" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation</h5>
                    </div>
                    <div class="modal-body">
                        <p>Do you want to delete this user?</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary m-2" id="button_yes">Yes</button>
                        <button class="btn btn-secondary m-2" id="button_no">No</button>
                    </div>
                </div>
            </div>
        </dialog>



        <div class="alert alert-success m-2" role="alert" style="display:none"></div>


        <?php if (isset($_SESSION['succ'])): unset($_SESSION['succ']); ?>
            <script>
                const notification = document.querySelector(".alert");
                notification.textContent = "Uživatel byl přidán.";
                notification.removeAttribute("style");
                setTimeout(() => {
                    notification.style.display = "none"
                }, 5000);

                var opacity = 1;
                var fadeOutInterval = setInterval(() => {
                    opacity = opacity - 0.01;
                    notification.style.opacity = opacity;
                    if (opacity <= 0) {
                        notification.style.display = "none";
                        clearInterval(fadeOutInterval);
                    }
                }, 30);
            </script>
        <?php endif; ?>

        <?php if (isset($_SESSION['succ2'])): unset($_SESSION['succ2']); ?>
            <script>
                const notification = document.querySelector(".alert");
                notification.textContent = "Uživatel byl upraven.";
                notification.removeAttribute("style");
                setTimeout(() => {
                    notification.style.display = "none"
                }, 5000);

                var opacity = 1;
                var fadeOutInterval = setInterval(() => {
                    opacity = opacity - 0.01;
                    notification.style.opacity = opacity;
                    if (opacity <= 0) {
                        notification.style.display = "none";
                        clearInterval(fadeOutInterval);
                    }
                }, 30);
            </script>
        <?php endif; ?>

        <?php if (isset($_SESSION['succ3'])): unset($_SESSION['succ3']); ?>
            <script>
                const notification = document.querySelector(".alert");
                notification.textContent = "Uživatel byl odebrán.";
                notification.removeAttribute("style");
                setTimeout(() => {
                    notification.style.display = "none"
                }, 5000);

                var opacity = 1;
                var fadeOutInterval = setInterval(() => {
                    opacity = opacity - 0.01;
                    notification.style.opacity = opacity;
                    if (opacity <= 0) {
                        notification.style.display = "none";
                        clearInterval(fadeOutInterval);
                    }
                }, 30);
            </script>
        <?php endif; ?>



        <script>
            const deleteButtons = document.querySelectorAll(".delete-button");
            const dialog = document.getElementById("dialog_delete");
            let userIdToDelete = null;

            deleteButtons.forEach(button => {
                button.addEventListener("click", (event) => {
                    event.preventDefault();
                    userIdToDelete = button.getAttribute("data-user-id");
                    dialog.showModal();
                });
            });

            document.getElementById("button_yes").addEventListener("click", () => {
                dialog.close();
                if (userIdToDelete) {
                    fetch('delete_user.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                id: userIdToDelete
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                const row = document.querySelector(`button[data-user-id='${userIdToDelete}']`).closest("tr");
                                row.remove();

                                showNotification('User deleted successfully.');
                            } else {
                                showNotification('Error: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showNotification('Request failed.');
                        });
                }
            });

            document.getElementById("button_no").addEventListener("click", () => {
                dialog.close();
                userIdToDelete = null;
            });

            function showNotification(message) {
                const notification = document.querySelector(".alert");
                notification.textContent = message;
                notification.style.display = "block";
                setTimeout(() => {
                    notification.style.display = "none";
                }, 5000);
            }
        </script>


    </div>
</body>

</html>