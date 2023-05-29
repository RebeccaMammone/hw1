<?php

require_once 'auth.php';
if (checkAuth()) exit;

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
$username=$_SESSION["_lovely_username"];

if(isset($_GET['q'])){
    $q=mysqli_real_escape_string($conn, $_GET['q']);
    $query="SELECT * FROM incontri WHERE user1 = '".$username."' AND user2 = '".$q."'";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if(mysqli_num_rows($res)>0){
        echo json_encode(array('ok' => true,
                                'user2' => $q));
    
    }
     else{
        echo json_encode(array('ok' => false,
                               'user2' => $q));
     }
}

mysqli_close($conn);

?>