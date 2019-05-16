<?php include "../inc/dbinfo.inc"; ?>
<?php
//get everything from the testJobs table and put it into an array for use in jobSearch.html

 $connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
 $database = mysqli_select_db($connect, DB_DATABASE);
 $query = "SELECT * FROM testJobs";
 $result = mysqli_query($connect, $query);
 while($row = mysqli_fetch_assoc($result))
 {
    $data[] = $row;

 }

 echo json_encode($data);

?>
