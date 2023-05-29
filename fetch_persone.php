<?php 

    require_once 'auth.php';
    if (checkAuth()) exit;

    header('Content-Type: application/json');

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    $username=$_SESSION["_lovely_username"];

    $query="SELECT U2.username AS username, U2.genere AS genere, U2.sessualita AS sessualita 
            FROM (incontri I JOIN users U ON I.user1=U.username) JOIN users U2 ON I.user2=U2.username
            WHERE U.username = '".$username."'"; 
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        
    $personeArray = array();

    if(mysqli_num_rows($res)>0){
        while($entry = mysqli_fetch_assoc($res)){
            $personeArray[] = array('username' => $entry['username'], 
                                    'genere' => $entry['genere'],
                                    'sessualita' => $entry['sessualita']);
        }
         
        
    }
  
  mysqli_free_result($res);
  mysqli_close($conn);
  echo json_encode($personeArray);

?>