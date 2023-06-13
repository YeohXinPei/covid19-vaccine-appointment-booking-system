<?php
    //import PHPMailer classes into the global namespace
    //download from Github
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    session_start();//starting session*  

    require 'vendor/autoload.php';// PHPMailer Object
?>


<?php
/* declare variable */
$firstnameErr = $lastnameErr = $icErr = $emailErr = $addressErr = $cityErr = $stateErr = $postalcodeErr = $contactnoErr = $dateErr = $genderErr = $passwordErr = $confirmpasswordErr = "";
$firstname= $lastname = $ic = $email = $address = $city= $state = $postalcode = $contactno = $date = $gender = $password = $confirmpassword ="";

// initialize Connection
include 'config.php';
  

// check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  
        //validate firstname
        if (empty($_POST["firstname"])) {
          $firstnameErr = "First name is required";// throw error message
        } elseif (!preg_match('/^[a-zA-Z ]+$/', $_POST['firstname'])){
        $firstnameErr = "Only accept characters and white space";// throw error message
        }else{
          $firstname = mysqli_real_escape_string($conn,trim($_POST["firstname"]));// receive input values from the form
        }
      

        //validate lastname
        if (empty($_POST["lastname"])) {
          $lastnameErr = "Last name is required";// throw error message
        } elseif (!preg_match('/^[a-zA-Z ]+$/', $_POST['lastname'])){
        $lastnameErr = "Only accept characters and white space";// throw error message
        }else{
          $lastname = mysqli_real_escape_string($conn,trim($_POST["lastname"]));// receive input values from the form
        }
      

        //validate ic
        if (empty($_POST["ic"])) {
          $icErr = "Ic is required";// throw error message
        } elseif (!preg_match("/^[0-9\-]{14}+$/",$_POST["ic"])){
        $icErr = "Only accept ic with 12 integers";// throw error message
        }else{
          $ic = mysqli_real_escape_string($conn,trim($_POST["ic"]));// receive input values from the form
         }
      

         //validate email
        if (empty($_POST["email"])) {
          $emailErr = "Email is required";// throw error message
        } else {
		  	$email = mysqli_real_escape_string($conn,trim($_POST["email"]));// receive input values from the form
			
              if (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                $emailErr = "Please enter a valid email";// throw error message
              }else{
              // check if email already exists in database
              $user_check_query = "SELECT * FROM user_table WHERE email='$email' LIMIT 1";
              $result = mysqli_query($conn, $user_check_query);
              // fetch a result row as an associative array:
              $user = mysqli_fetch_assoc($result);
              // return $user;
       
                      if ($user) { // if user exists
                        if ($user['email'] === $email) {
                        $emailErr =  "Email already exists"; // throw error message
                        }
                      }
                    }		    
          }

          
        //validate address
        if (empty($_POST["address"])){
          $addressErr = "Address is required";// throw error message
        }else{
          $address = mysqli_real_escape_string($conn,trim($_POST["address"]));// receive input values from the form
        }


        //validate address
        if (empty($_POST["city"])) {
          $cityErr = "City is required";// throw error message
        } elseif (!preg_match('/^[a-zA-Z ]+$/',$_POST['city'])){
        $cityErr = "Only accept characters and white space";// throw error message
        }else{
          $city = mysqli_real_escape_string($conn,trim($_POST["city"]));// receive input values from the form
        }
      

        //validate state
        if (empty($_POST["state"])) {
          $stateErr = "State is required";// throw error message
        } elseif (!preg_match('/^[a-zA-Z ]+$/', $_POST['state'])){
        $stateErr = "Only accept characters and white space";// throw error message
        }else{
          $state= mysqli_real_escape_string($conn,trim($_POST["state"]));// receive input values from the form
        }
      

        //validate postalcode
        if (empty($_POST["postalcode"])) {
          $postalcodeErr = "Postal code is required";// throw error message
        } elseif (!preg_match("/^[0-9]{5}$/",$_POST["postalcode"])){
        $postalcodeErr = "Only accept postal code with 5 integers";// throw error message
        }else{
          $postalcode = mysqli_real_escape_string($conn,trim($_POST["postalcode"]));// receive input values from the form
        }
      

        //validate contactno
        if (empty($_POST["contactno"])) {
          $contactnoErr = "Contact no is required";// throw error message
        } elseif (!preg_match("/^[0-9\-]{8,15}$/",$_POST["contactno"])){
        $contactnoErr = "Only accept contact no with integers";// throw error message
        }else{
          $contactno = mysqli_real_escape_string($conn,trim($_POST["contactno"]));// receive input values from the form
        }
      

        //validate date
        if (empty($_POST["date"])){
          $dateErr = "Date of birth is required";// throw error message
          }else{
          $date = mysqli_real_escape_string($conn,trim($_POST["date"]));// receive input values from the form
          }
      

        //validate gender
        if (empty($_POST["gender"])) {// throw error message
          $genderErr = "Gender is required";
        } else {
          $gender = mysqli_real_escape_string($conn,trim($_POST["gender"]));// receive input values from the form
        }
      

        //validate password
        if (empty($_POST["password"])) {
          $passwordErr = "Password is required";// throw error message
        } elseif (preg_match('/^[A-Z]+$/', $_POST['password'])|| (preg_match('/^[a-z]+$/', $_POST['password']))|| (preg_match("/^[0-9]{1}$/",$_POST["password"])) || strlen($_POST["password"])<6){
        $passwordErr = "Only accept 6 characters minimum, include 1 capital letter and 1 integer";// throw error message
        }else{
          $password = mysqli_real_escape_string($conn,trim(md5($_POST["password"])));// receive input values from the form
        }
      

        //validate confirmpassword
        if (empty($_POST["confirmpassword"])) {
          $confirmpasswordErr = "Confirm password is required";// throw error message
        } elseif ($_POST['password'] != $_POST['confirmpassword']){
        $confirmpasswordErr = "Passwords does not match";// throw error message
        }else{
          $confirmpassword= mysqli_real_escape_string($conn,trim(md5($_POST["confirmpassword"])));// receive input values from the form
        }


