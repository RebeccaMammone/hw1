<?php 
    require_once 'auth.php';
    if (checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>

  <head>
  <meta charset="UTF-8">
    <title>Lovely - Cerca Persone</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@500&display=swap" rel="stylesheet">
    <link rel="icon" type="image/ico" href="immagini/favicon.ico">
    <link rel="stylesheet" href="cerca_persone.css">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <script src="cerca_persone.js" defer="true"></script>
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
          <a href='profilo.php'><img id="utente" src="./immagini/utente.jpg"></a>
          
        </div>
        <div id="menu">
          <div></div>
          <div></div>
          <div></div>
        </div>
      </nav>
    </header>  

    <div id="pagina">
      <section>
      <form>
        <div id="cerca">
          <form name='cerca' autocomplete="off">
          <h1>Cerca una persona </h1>
          <span>Scrivi lo username della persona che vuoi cercare oppure scrivi "tutti" per visualizzare tutti gli utenti</span>
          <div id="cerc">
            <div id="barra">
              <img id="lente" src="./immagini/cerca.png">
              <input type="text" name="search" id="persona" placeholder="Cerca una persona..." required>
            </div>
            <input type="submit" id="submit" value="INVIA">
          </div>
          <form>
        </div>
      </form>
      </section>

      <div id='errore' class='hidden'>
            <p> Nessun risultato </p>
      </div>

      
        <div id="risultato">
          
        </div>
        

      <footer>
        <div>Rebecca Mammone </div>
        <div> 1000002849 </div>
      </footer>
    </div>
  </body>
  </html>