<?php require "config.php"; ?> 
?>
<?php
$error = '';
if((isset($_POST['login'])))
{
    $firstname = $_POST['firstname'];
    $password = $_POST['password'];
    
    $q = "SELECT * FROM tb_employees WHERE firstname = '$firstname' AND password = '$password'";
    //$check = mysqli_query($conn,$q) or die("Cannot fetch data from database ".mysqli_error($conn));
    $result = $conn->query($q);
    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        //echo 'logged in';
    }
    else
    {
        echo "valid username and Password is required.";
    }
    
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container" align='center'> 
        <div class="col-lg-3">
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="firstname">Firstname</label>
                    <input name="firstname"  id="firstname" type="text" class="form-control" placeholder="firstname" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" id="password" type="password" class="form-control" placeholder="password" required>
                </div>
                <div class="form-group">
                    <button name="login" id="login" class="btn btn-primary btn-block">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>