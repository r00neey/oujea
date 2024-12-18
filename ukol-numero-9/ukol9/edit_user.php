<?php
include 'db.php'; // Připojení k databázi
require_once 'controllers/HeaderController.php';
$controller = new HeaderController();
$controller->index();

// Inicializace session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Pokud uživatel není přihlášený, přesměruj ho na login
if (!isset($_SESSION['username'])) {
    header("Location: login");
    exit();
}

// Získání ID uživatele pro editaci z URL
$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Získání údajů o uživateli
if ($user_id > 0) {
    $sql = "SELECT * FROM users WHERE id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found!";
        exit();
    }
} else {
    echo "Invalid user ID!";
    exit();
}

// Pokud je formulář odeslán, aktualizujeme údaje
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $office = $conn->real_escape_string($_POST['office']);
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    // Pokud bylo zadáno heslo, změníme ho
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', office='$office', is_admin='$is_admin', password='$password' WHERE id=$user_id";
    } else {
        // Pokud nebylo heslo zadáno
        $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone', office='$office', is_admin='$is_admin' WHERE id=$user_id";
    }

    if ($conn->query($sql) === TRUE) {
        $_SESSION['update_success'] = "User updated successfully!";
        header("Location: index.php?page=users"); // Přesměrujeme zpět na stránku users
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="./bootstrap.css">
    <link rel="stylesheet" href="./bootstrap-icons.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Edit User</h1>

    <form action="edit_user.php?id=<?php echo $user_id; ?>" method="post">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Office</th>
                    <th>Admin</th>
                    <th>Actions</th>
                </tr>
            </thead>

        <?php $sql = "SELECT * FROM users WHERE id NOT LIKE $user_id";
            $result = $conn->query($sql);?>
<tbody>
<?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                <td><?php echo htmlspecialchars($row['office']); ?></td>
                <td><?php echo $row['is_admin'] ? 'Yes' : 'No'; ?></td>
            </tr>
        <?php endwhile; ?>

            
                <tr>
                    <td>
                        <input type="text" name="first_name" class="form-control" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
                        <input type="text" name="last_name" class="form-control mt-2" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
                    </td>
                    <td>
                        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                        <input type="password" name="password" class="form-control mt-2" placeholder="New password">
                    </td>
                    <td>
                        <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($user['phone']); ?>">
                    </td>
                    <td>
                        <input type="text" name="office" class="form-control" value="<?php echo htmlspecialchars($user['office']); ?>">
                    </td>
                    <td>
                        <input type="checkbox" name="is_admin" <?php echo $user['is_admin'] ? 'checked' : ''; ?>>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-success">Done</button>
                        <a href="users" class="btn btn-danger">Cancel</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
</body>
</html>
