<?php
require "config.php"; ?>
<?php
session_start();
if(!isset($_SESSION["sess_user"])){
 header("Location: login.php");
}
else
{}
?>
<?php 
if((isset($_POST['submit']))){
    
    $firstname = strip_tags($_POST['firstname']);
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);//md5 encrypt password and saved in database.
    $confirmpassword = md5($_POST['confirmpassword']);
    $phonenumber = $_POST['phonenumber'];
    if(preg_match('/[^a-zA-Z]/', $firstname)){
        echo "Only alphabets are allowed as firstname";
    }
    else {
    }
    if(preg_match('/[^a-zA-Z]/', $lastname)){
        echo "Only alphabets are allowed as lastname";
    }else {
    }
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
    }else {
        echo "Invalid email address";
    }
    if(strlen($firstname)>2 && strlen($firstname) < 15){
    }else{
        echo "Firstname must be between 2 to 15 chars long.";
    }
    if(strlen($lastname)>2 && strlen($lastname) < 15){
    }else{
        echo "Lastname must be between 2 to 15 chars long.";
    }
            if(empty(trim($firstname))){
                echo "Firstname is required.";
    }
    echo "<br>";
            if(empty(trim($lastname))){
                echo "Lastname is required.";
    }
    echo "<br>";        
            if(empty(trim($email))){
               echo "Email is required.";
    }
    echo "<br>";
            if(empty(trim($password))){
               echo "Password is required.";
    }
    echo "<br>";
            if(empty(trim($confirmpassword))){
               echo "Confirmpassword is required.";
    }
    echo "<br>";
            if(empty(trim($phonenumber))){
               echo "Phonenumber is required.";
    }
    if(isset($_POST['password']) && $_POST['password']==$_POST['confirmpassword']){ //confirmpassword is not saved in database. 
        $confirmpassword=$_POST['confirmpassword']; //only password is saved in database not confirmpassword.
            $q="INSERT INTO tb_employees( `firstname` , `lastname` , `email` , `password`, `phonenumber`) 
            VALUES('$firstname','$lastname','$email','$password','$phonenumber')";
            $check = mysqli_query($conn,$q) or die("Cannot insert data into database" .mysqli_error($conn));
            if($check) echo "Data submitted successfully."; 
        }
        else
        {
            
            echo "Password doesn't match."; 
        }
        
} 
?>
<?php
       if(isset($_GET['del'])){
           $id = $_GET['del'];
           $q= "DELETE FROM tb_employees WHERE id= $id ";
           $check = mysqli_query($conn,$q) or die("Cannot delete the data from database." .mysqli_error($conn));
           if($check) echo "Data deleted from database";
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
    <p>
   <?php $_SESSION['sess_user'];?>
   <div class="container" align='right'>
   <a href="logout.php" class="btn btn-danger">Sign Out</a> 
    </div>
    </p>
	<div class="container" align='center'>
		<div class="row" class="col-sm-4">
			<div class="col-lg-12 flex-container">
				<div class="col-lg-5 col-xs-5">
					<table>
                        <tr>
                        <td>
                            
                            <div class="col-lg-15">
                                <h3>Create New Record</h3>
                                <hr>
                                <form name="create" id="create" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                    <div class="form-group">
                                        <label for="firstname">Firstname</label>
                                        <input name="firstname"  id="firstname" type="text" class="form-control" placeholder="firstname" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname">Lastname</label>
                                        <input name="lastname" id="lastname" type="text" class="form-control" placeholder="lastname" required>
                                    </div> 
                                    <div class="form-group">
                                        <label for="email">E-mail</label>
                                        <input name="email" id="email" type="text" class="form-control" placeholder="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input name="password" id="password" type="password" class="form-control" placeholder="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmpassword">ConfirmPassword</label>
                                        <input name="confirmpassword" id="confirmpassword" type="password" class="form-control" placeholder="confirmpassword" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phonenumber">PhoneNumber</label>
                                        <input name="phonenumber" id="phonenumber" type="tel" class="form-control" placeholder="phonenumber" required>
                                    </div>
                                    <div class="form-group">
                                        <button name="submit"  id="submit" class="btn btn-success btn-block">Create</button>
                                    </div>
                                   
                                </form>
                            </div>
                        </td>
                                </tbody>
                                </table>
                            </div>
                        </td>
                             <td>
                                <h3 align='center'>Employees Data</h3>
                                <hr>
                            
                                    <table class="table table-striped">
                                    <div class="table-responsive">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Email</th>  
                                        <th>PhoneNumber</th>

                                    </tr>
                                    </td>
                                    </thead> 
                                    
                                    <tbody>
                                    <?php
                                    $q = "SELECT * FROM tb_employees";
                                    $check = mysqli_query($conn,$q) or die("Cannot fetch data from database ".mysqli_error($conn));
                                    if(mysqli_num_rows($check)>0){
                                        while($employees = mysqli_fetch_assoc($check)){?>
                                            <tr >
                                            <td> <?php echo $employees['id']?> </td>
                                                <td> <?php echo $employees['firstname']?> </td>
                                                <td> <?php echo $employees['lastname']?> </td>
                                                <td> <?php echo $employees['email']?> </td> 
                                                <td> <?php echo $employees['phonenumber']?> </td>
                                                <td>
                                                    <a href="<?php $_SERVER['PHP_SELF'] ?>?del=<?php echo $employees['id']?>"
                                                    class="btn btn-sm btn-danger">Delete</a>
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-info"
                                                    href="update.php?upd=<?php echo $employees['id'] ?>"
                                                    >Updata</a>
                                                </td>
                                            </tr>
                                            
                                        <?php
                                        }
                                    }
                                    ?>
                        </tr>
                    </table>
					
				</div>
			</div>
		</div>
	</div>
</body>
</html>
