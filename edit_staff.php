<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    echo "Access denied.";
    exit;
}

include 'db.php';

if (!isset($_GET['id'])) {
    echo "Invalid request.";
    exit;
}

$staff_id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM Staff WHERE staff_id = $staff_id");
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Staff member not found.";
    exit;
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $contact = $_POST['contact'];
    $department_id = $_POST['department_id'];

    $query = "UPDATE Staff SET 
                name='$name', 
                position='$position', 
                salary='$salary', 
                contact='$contact', 
                department_id='$department_id' 
              WHERE staff_id = $staff_id";

    if (mysqli_query($conn, $query)) {
        header("Location: view_staff.php");
    } else {
        echo "Error updating staff: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Staff</title></head>
<body>
    <h2>Edit Staff Member</h2>
    <form method="POST">
        Name: <input type="text" name="name" value="<?php echo $data['name']; ?>" required><br>
        Position: <input type="text" name="position" value="<?php echo $data['position']; ?>" required><br>
        Salary: <input type="number" name="salary" value="<?php echo $data['salary']; ?>" required><br>
        Contact: <input type="text" name="contact" value="<?php echo $data['contact']; ?>" required><br>
        Department ID: <input type="number" name="department_id" value="<?php echo $data['department_id']; ?>" required><br>
        <input type="submit" name="update" value="Update Staff">
    </form>
</body>
</html>
