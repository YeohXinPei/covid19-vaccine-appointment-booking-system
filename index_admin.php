<?php
    session_start();// session start
    //update location to admin_page.php if the session is true
    if (isset($_SESSION['SESSION_ADMINEMAIL'])) {
        header("Location: admin_page.php");
        die();
    } 

    // initialize Connection
    include 'config.php';

    $msg = "";// declare variable

    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($conn, trim($_POST['email']));// receive input values from the form
        $password = mysqli_real_escape_string($conn, trim($_POST['password']));// receive input values from the form


        $sql = "SELECT * FROM admin_table WHERE email='$email' AND password='$password'";// check the input values same with values in database
        if( $result = mysqli_query($conn, $sql))
           
        if (mysqli_num_rows($result) > 0) {// if email and password are valid          
             $row = mysqli_fetch_assoc($result);
             $_SESSION['SESSION_ADMINEMAIL'] = $email;// declare session
             header("Location: admin_page.php");// update location to admin_page.php

        }
        // check empty field
    elseif(empty($_POST['email'])|| empty($_POST['password'])){
        $msg = "<div class='alert alert-info'>Please fill in required field</div>";// throw error message
        }
        else{
            $msg = "<div class='alert alert-danger'>Email or password do not match.</div>";// throw error message
        } 
    }
?>


<!-- create form using html and css -->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<!-- Custom styles for this template-->
    <link rel="stylesheet" href="style1.css?<?php echo time(); ?>"/>  
</head>

<body>
    <div class="title mt-4 mb-8">COVID-19 VACCINATION</div><br>
    <?php echo $msg; ?><!-- show error message -->

	<section class="Form mx-5 my-5">
		<div class="container">
			<div class="row no-gutters ">

				<div class="col-lg-5">
				<img src="pic1.jpg" class="img-fluid" alt="">
				</div>

				<div class="col-lg-5 px-5 pt-5 mt-3">
				<h3>WELCOME ADMIN!</h3>
				<h4>Sign into your account</h4>

					<form method="post"class="form-row">
                        <div class="col-lg-20">
                        Email: <br>
                        <input type="text" name="email" placeholder="Email: admin123@gmail.com" class="form-control my-2 p-2">
                        </div>

						<div class="col-lg-20">
						Password: <br>
						<input type="password" name="password" placeholder="Password: 12345" class="form-control my-2 p-2">
						</div>
			
						<div class="col-lg-10">
						<button type="submit" value="submit" name="submit" class="btn1 mt-2 mb-3">Submit</button>
						</div>	
				
						<p>Don't have an account? <a href = "register.php">Register here</a></p>
                        <p>User login? <a href = "index.php">User</a></p>
                    </form>
			    </div>

			</div>
		</div>
	</section> 

</body>
</html>