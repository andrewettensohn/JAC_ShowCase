<?php include "../inc/dbinfo.inc"; ?>
<?php
//This script uploads the application form to the database


  //Create a connection to the database
  $connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
  $database = mysqli_select_db($connect, DB_DATABASE);

  if(!empty($_FILES['file'] )) {

    //Receive data from application form and assign to variables
    $applicant_name =($_POST['Name']);
    $applicant_address =($_POST['Address']);
    $applicant_email =($_POST['Email']);
    $JobInterest = ($_POST['JobInterest']);

    //Clean data
    $n = mysqli_real_escape_string($connect, $applicant_name);
    $a = mysqli_real_escape_string($connect, $applicant_address);
    $e = mysqli_real_escape_string($connect, $applicant_email);
    $j = mysqli_real_escape_string($connect, $JobInterest);

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
                    echo "$file_destination";

                  }
              }
          } else {
              alert("ERROR");
          } 
    } else {
      alert("ERROR");
    } 



    //Insert data into database
    $query = "INSERT INTO `testApplicants` (`Job_Interest` , `Name`, `Address`, `Email`, `Resume_File_Link`) VALUES ('$j' , '$n', '$a', '$e', '$file_destination');";
    $result = mysqli_query($connect, $query);
    
  //Send confirmation email and redirect
  $to=$_POST["Email"];
  $subject = "Application Confirmation";
  $from = "cis4910jacteam@gmail.com";
  $msg = "Hello $applicant_name! Thank you for applying for the posted position for $JobInterest. Your application will be reviewed by our hiring staff. If you have any questions please feel free to respond to this email.";
  $headers = "From: $from";
  
  mail($to,$subject,$msg,$headers);
  header('Location: applicationComplete.html');

}

?>