<?php
include 'conn.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM employee WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Update Employee</h2>
        <div class="mt-4">
            <form action="update.php?id=<?= $id ?>" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?= $row['name'] ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= $row['email'] ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" id="address" value="<?= $row['address'] ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="salary">Salary</label>
                        <input type="number" class="form-control" name="salary" id="salary" value="<?= $row['salary'] ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="dob">Dob</label>
                        <input type="date" class="form-control" name="dob" id="dob" value="<?= $row['dob'] ?>" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update Employee</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $salary = $_POST['salary'];
    $dob = date('Ymd', strtotime($_POST['dob']));

    $sql = "UPDATE employee SET name='$name', email='$email', address='$address', salary='$salary', dob='$dob' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
