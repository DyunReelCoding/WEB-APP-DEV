<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
?>
<style> .btn-warning {
  position: absolute;
  right: 150;
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>List of Students</h2>
        <a class="btn btn-primary" href="/login-register/create.php" role="button"> New Student </a>
        <a href="logout.php" class="btn btn-warning">Logout</a>
        <br>
        <table class="table">
           <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
           </thead>
            <tbody>
                <?php 
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "attendance";

                //create connection to database
                $connection = new mysqli($servername, $username, $password, $database);

                //check connection
                if($connection->connect_error){
                    die("Connection Failed: ". $connection->connect_error);
                }

                //read all row from database table
                $sql = "SELECT * FROM students";
                $result = $connection->query($sql);

                if(!$result){
                    die("Invalid query: " . $connection->error);
                }

                //read data of each row
                while($row = $result->fetch_assoc()){
                    echo "
                    <tr>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[phone]</td>
                    <td>$row[address]</td>
                    <td>$row[created_at]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/login-register/edit.php?id=$row[id]'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='/login-register/delete.php?id=$row[id]'>Delete</a>
                    </td>
                </tr>
                    ";
                }

                ?>
                
            </tbody>           
        </table>
    </div>
</body>
</html>
