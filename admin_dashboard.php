<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: adminlogin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Welcome, Admin!</h2>
    
    <div class="mt-4">
        <a href="add_admin.php" class="btn btn-success">Add New Admin</a>
        <a href="view1.php" class="btn btn-primary">List of Students</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    <hr>

    <h3>Admin Records</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'connectiondb.php';
            $result = $conn->query("SELECT id, username FROM admin");

            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['id']}</td><td>{$row['username']}</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
