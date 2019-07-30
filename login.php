<?php require "config.php"; ?> 
<?php
if(isset($_POST["login"])){
 if(!empty($_POST['email']) && !empty($_POST['password'])){
 $email = $_POST['email'];
 $password =($_POST['password']); 
 $query = mysqli_query($conn, "SELECT * FROM login_admin WHERE email='$email' AND password='$password'");
 $numrows = mysqli_num_rows($query);
 if($numrows !=0)
 {
     //mysqli_fetch_assoc() function fetches a result row as an associative array.
 while($row = mysqli_fetch_assoc($query)){
 
 $dbemail=$row['email'];
 $dbpassword=$row['password'];
 }
 if($email == $dbemail && $password == $dbpassword)
 {
 session_start();
 $_SESSION['sess_user']=$email;
 //Redirect Employees Data
 header("Location:index.php");
 }
 }
 else
 {
 echo "Invalid Email or Password!";
 }
 }
 else
 {
 echo "Required All fields!";
 }
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
                    <label for="email">Email</label> <!-- admin123@gmail.com -->
                    <input name="email"  id="email" type="text" class="form-control" placeholder="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label><!-- admin123 -->
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
