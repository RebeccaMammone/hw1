<?php

require_once 'auth.php';
if (checkAuth()) exit;

header('Content-Type: application/json');

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
$username=$_SESSION["_lovely_username"];

if(isset($_GET['q'])){
      $q=mysqli_real_escape_string($conn, $_GET['q']);
      if($q=="tutti"){
            $query="SELECT * FROM users WHERE username != '".$username."'";
      }
       else 
            $query="SELECT * FROM users WHERE username = '".$q."' AND username != '".$username."'";
}

$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

while($row = mysqli_fetch_assoc($res)){
      $users[] = $row;
}

mysqli_free_result($res);
mysqli_close($conn);
echo json_encode($users);

?>