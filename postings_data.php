<?php include "../inc/dbinfo.inc"; ?>
<?php
//Retrieve all data from the testPostingsPages table, put in array for use in postings.html
$postingId = $_POST['postingId'];

 $connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
 $database = mysqli_select_db($connect, DB_DATABASE);
 $query = "SELECT * FROM testPostingPages WHERE ID='$postingId';";
 $result = mysqli_query($connect, $query);
 while($row = mysqli_fetch_assoc($result)) {

    $data = $row;

 }

 echo json_encode($data);

?>