// basic validation - checking null fields
if (empty($firstnameErr) && empty($lastnameErr) && empty($icErr) && empty($emailErr) && empty($addressErr) && empty($cityErr) && empty($stateErr) && empty($postalcodeErr) && empty($contactnoErr) && empty($dateErr) && empty($genderErr) && empty($passwordErr)){
	  
	
    // generate random email verification code
    // hash the code using MD5 before saving in the database
    $code = mysqli_real_escape_string($conn, md5(rand()));


    // insert input into database
    $sql = "INSERT INTO user_table (firstname, lastname, ic, email, address, city, state, postalcode, contactno, date, gender, password, code) VALUES ('$firstname', '$lastname', '$ic', '$email', '$address','$city', '$state', '$postalcode', '$contactno', '$date','$gender', '$password','$code')";
    $results = mysqli_query($conn, $sql);
          
  //if unsuccessful, prompt alert
	if(!$results){
	$sqlerr = mysqli_error($conn);
	echo "<div class='alert alert-danger alert-dismissible fade show'>
    <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'>x</button>
    <strong>Error!</strong> Sorry there was an error creating your account: $sqlerr</div>";
  }
  
  // if successful, send verify email
  elseif($result){
                    echo "<div style='display: inline;'>";
                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);

                    try {
                        //Server settings
                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;           //Enable verbose debug output
                        $mail->isSMTP();										          	 //Send using SMTP 
					            	$mail->SMTPDebug = 0;										         //Stop print debug log
                        $mail->Host       = 'smtp.gmail.com';            //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                        //Enable SMTP authentication
                        $mail->Username   = 'yeohxinpei123@gmail.com';   //SMTP username (set own email address)
                        $mail->Password   = 'slafwgsooybfxmqd';          //SMTP password (set own email password)
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
                        $mail->Port       = 465;                         //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        //Recipients
                        $mail->setFrom('yeohxinpei123@gmail.com');
                        $mail->addAddress($email);

                        //Content
                        $mail->isHTML(true);                              //Set email format to HTML
                        $mail->Subject = 'no reply';
                        // Send verification link with code
                        $mail->Body    = 'Here is the verification link <b><a href="http://localhost:81/covid19_vaccine_appointment_booking_system/?verification='.$code.'">http://localhost:81/covid19_vaccine_appointment_booking_system/?verification='.$code.'</a></b>';


                        // if successful send email, prompt alert & head to login page
                        if ($mail->send()){
       
					            	echo '<div class="alert alert-success">Thank You! you will be redirected to the login page.</div>';
                        echo '<div class="alert alert-success">A verification link has send to you email.</div>';
					              header("Refresh: 5; URL=index.php");

                        }

			            		} catch (Exception $e) {
                        //require connect to wifi in order to send email
                        // throw error message if could no send the email
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }           
                } 

}
	}
