<?php
    require_once 'auth.php';

    if (checkAuth()) {
        header("Location: home.php");
        exit;
    }
    

    // Verifica l'esistenza di dati POST
    if(!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["genere"]) && !empty($_POST["sessualita"]) && !empty($_POST["password"]) && !empty($_POST["confirm_password"]) && !empty($_POST["allow"])) 
    {
        $error = array();
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

        
        # USERNAME
        // Controlla che l'username rispetti il pattern specificato
        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])) {
            $error[] = "Username non valido";
        } else {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            // Cerco se l'username esiste già o se appartiene a una delle 3 parole chiave indicate
            $query = "SELECT username FROM users WHERE username = '$username'";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Username già utilizzato";
            }
        }
        # PASSWORD
        if (strlen($_POST["password"]) < 8) {
            $error[] = "Caratteri password insufficienti";
        } 
        # CONFERMA PASSWORD
        if (strcmp($_POST["password"], $_POST["confirm_password"]) != 0) {
            $error[] = "Le password non coincidono";
        }
        # EMAIL
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        } else {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Email già utilizzata";
            }
        }

        # REGISTRAZIONE NEL DATABASE
        if (count($error) == 0) {

            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT);
            $genere = mysqli_real_escape_string($conn, $_POST['genere']);
            $sessualita = mysqli_real_escape_string($conn, $_POST['sessualita']);

            $query = "INSERT INTO users(username, password, email, genere, sessualita) VALUES('$username', '$password', '$email', '$genere', '$sessualita')";
            
            if (mysqli_query($conn, $query)) {
                $_SESSION["_lovely_username"] = $_POST["username"];  
                $_SESSION["_lovely_user_id"] = mysqli_insert_id($conn);
                mysqli_close($conn);
                header("Location: home.php");
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
        }
        mysqli_close($conn);
    }
    else if (isset($_POST["username"])) {
        $error = array("Riempi tutti i campi");
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lovely - Signup</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <script src='signup.js' defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Boogaloo&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@500&display=swap" rel="stylesheet">
    <link rel="icon" type="image/ico" href="immagini/favicon.ico">
    
</head>
    <body>
        <div id="logo">
            <img src="./immagini/icona.jpg">
            <h1>Lovely</h1>
        </div>

        <section> 
        
        <div class="container">
            <div class="verde">
                <h2>Bentornato!</h2>
                <h3>Accedi con il tuo account personale.</h3>
                <a href="login.php">Accedi</a>
            </div>

        <div class="bianco">
            <h2>Crea un Account</h2>
            <form name='signup' method='post' enctype="multipart/form-data" autocomplete="off">
        
                <div class="username">
                    <label for='username'>Username</label>
                    <input type='text' name='username' id="username" autocomplete="off" <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>>
                    <span> Nome utente non disponibile </span>
                </div>
                <div class="email">
                    <label for='email'>Email</label>
                    <input type='text' name='email' id="email" autocomplete="off" <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>>
                    <span> Indirizzo email non valido </span>
                </div>
                <div class="genere">
                    <label for='genere'>Genere</label>
                    <input type='text' name='genere' id="genere" <?php if(isset($_POST["genere"])){echo "value=".$_POST["genere"];} ?>>
                    <span> Devi inserire la tua identità di genere </span>
                </div>
                <div class="sessualita">
                    <label for='sessualita'>Sessualità</label>
                    <input type='text' name='sessualita' id="sessualita"<?php if(isset($_POST["sessualita"])){echo "value=".$_POST["sessualita"];} ?>>
                    <span> Devi inserire la tua sessualità </span>
                </div>
                <div class="password">
                    <label for='password'>Password</label>
                    <input type='password' name='password' id="password" <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>>
                    <span> Inserisci almeno 8 caratteri </span>
                </div>
                <div class="confirm_password">
                    <label for='confirm_password'>Conferma Password</label>
                    <input type='password' name='confirm_password' id="confirm_password" <?php if(isset($_POST["confirm_password"])){echo "value=".$_POST["confirm_password"];} ?>>
                    <span> Le password non coincidono </span>
                </div>
                <div class="allow"> 
                    <input type='checkbox' name='allow' value="1" id="allow" <?php if(isset($_POST["allow"])){echo $_POST["allow"] ? "checked" : "";} ?>>
                    <label for='allow'>Accetto i termini e condizioni d'uso di Lovely.</label>
                </div>

                <?php if(isset($error)) {
                    foreach($error as $err) {
                        echo "<div class='errorj'><span>".$err."</span></div>";
                    }
                } ?>

                <div class="submit">
                    <input type='submit' value="Registrati" id="submit">
                </div>

            </form>
        </div>
        

    </section>
    
    </body>
</html>