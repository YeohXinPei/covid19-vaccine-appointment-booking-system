<?php
    session_start();// session start
    //update location to welcome.php if the session is true
    if (isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: welcome.php");
        die();
    }

    // initialize Connection
    include 'config.php';

    $msg = "";// declare variable

    if (isset($_GET['verification'])) {
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user_table WHERE code='{$_GET['verification']}'")) > 0) {// check the code with the link
           // update user_table (flag = 1) 
            $query = mysqli_query($conn, "UPDATE user_table SET code='', flag='1'WHERE code='{$_GET['verification']}'");
            
            if ($query) {
                $msg = "<div class='alert alert-success'>Account verification has been successfully completed.</div>"; //if successful, prompt alert
            }

        } else {
        header("Location: index.php");//if unccessful,update location to index.php
        }
    }

    if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['email'])));// receive input values from the form
    $password = mysqli_real_escape_string($conn, htmlspecialchars(trim(md5($_POST['password']))));// receive input values from the form

    $sql = "SELECT * FROM user_table WHERE email='{$email}' AND password='{$password}'";// check the input values same with values in database
    if($result = mysqli_query($conn, $sql))
             
        if (mysqli_num_rows($result) > 0) 
            {
            $row = mysqli_fetch_assoc($result);

                if (empty($row['code'])) {
                    $_SESSION['SESSION_EMAIL'] = $email;// declare session
                    header("Location: welcome.php");// if code is correct, update location to welcome.php
                } else {
                    $msg = "<div class='alert alert-info'>First verify your account and try again.</div>";// throw error message
                }
        }

    // check empty field
    elseif(empty($_POST['email'])|| empty($_POST['password'])){
    $msg = "<div class='alert alert-info'>Please fill in required field</div>";// throw error message
    }
        
    // validate email
    elseif(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
    $msg = "<div class='alert alert-info'>Please enter a valid email address</div>";// throw error message
    }
    
    // validate password
    elseif(preg_match('/^[A-Z]+$/', $_POST['password'])|| (preg_match('/^[a-z]+$/', $_POST['password']))|| (preg_match("/^[0-9]{1}$/",$_POST["password"])) || strlen($_POST["password"])<8){
    $msg = "<div class='alert alert-info'>Only accept 6 characters minimum, include 1 capital letter and 1 integer</div>";// throw error message
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
    <title>Login</title>
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
				<h3>WELCOME USER!</h3>
				<h4>Sign into your account</h4>

				<form method="post"class="form-row">
					<div class="col-lg-20">
					Email: <br>
					<input type="text" name="email" placeholder="Email" class="form-control my-2 p-2">
					</div>

					<div class="col-lg-20">
				    Password: <br>
					<input type="password" name="password" placeholder="Password" class="form-control my-2 p-2">
					</div>
			
					<div class="col-lg-10">
					<button type="submit" value="submit" name="submit" class="btn1 mt-2 mb-3">Submit</button>
					</div>	
				
					<p>Don't have an account? <a href = "register.php">Register here</a></p>
                    <p>Admin login? <a href = "index_admin.php">Admin</a></p>
				</form>
				</div>

			</div>

		</div>
	</section> 

</body>
</html>