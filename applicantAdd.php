<?php  session_start(); ?>
<?php include "../inc/dbinfo.inc"; ?>
<html>
<title>Application Center Admin</title>
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
    //Logout Button
  if(!isset($_SESSION['use'])) // If session is not set then redirect to Login Page
  {
      header("Location: adminLogin.html");  
  }

    echo "<a href='adminLogout_data.php' class='w3-bar-item w3-button w3-right'>Logout</a> "; 
  ?>

</div>

<div class="w3-center">
<h1 >Application Center Admin</h1>
</div>


<!-- Div for Formatting -->
<div class="w3-quarter">
    <p></p>
</div>
<!-- Div for Formatting -->


 <!-- Application Form -->
 <div class="w3-container w3-padding-32 w3-half">
        <form form action="" method="post" enctype="multipart/form-data" class="w3-container w3-card-4" id="appForm">
            <h2>Add a New Applicant</h2>

            <div class="w3-section">      
                <input id="JobInterest" class="w3-input" name="JobInterest" maxlength="45" size="30" required>
                <label>Job Interest</label>
            </div>

            <div class="w3-section">      
                <input id="Name" class="w3-input" name="Name" maxlength="45" size="30" required>
                <label>Name</label>
            </div>

            <div class="w3-section">      
                <input id="Address" class="w3-input" name="Address" maxlength="30" size="30" required>
                <label>Address</label>
            </div>

            <div class="w3-section">      
                <input id="Email" class="w3-input" name="Email" maxlength="255" size="30" required>
                <label>Email</label>
            </div>

            <div class="w3-section">   
                <p><b>Upload Resume</b></p>
                <p>You must upload a file under 10MB that is a PDF, Word DOC, JPG, or JPEG.</p>
                <input class="w3-button w3-padding-large w3-white w3-border w3-cell-middle" type="file" name="file" id="file" accept=".pdf, .docx, .jpg, .jpeg, .PNG" required></button>
                <br>
                <br>
                <button class="w3-button w3-padding-large w3-white w3-border w3-cell-middle" name="submit" id="submit" type="submit" value="Upload"><b>Submit »</b></button>
                <br>
            </div>

        </form>
    </div>
       <!-- Application Form -->
</body>
</html>    

<?php

//This script uploads the application form to the database

//Create a connection to the database
$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
$database = mysqli_select_db($connect, DB_DATABASE);

if(!empty($_FILES['file'] )) {

//Receive data from application form and assign to variables
$posted_JobInterest =($_POST['JobInterest']);
$posted_Name =($_POST['Name']);
$posted_Address =($_POST['Address']);
$posted_Email =($_POST['Email']);

//Clean data
$JobInterest = mysqli_real_escape_string($connect, $posted_JobInterest);
$Name = mysqli_real_escape_string($connect, $posted_Name);
$Address = mysqli_real_escape_string($connect, $posted_Address);
$Email = mysqli_real_escape_string($connect, $posted_Email);



$file = $_FILES['file'];

 //File properties
 $file_name = $file['name'];
 $file_tmp = $file['tmp_name'];
 $file_size = $file['size'];
 $file_error = $file['error'];

 // File extension info
 $file_ext = explode('.', $file_name);
 $file_ext = strtolower(end($file_ext));
 $allowed = array('pdf', 'docx', 'jpg', 'jpeg', 'png');

 //Upload the file if it meets the requirements
 //uploads folder MUST be writable by other!
 if(in_array($file_ext, $allowed)) {
     if($file_error === 0) {
         if($file_size <= 10000000) {

             $file_name_new = uniqid('', true) . '.' . $file_ext;
             $file_destination = 'uploads/' . $file_name_new;

             if(move_uploaded_file($file_tmp, $file_destination)) {
                 echo "<p><h3>Applicant Added</h3></p>";

               }
           } else {
            alert("ERROR! FILE IS GREATER THAN 10MB");
           }
       } else {
           alert("ERROR: THERE WAS AN ERROR UPLOADING THE FILE");
       } 
 } else {
   alert("ERROR: THE FILE TYPE IS INVALID");
 } 



 //Insert data into database
 $query = "INSERT INTO `testApplicants` (`Job_Interest` , `Name`, `Address`, `Email`, `Resume_File_Link`) VALUES ('$JobInterest' , '$Name', '$Address', '$Email', '$file_destination');";
 $result = mysqli_query($connect, $query);

}

 ?>

