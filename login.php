<?php require "config.php"; ?> 
<?php
if(isset($_POST["login"])){
 if(!empty($_POST['firstname']) && !empty($_POST['password'])){
 $firstname = $_POST['firstname'];
 $password = $_POST['password'];
 $query = mysqli_query($conn, "SELECT * FROM tb_employees WHERE firstname='".$firstname."' AND password='".$password."'");
 $numrows = mysqli_num_rows($query);
 if($numrows !=0)
 {
 while($row = mysqli_fetch_assoc($query)){
 
 $dbfirstname=$row['firstname'];
 $dbpassword=$row['password'];
 }
 if($firstname == $dbfirstname && $password == $dbpassword)
 {
 session_start();
 $_SESSION['sess_user']=$firstname;
 //Redirect Browser
 header("Location:index.php");
 }
 }
 else
 {
 echo "Invalid Username or Password!";
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
