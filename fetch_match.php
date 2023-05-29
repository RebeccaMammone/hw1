<?php

require_once 'auth.php';
if (checkAuth()) exit;

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
$username=$_SESSION["_lovely_username"];

if(isset($_GET['q'])){
    $q=mysqli_real_escape_string($conn, $_GET['q']);
    $query="SELECT * FROM incontri WHERE user1 = '".$username."' AND user2 = '".$q."'";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if(mysqli_num_rows($res)==0){
        $query1="INSERT INTO incontri (user1, user2) VALUES ('".$username."','".$q."')";
        $res1=mysqli_query($conn, $query1) or die(mysqli_error($conn));
        echo json_encode(array('ok'=>true));
    
    }
     else{
        $query2="DELETE FROM incontri WHERE user1 = '".$username."' AND user2 = '".$q."'";
        $res2=mysqli_query($conn, $query2) or die(mysqli_error($conn));
        echo json_encode(array('ok'=>false));
     }
}

mysqli_close($conn);

?>