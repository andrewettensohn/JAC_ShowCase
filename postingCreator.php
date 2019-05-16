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

<div class="w3-center">
<h1 >Application Center Admin</h1>
</div>

<body class="w3-light-grey">

  <!-- Div for Formatting -->
  <div class="w3-quarter">
        <p></p>
    </div>
    <!-- Div for Formatting -->

    
    <!-- Application Form -->
    <div class="w3-container w3-padding-32 w3-half">
        <form form action="" method="post" enctype="multipart/form-data" class="w3-container w3-card-4" id="appForm">
            <h2>Add a New Job Posting</h2>

            <div class="w3-section">      
                <input type="text" id="JobTitle" class="w3-input" name="JobTitle" maxlength="50" size="30" required>
                <label>Job Title</label>
            </div>

            <div class="w3-section">      
                <select class="w3-select" id="Category" name="Category" required>
                    <option value="Information Technology">Information Technology</option>
                    <option value="Sales">Sales</option>
                    <option value="Advertising">Advertising</option>
                    <option value="Human Resources">Human Resources</option>
                </select>
            <label>Category</label>
            </div>

            <div class="w3-section">      
                <input type="text" id="Location" class="w3-input" name="Location" maxlength="50" size="30" required>
                <label>Job Location</label>
            </div>

            <div class="w3-section">      
                <textarea id="Details" class="w3-input" name="Details" maxlength="1000" size="255" required></textarea>
                <label>Job Details</label>
            </div>

            <div class="w3-section">      
                <input class="w3-button w3-padding-large w3-white w3-border w3-cell-middle" type="file" name="file" id="file" accept=".pdf, .docx, .jpg, .jpeg, .PNG" required></button>
                <label>Job Image</label>
            </div>

            <div class="w3-section">      
                <textarea id="WhatWeDo" class="w3-input" name="WhatWeDo" maxlength="1000" size="255" required></textarea>
                <label>What We Do Section</label>
            </div>

            <div class="w3-section">      
                <textarea id="WhatWeNeedFromYou" class="w3-input" name="WhatWeNeedFromYou" maxlength="1000" size="255" required></textarea>
                <label>What We Need From You Section</label>
            </div>

            <div class="w3-section">      
                <textarea id="WhyUs" class="w3-input" name="WhyUs" maxlength="255" size="1000" required></textarea>
                <label>Why Us Section</label>
             </div>
        
            <button class="w3-button w3-padding-large w3-white w3-border w3-cell-middle" name="submit" id="submit" type="submit" value="Upload"><b>Submit »</b></button>

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

//if(!empty($_POST["Name"]) && $_POST['Address'] && ($_POST['Email'] && $_FILES['file']) {

if(!empty($_FILES['file'] )) {

//Receive data from application form and assign to variables
$posted_JobTitle =($_POST['JobTitle']);
$posted_Category =($_POST['Category']);
$posted_Location =($_POST['Location']);

$posted_Details =($_POST['Details']);
$posted_WhatWeDo =($_POST['WhatWeDo']);
$posted_WhatWeNeedFromYou = ($_POST['WhatWeNeedFromYou']);
$posted_WhyUs = ($_POST['WhyUs']);

//Clean data
$JobTitle = mysqli_real_escape_string($connect, $posted_JobTitle);
$Category = mysqli_real_escape_string($connect, $posted_Category);
$Location = mysqli_real_escape_string($connect, $posted_Location);

$Details = mysqli_real_escape_string($connect, $posted_Details);
$WhatWeDo = mysqli_real_escape_string($connect, $posted_WhatWeDo);
$WhatWeNeedFromYou = mysqli_real_escape_string($connect, $posted_WhatWeNeedFromYou);
$WhyUs = mysqli_real_escape_string($connect, $posted_WhyUs);

$file = $_FILES['file'];

//File properties
$file_name = $file['name'];
$file_tmp = $file['tmp_name'];
$file_size = $file['size'];
$file_error = $file['error'];

// File extension info
$file_ext = explode('.', $file_name);
$file_ext = strtolower(end($file_ext));
$allowed = array('jpg', 'jpeg', 'png');

//Upload the file if it meets the requirements
//uploads folder MUST be writable by other!
if(in_array($file_ext, $allowed)) {
    if($file_error === 0) {
        if($file_size <= 10000000) {

            $file_name_new = uniqid('', true) . '.' . $file_ext;
            $file_destination = 'images/' . $file_name_new;

            if(move_uploaded_file($file_tmp, $file_destination)) {
                echo $file_destination;

            }
        }
    } else
    echo "ERROR";
    }

 //Insert data into database
 $query = "INSERT INTO `testJobs` (`JobTitle` , `Category`, `Location`) 
 VALUES ('$JobTitle' , '$Category', '$Location');";

 $result = mysqli_query($connect, $query);

  //Insert data into database
  $query = "INSERT INTO `testPostingPages` (`Details` , `ImageSrc`, `JobTitle`, `WhatWeDo`, `WhatWeNeedFromYou` , `WhyUs`) 
  VALUES ('$Details' , '$file_destination', '$JobTitle', '$WhatWeDo', '$WhatWeNeedFromYou' , '$WhyUs');";

  $result = mysqli_query($connect, $query);

  header('Location: jobSearch.html');
}

?>