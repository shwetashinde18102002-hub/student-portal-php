<?php
session_start();
include('connectiondb.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the Cancel button was clicked
    if (isset($_POST['cancel'])) {
        header("Location: home.php");
        exit();
    }

    // Form data
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);  // Encrypt password

    // Upload folder
    $target_dir = "uploads/";

    // Aadhaar PDF Upload
    $aadhaar_file = $target_dir . basename($_FILES["aadhaar"]["name"]);
    move_uploaded_file($_FILES["aadhaar"]["tmp_name"], $aadhaar_file);

    // Profile Photo Upload
    $photo_file = $target_dir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $photo_file);

    // Insert data into the database
    $sql = "INSERT INTO users (firstname, middlename, lastname, gender, address1, address2, state, city, aadhaar, photo, username, password) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssssssss", $firstname, $middlename, $lastname, $gender, $address1, $address2, $state, $city, $aadhaar_file, $photo_file, $username, $password);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
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
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
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
    <h2 class="text-center mb-4">Student Registration</h2>

    <form action="register.php" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label>First Name</label>
                    <input type="text" name="firstname" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Middle Name</label>
                    <input type="text" name="middlename" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Last Name</label>
                    <input type="text" name="lastname" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Gender</label>
                    <select name="gender" class="form-control" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Address Line 1</label>
                    <input type="text" name="address1" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Address Line 2</label>
                    <input type="text" name="address2" class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label>State</label>
                    <input type="text" name="state" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>City</label>
                    <input type="text" name="city" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Aadhaar PDF</label>
                    <input type="file" name="aadhaar" class="form-control" accept=".pdf" required>
                </div>

                <div class="mb-3">
                    <label>Profile Photo</label>
                    <input type="file" name="photo" class="form-control" accept="image/*" required>
                </div>
            </div>
        </div>

        <!-- Centered Buttons -->
        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Register</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>

        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
