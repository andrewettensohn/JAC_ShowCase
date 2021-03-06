<?php   session_start();  ?>
<?php include "../inc/dbinfo.inc"; ?>
<html>
<title class="w3-center">Application Center Admin</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<!--Nav Bar-->
<div class="w3-bar w3-border w3-xlarge">
  <a href="../index.html" class="w3-bar-item w3-button">Home</a>
  <a href="adminDashboard.php" class="w3-bar-item w3-button">Applicant List</a>
  <a href="applicantAdd.php" class="w3-bar-item w3-button">Add Applicant</a>
  <a href="postingCreator.php" class="w3-bar-item w3-button">Job Creator</a>
  <a href="closePosting.php" class="w3-bar-item w3-button">Close Job Posting</a>

  <?php
  //Logout button
  if(!isset($_SESSION['use'])) // If session is not set then redirect to Login Page
  {
      header("Location: adminLogin.html");  
  }

    echo "<a href='adminLogout_data.php' class='w3-bar-item w3-button w3-right'>Logout</a> "; 
  ?>

</div>
<!--Nav Bar-->

<div class="w3-content" style="max-width:1400px">

<!-- Grid -->
<div class="w3-row">


<div class="w3-center">
<h1 >Application Center Admin</h1>
</div>

<h2>Applicant List</h2>
<!-- Display table data. -->
<table cellpadding="2" cellspacing="2" class="w3-table-all w3-padding-32"  >
  <tr>
    <td>ID</td>
    <td>Job Interest</td>
    <td>Name</td>
    <td>Address</td>
    <td>Email</td>
    <td>Resume File</td>
    <td>Select Applicant to Remove</td>
  </tr>

  </div>
</div>

</body>
</html>

<?php



  //Create a connection to the database
  $connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
  $database = mysqli_select_db($connect, DB_DATABASE);


$result = mysqli_query($connect, "SELECT * FROM testApplicants"); 

//Fill table with data
while($query_data = mysqli_fetch_row($result)) {
  echo "<tr>";
  echo "<td>",$query_data[0], "</td>",
       "<td>",$query_data[1], "</td>",
       "<td>",$query_data[2], "</td>",
       "<td>",$query_data[3], "</td>",
       "<td>",$query_data[4], "</td>",
       "<td>",
       "<a href='http://ec2-18-232-155-220.compute-1.amazonaws.com/$query_data[5]'>",
       "Resume File",
       "</a>",
       "</td>",
       "<td>",
       "<form action='' method='post'>",
       "<button type='submit' name='removeApplicant' value='$query_data[0]' id='$query_data[0]'>Remove Applicant</button>",
       "</form>",
       "</td>";
  echo "</tr>";
}

?>

<?php
//Remove selected applicant from database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $posted_jobID =($_POST['removeApplicant']);

  $query = "DELETE FROM testApplicants WHERE ID='$posted_jobID'";
  $result = mysqli_query($connect, $query);



  header('Location: adminDashboard.php');

}
?>