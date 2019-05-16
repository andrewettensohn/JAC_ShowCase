<?php  session_start(); ?>
<?php include "../inc/dbinfo.inc"; ?>

<?php
// This script checks the username and password from adminLogin.html



// If a session exists then redirect user to admin dashboard

if(isset($_SESSION['use'])) { 
                              
    header("Location: adminDashboard.php"); 
 }

// Check if username and password match entries in the database

if(isset($_POST['usernameField']) && isset($_POST['passwordField'])) {

$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

$database = mysqli_select_db($connect, DB_DATABASE);


    $enteredAdminUsername =($_POST['usernameField']);
    $enteredAdminPassowrd =($_POST['passwordField']);

    $adminUsername = mysqli_real_escape_string($connect, $enteredAdminUsername);
    $adminPassword = mysqli_real_escape_string($connect, $enteredAdminPassowrd);

    $query = "SELECT * FROM `users` WHERE username='$adminUsername' AND password='$adminPassword';";
    $result = mysqli_query($connect, $query);

    // If the query for the username and password return 0 rows then the login failed
    // If rows are returned then begin a session for the user and redirect to admin dashboard 
    if (mysqli_num_rows($result) !== 0) {

        $_SESSION['use']=$adminUsername;

        header('Location: adminDashboard.php');

    } else {
        echo "Username or password incorrect!";
    }

}
?>