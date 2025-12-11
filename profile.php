<?php
session_start();
include('connectiondb.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM users WHERE username = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f2f2f2;
        }
        .profile-container {
            max-width: 900px;
            margin: 50px auto;
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .profile-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #007bff;
        }
        .btn-primary, .btn-danger {
            width: 150px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="profile-container">
        <h2 class="text-center mb-4">Student Profile</h2>

        <div class="row">
            <div class="col-md-4 text-center">
                <img src="<?= htmlspecialchars($user['photo']) ?>" alt="Profile Photo" class="profile-photo">
                <h4 class="mt-3"><?= htmlspecialchars($user['firstname']) . " " . htmlspecialchars($user['lastname']) ?></h4>
                <p class="text-muted"><?= htmlspecialchars($user['username']) ?></p>
            </div>

            <div class="col-md-8">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Username</th>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                        </tr>
                        <tr>
                            <th>First Name</th>
                            <td><?= htmlspecialchars($user['firstname']) ?></td>
                        </tr>
                        <tr>
                            <th>Middle Name</th>
                            <td><?= htmlspecialchars($user['middlename']) ?></td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td><?= htmlspecialchars($user['lastname']) ?></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td><?= htmlspecialchars($user['gender']) ?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td><?= htmlspecialchars($user['address1']) . ", " . htmlspecialchars($user['address2']) ?></td>
                        </tr>
                        <tr>
                            <th>State</th>
                            <td><?= htmlspecialchars($user['state']) ?></td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td><?= htmlspecialchars($user['city']) ?></td>
                        </tr>
                        <tr>
                            <th>Aadhaar PDF</th>
                            <td>
                                <a href="<?= htmlspecialchars($user['aadhaar']) ?>" target="_blank" class="btn btn-success btn-sm">Download PDF</a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="text-center mt-4">
                    <a href="edit.php" class="btn btn-primary">Edit Profile</a>
                    <a href="login.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm
