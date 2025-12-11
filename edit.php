<?php
session_start();
include('connectiondb.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Fetch the current user data
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

// Handle form submission for updates
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $state = $_POST['state'];
    $city = $_POST['city'];

    // Upload folder
    $target_dir = "uploads/";

    // Aadhaar PDF Upload
    $aadhaar_file = $user['aadhaar'];
    if (!empty($_FILES['aadhaar']['name'])) {
        $aadhaar_file = $target_dir . basename($_FILES["aadhaar"]["name"]);
        move_uploaded_file($_FILES["aadhaar"]["tmp_name"], $aadhaar_file);
    }

    // Profile Photo Upload
    $photo_file = $user['photo'];
    if (!empty($_FILES['photo']['name'])) {
        $photo_file = $target_dir . basename($_FILES["photo"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $photo_file);
    }

    // Update the database
    $update_sql = "UPDATE users SET firstname=?, middlename=?, lastname=?, gender=?, address1=?, address2=?, state=?, city=?, aadhaar=?, photo=? WHERE username=?";
    
    $stmt = mysqli_prepare($conn, $update_sql);
    mysqli_stmt_bind_param($stmt, "sssssssssss", $firstname, $middlename, $lastname, $gender, $address1, $address2, $state, $city, $aadhaar_file, $photo_file, $username);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Profile updated successfully!'); window.location.href='profile.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn-container {
            text-align: center;
        }
        .btn {
            margin: 10px;
            min-width: 150px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Edit Profile</h2>

    <form action="edit.php" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label>First Name</label>
                    <input type="text" name="firstname" class="form-control" value="<?= $user['firstname'] ?>" required>
                </div>

                <div class="mb-3">
                    <label>Middle Name</label>
                    <input type="text" name="middlename" class="form-control" value="<?= $user['middlename'] ?>">
                </div>

                <div class="mb-3">
                    <label>Last Name</label>
                    <input type="text" name="lastname" class="form-control" value="<?= $user['lastname'] ?>" required>
                </div>

                <div class="mb-3">
                    <label>Gender</label>
                    <select name="gender" class="form-control" required>
                        <option value="Male" <?= $user['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= $user['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Address Line 1</label>
                    <input type="text" name="address1" class="form-control" value="<?= $user['address1'] ?>" required>
                </div>

                <div class="mb-3">
                    <label>Address Line 2</label>
                    <input type="text" name="address2" class="form-control" value="<?= $user['address2'] ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label>State</label>
                    <input type="text" name="state" class="form-control" value="<?= $user['state'] ?>" required>
                </div>

                <div class="mb-3">
                    <label>City</label>
                    <input type="text" name="city" class="form-control" value="<?= $user['city'] ?>" required>
                </div>

                <div class="mb-3">
                    <label>Aadhaar PDF</label>
                    <input type="file" name="aadhaar" class="form-control" accept=".pdf">
                    <p>Current: <a href="<?= $user['aadhaar'] ?>" target="_blank">View Aadhaar</a></p>
                </div>

                <div class="mb-3">
                    <label>Profile Photo</label>
                    <input type="file" name="photo" class="form-control" accept="image/*">
                    <p>Current: <img src="<?= $user['photo'] ?>" alt="Profile Photo" style="width: 100px; height: 100px;"></p>
                </div>
            </div>
        </div>

        <!-- Centered Buttons -->
        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="profile.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
