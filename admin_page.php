<?php  
     session_start();// session start
     //update location to admin_page.php if the session is false
     if (!isset($_SESSION['SESSION_ADMINEMAIL'])) {
     header("Location: index_admin.php");
     die();
     } 

     // initialize Connection
     include 'config.php';

     // join user_table and booster_reg
     $sql = "SELECT * FROM user_table INNER JOIN booster_reg ON user_table.id = booster_reg.id";  
     $result = mysqli_query($conn, $sql); 
     
     // declare rec no as zero
     $num = 0;

 ?>  


<!-- create form using html and css -->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Page</title>
    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="style3.css?<?php echo time(); ?>"/> 
    <!-- Bootstrap CSS --> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
      
<body>  

     <!-- top navigation bar -->
     <div class="topnav">
          <a href="#home">Profile</a>
          <div class="topnav-right">
          <p>Welcome Admin!</p>
          <a href="logout.php">Logout</a>
          <img src="pic5.png" class="img-fluid" alt="" width="30" height="30" style="vertical-align:middle;margin:15px 0px">
          <img src="pic6.png" class="img-fluid" alt="" width="100" height="40"style="vertical-align:middle;margin:0px 495px">
           </div>
     </div>
<br />  

<table class="styled-table">
    <thead>
        <tr>
          <th>Rec.No</th>  
          <th>Full Name</th>  
          <th>IC Number</th> 
          <th>Email</th>  
          <th>Contact Number</th>  
          <th>Preferred Date</th>  
          <th>Preferred Time</th>  
          <th>PPV</th>
        </tr>
    </thead>

    <?php  
          // fetch data if it is available in database
          if(mysqli_num_rows($result) > 0){  
               while($row = mysqli_fetch_array($result)){  
     ?>  

    <tbody>
    <tr>   
          <td><?php echo ++$num;?></td> <!-- print rec no by adding one  -->
          <td><?php echo $row['firstname']. '  ' . $row['lastname'];?></td>  
          <td><?php echo $row["ic"];?></td>  
          <td><?php echo $row["email"];?></td>  
          <td><?php echo $row["contactno"];?></td>  
          <td><?php echo $row["date"]; ?></td>  
          <td><?php echo $row["time"];?></td> 
          <td><?php echo $row["venue"];?></td>   
    </tr>   
    </tbody>

    <?php
                }  
          }  
     ?>
</table>
</div>  

</body>  
</html>