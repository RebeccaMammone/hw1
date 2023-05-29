
<?php 
    require_once 'auth.php';
    if (checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>

  <?php
      $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
      $username=$_SESSION["_lovely_username"];
      $query = "SELECT * FROM users WHERE username = '".$username."'";
      $res_1 = mysqli_query($conn, $query);
      $userinfo = mysqli_fetch_assoc($res_1);

  ?>



  <head>
  <meta charset="UTF-8">
    <title>Lovely - <?php echo strtoupper($userinfo['username']) ?> </title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@500&display=swap" rel="stylesheet">
    <link rel="icon" type="image/ico" href="immagini/favicon.ico">
    <link rel="stylesheet" href="profilo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <script src="profilo.js" defer="true"></script>
  </head>
  
  <body>
    <header>
      <nav>
        <div id="logo">
          <img id=icona src="./immagini/icona.jpg">
          <h1>Lovely</h1>
        </div>
        <div id="links">
          <a class="uno" href='home.php'>HOME</a>
          <a class="uno" href='cerca_persone.php'>CERCA PERSONE</a>
          <a>CHI SIAMO</a>
          <a>CONTATTI</a>
          <a href='logout.php' class='button'>LOGOUT</a>
          
        </div>
        <div id="menu">
          <div></div>
          <div></div>
          <div></div>
        </div>
      </nav>
      <div id="pagina">
      <section>
        <div id="contenitore">
          <div id="profilo">
            <img id="utente" src="./immagini/utente.jpg">
            <div id="info">
              <div id="username"><?php echo strtoupper($userinfo['username']) ?></div>
              <div id="genere"><?php echo strtoupper($userinfo['genere']) ?></div>
              <div id="sessualita"><?php echo strtoupper($userinfo['sessualita']) ?></div>
            </div>
          </div>
        </div> 
        <h1> Persone Matchate: </h1> 
        <div id="no">Ancora nessun match </div> 
      </section>
      
      <div id=risultato>
        
      </div>

    <footer>
      <div>Rebecca Mammone </div>
      <div> 1000002849 </div>
    </footer>
      </div>
  </body>
  </html>