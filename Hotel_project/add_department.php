<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include 'db.php';
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Department - TREXO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #0a0a2a;
            color: #ffffff;
            overflow: hidden;
        }

        .floating-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(128, 0, 255, 0.08);
            box-shadow: 0 0 30px rgba(128, 0, 255, 0.3);
            animation: float 25s ease-in-out infinite;
        }

        .circle:nth-child(1) { width: 200px; height: 200px; top: 15%; left: 10%; }
        .circle:nth-child(2) { width: 300px; height: 300px; bottom: 10%; right: 15%; }
        .circle:nth-child(3) { width: 150px; height: 150px; top: 55%; left: 45%; }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-30px); }
        }

        .form-container {
            position: relative;
            z-index: 1;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-box {
            background-color: rgba(15, 15, 60, 0.9);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 0 30px rgba(128, 0, 255, 0.3);
            width: 100%;
            max-width: 450px;
        }

        .form-box h2 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: bold;
            color: #cc66ff;
        }

        .form-control {
            background-color: #1b1b3f;
            border: 1px solid #cc66ff;
            color: #ffffff;
        }

        .form-control::placeholder {
            color: #c084fc;
        }

        .form-control:focus {
            background-color: #111136;
            border-color: #cc66ff;
            color: #ffffff;
            box-shadow: 0 0 6px #cc66ff;
        }

        .btn-submit {
            background-color: #3efcbf;
            color: #000;
            font-weight: bold;
            width: 100%;
            border-radius: 10px;
            padding: 12px;
            font-size: 1.1rem;
            transition: background 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #2ed6a6;
        }

        .message {
            text-align: center;
            margin-top: 15px;
            font-weight: bold;
        }

        .text-success { color: #3efcbf; }
        .text-danger { color: #ff4d4d; }
    </style>
</head>
<body>

<div class="floating-bg">
    <div class="circle"></div>
    <div class="circle"></div>
    <div class="circle"></div>
</div>

<div class="form-container">
    <div class="form-box">
        <h2>Add New Department</h2>
        <form method="POST">
            <input type="text" name="department_name" class="form-control mb-3" placeholder="Department Name" required>
            <input type="number" name="hotel_id" class="form-control mb-4" placeholder="Hotel ID" required>
            <input type="submit" name="submit" class="btn btn-submit" value="Add Department">
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $department_name = $_POST['department_name'];
            $hotel_id = $_POST['hotel_id'];
            $query = "INSERT INTO Department (department_name, hotel_id) VALUES ('$department_name', '$hotel_id')";
            if (mysqli_query($conn, $query)) {
                echo "<p class='message text-success'>Department added successfully!</p>";
            } else {
                echo "<p class='message text-danger'>Error: " . mysqli_error($conn) . "</p>";
            }
        }
        ?>
    </div>
</div>

</body>
</html>