?>

<!-- create form using html and css -->
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
     <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	   <!-- Custom styles for this template-->
    <link rel="stylesheet" href="style2.css?<?php echo time(); ?>"/>  
  </head>
<body>

	<div class="title mt-4 mb-8">CREATE NEW ACCOUNT</div>

  <section class="Form mx-5 my-5">
	  <div class="container ">
	    <form method="post" class="row g-3" action="">

  <div class="col-md-6">
  First Name: <br>
  <input type="text" name="firstname" placeholder="First Name" class="form-control">
  <span class="error"> * <?php echo $firstnameErr;?></span>
  </div>

  <div class="col-md-6">
  Last Name: <br>
  <input type="text" name="lastname" placeholder="Last Name" class="form-control">
  <span class="error"> * <?php echo $lastnameErr;?></span>
  </div>

  <div class="col-md-6">
  IC Number: <br>
  <input type="text" name="ic" placeholder="XXXXXX-XX-XXXX" class="form-control">
  <span class="error"> * <?php echo $icErr;?></span>
  </div>

  <div class="col-md-6">
  E-mail: <br>
  <input type="text" name="email" placeholder="Email" class="form-control">
  <span class="error">* <?php echo $emailErr;?></span>
  </div>

  <div class="col-12">
  Resident Address: <br>
  <input type="text" name="address" placeholder="Address" class="form-control">
  <span class="error"> * <?php echo $addressErr;?></span>
  </div>

  <div class="col-md-5">
  City: <br>
  <input type="text" name="city" placeholder="City" class="form-control">
  <span class="error"> * <?php echo $cityErr;?></span>
  </div>

  <div class="col-md-4">
  State: <br>
  <input type="text" name="state" placeholder="State" class="form-control">
  <span class="error"> * <?php echo $stateErr;?></span>
  </div>

  <div class="col-md-3">
  Postal Code: <br>
  <input type="text" name="postalcode" placeholder="Postal Code" class="form-control">
  <span class="error"> * <?php echo $postalcodeErr;?></span>
  </div>

  <div class="col-12">
  Contact No: <br>
  <input type="text" name="contactno" placeholder="XXX-XXXXXXX" class="form-control">
  <span class="error"> * <?php echo $contactnoErr;?></span>
  </div>

  <div class="col-md-6">
  Date of birth: <br>
  <input id="datefield" type='date' name="date" min='1899-01-01' max='2000-13-13' class="form-control">
  <span class="error"> * <?php echo $dateErr;?></span>
  </div>

  <div class="col-md-6">
  Gender: <br>
  <input type="radio" name="gender" value="female" class="mx-4">Female
  <input type="radio" name="gender" value="male" class="mx-4">Male
  <input type="radio" name="gender" value="other" class="mx-4">Other<br>
  <span class="error"> * <?php echo $genderErr;?></span>
  </div>

  <div class="col-12">
  Password: <br>
  <input type="password" name="password" placeholder="Password" class="form-control">
  <span class="error"> * <?php echo $passwordErr;?></span>
  </div>

  <div class="col-12">
  Confirm Password: <br>
  <input type="password" name="confirmpassword" placeholder="Confirm Password" class="form-control">
  <span class="error"> * <?php echo $confirmpasswordErr;?></span>
  </div>


  <div class="col-lg-10">
  <button type="submit" value="submit" class="btn1 mt-2 mb-3" name="submit">Sign Up</button>
	</div>	

  <div class="social-icons">
  <p>Back to login <a href="index.php">Login</a>.</p>
  </div>

      </form>
    </div>
  </section>
          
<!--date user can choose until 'today'-->
<script>
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; // January is 0
    var yyyy = today.getFullYear();
    if(dd<10){
            dd='0'+dd
        } 
        if(mm<10){
            mm='0'+mm
        } 

    today = yyyy+'-'+mm+'-'+dd;
    document.getElementById("datefield").setAttribute("max", today);

</script>

</body>
</html>