<!-- create form using html and css -->
<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Page</title>
  <!-- Bootstrap CSS --> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<!-- Custom styles for this template-->
  <link rel="stylesheet" href="style3.css?<?php echo time(); ?>"/>  
</head>
<body>
    
    <?php
    session_start();// session start
    //update location to index.php if the session is false
    if (!isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: index.php");
        die();
    }

    // initialize Connection
    include 'config.php';

    // select data from database
    $query = mysqli_query($conn, "SELECT * FROM user_table WHERE email='{$_SESSION['SESSION_EMAIL']}'");

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
    ?>

  <!-- top navigation bar -->
  <div class="topnav">
      <a href="#home">Profile</a>
      <div class="topnav-right">
      <p><?php echo "Welcome " . $row['firstname'] . " !"?></p>
      <a href="logout.php">Logout</a>
      <img src="pic5.png" class="img-fluid" alt="" width="30" height="30" style="vertical-align:middle;margin:15px 0px">
      <img src="pic6.png" class="img-fluid" alt="" width="100" height="40"style="vertical-align:middle;margin:0px 495px">
      </div>
  </div>

  <!-- side bar -->
      <br><br><br><br>
      <table class="styled-table">
    <thead>
        <tr>
          <th>First Name</th>  
          <th>Last Name</th>  
          <th>IC Number</th> 
          <th>Email</th>  
          <th>Address</th>  
          <th>City</th>  
          <th>State</th>  
          <th>Postal Code</th>
          <th>Contact No</th>  
          <th>date of Birth</th>  
          <th>Gender</th>
        </tr>
    </thead> 

    <tbody>
    <tr>   
          <td><?php echo $row["firstname"];?></td>  
          <td><?php echo $row["lastname"];?></td>  
          <td><?php echo $row["ic"];?></td>  
          <td><?php echo $row["email"]; ?></td>  
          <td><?php echo $row["address"];?></td> 
          <td><?php echo $row["city"];?></td>  
          <td><?php echo $row["state"];?></td> 
          <td><?php echo $row["postalcode"];?></td> 
          <td><?php echo $row["contactno"];?></td>  
          <td><?php echo $row["date"];?></td> 
          <td><?php echo $row["gender"];?></td>    
    </tr>   
    </tbody>
    <?php
    }  
    ?> 
  

<?php
if(isset($_POST['add']))
{

date_default_timezone_set("Asia/Kuala_Lumpur");// set timezone

$datenow = date('y-m-d');// get current date
$timenow = date('h:m:s');// get current time
$userid = $row['id'];

// variables for input data
$date = $_POST['date'];
$time = $_POST['time'];
$venue = $_POST['venue'];

// sql query for inserting data into database
$sql= "INSERT INTO booster_reg(id,date,time,venue,c_date, c_time) VALUES('$userid','$date','$time','$venue','$datenow','$timenow')";
mysqli_query($conn, $sql);
// sql query for inserting data into database
echo '<div class="alert alert-success">Thank You. You will be contacted via email when the booster appoinment is confirm and scheduled.</div>';// prompt alert
}
?>


<div class="main">

<div class="side2">
<img src="pic2.jpg" class="img-fluid" alt="" style = "width: 500px" style="height: 550px">
</div>

  <h2>Covid-19 Immunization Programme</h2>
  <p>Please insert your vaccination appoinment details</p>
  <br>
  
  <div class="page-header">
      <h4>FREE Vaccination Appoinment</h4>
  </div>

          <form method="post" action="welcome.php">


          <div class="form-group">
          <label for="prefereddate"> Prefered Date : </label>
          <input id="datefield" type='date' name="date" style="width:680px;" class="form-control" min='1899-01-01' max='2000-13-13'>
          </div><br>

          <div class="form-group">
          <label for="preferedtime"> Prefered Time : </label>
          <input type="time" name="time" style="width:680px;" class="form-control">
          </div><br>
      
          <div class="form-group">
          <label for="venue"> PPV Venue : </label>
          <select class="form-control" name="venue" style="width:680px;" class="form-control">
          <option selected="selected">Choose one</option>
          </div>

<?php
// product array
$dropcat = array("Pantai Hospital Batu Pahat", "Pantai Hospital Sungai Petani", "Hospital Lam Wah Ee", "Metro Hospital Sungai Petani", "Gleneagles Hospital Penang");

// iterating through the product array
foreach($dropcat as $booking_info){
    ?>
    <option value="<?php echo $booking_info; ?>"><?php echo $booking_info; 
    ?></option>
    <?php
    }
    ?>
    </select>

<br><br>
    
            <div class="col-lg-10">
            <button type="submit" value="submit" class="btn1 mt-2 mb-3" name="add">Book</button>
            </div>	

          </form>


</body>
</html>




