<?php require "config.php"; ?>
<?php
if(isset($_GET['upd'])){
    $id = $_GET['upd'];
    $q= "SELECT * FROM tb_employees WHERE id=$id";
    $check = mysqli_query($conn,$q) or die("Cannot fetch the data.".mysqli_error($conn));
    $employees = mysqli_fetch_assoc($check);
}
?>
<?php 
    if(isset($_POST['update'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phonenumber = $_POST['phonenumber'];
        $q = "UPDATE tb_employees SET firstname = '$firstname' , lastname = '$lastname', email = '$email' , password ='$password',phonenumber = '$phonenumber' WHERE id=$id";
        $check = mysqli_query($conn,$q) or die("Cannot update the data. ".mysqli_error($conn));
        if($check) header("Location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>

    <title>CRUD</title>
</head>
<body>
    <div class="container" align= center>
    <div class="row">
    <div class="col-lg-12">
    <!-- Update data from here -->
    <div class="col-lg-4 col-lg-offset-4">
    <h3 align='center'>Update Data</h3>
    <hr>
    <form name="update" id="update" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
    <div align='left' class="form-group">
    <label  for="firstname" >Firstname</label>
    <input  value="<?php echo $employees['firstname']?>" name="firstname" id="firstname" type="text" class="form-control" placeholder="firstname">
    </div>
    <div align='left' class="form-group">
    <label for="lastname">Lastname</label>
    <input value="<?php echo $employees['lastname']?>" name="lastname" id="lastname" type="text" class="form-control" placeholder="lastname">
    </div>
    <div align='left' class="form-group">
    <label for="email">E-mail</label>
    <input value="<?php echo $employees['email']?>" name="email" id="email" type="text" class="form-control" placeholder="email">
    </div>
    <div align='left' class="form-group">
    <label for="password">Password</label>
    <input value="<?php echo $employees['password']?>" name="password" id="password" type="password" class="form-control" placeholder="password">
    </div>
    <div align='left' class="form-group">
    <label for="password">Confirm Password</label>
    <input value="<?php echo $employees['password']?>" name="password" id="password" type="password" class="form-control" placeholder="password">
    </div>
    <div align='left' class="form-group">
    <label  for="phonenumber">PhoneNumber</label>
    <input value="<?php echo $employees['phonenumber']?>" name="phonenumber" id="phonenumber" type="tel" class="form-control" placeholder="phonenumber" required>
    </div>
<div class="form-group">
     <button name="update" id="update" class="btn btn-sm btn-info"">Update</button>
     </div>
     </form>
     </div>
     </div>
     </div>
     </div>
</body>
</html>
