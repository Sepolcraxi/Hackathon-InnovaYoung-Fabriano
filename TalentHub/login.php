<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_start();
session_start();
require 'database.php'; // Connessione al database
$puppalafava = 'azienda';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['Nome_Utente'];
    $password = $_POST['current-password'];

    // Query per verificare l'utente
    $stmt = $conn->prepare("SELECT id, 	password_utente, variabile, tipologia FROM utenti WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verifica della password (con password_hash)
        if ($password === $user['password_utente']) {
            // Salva dati nella sessione
            $_SESSION['codice_utente'] = $user['id'];
            $_SESSION['variabile'] = $user['variabile'];
            $_SESSION['tipologia'] = $user['tipologia'];

            // Reindirizzamento basato sul ruolo
            if ($_SESSION['tipologia'] === $puppalafava) {
                header("Location: /homePageAziende.html");
            } elseif ($_SESSION['tipologia'] === 'scuola') {
                header("Location: /homePageScuole.html");
            } else {
                header("Location: /homePageStudenti.html");
            }
            exit();
            
        } else {
            echo "Password errata.";
        }
    } else {
        echo "Utente non trovato.";
    }
    
}
?>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TalentHub Login</title>
  <link rel="stylesheet" href="cssFolder/index.css">

  <script>
    function openPage() {
        // Verifica quale radio button è selezionato
        const aziendaSelected = document.getElementById("chkAzienda").checked;
        const scuolaSelected = document.getElementById("chkScuola").checked;

        // Redirige a una pagina diversa in base alla selezione
        if (aziendaSelected) {
            window.location.href = "homePageAziende.html"; // Pagina per "Azienda"
        } else if(scuolaSelected){
            window.location.href = "homePageScuole.html"; // Pagina per "Scuola"
        }else{
            window.location.href = "homePageStudenti.html"; // Pagina per "Studente"
        }

    }
    

</script>

</head>
<body>
  <div class="container">
    <div class="login-box">
        <div id="left-part">
            <h1 class="title">TalentHub</h1>
            <p class="subtitle">Accedi</p>
        </div>
        <div id="right-part">

            <h4 id="options-title">Chi Sei?</h4>

            <div class="options">

                <div id="azienda">
                    <label><input type="radio" id="chkAzienda" name="user-type" checked> Azienda</label>
                </div>

                <div id="scuola">
                    <label><input type="radio" id="chkScuola" name="user-type"> Scuola</label>
                </div>

                <div id="studente">
                    <label><input type="radio" id="chkStudente" name="user-type"> Studente</label>
                </div>

            </div>

              <form action="login.php" method="POST">
     <input type="text" placeholder="Nome utente" class="input-field" name="Nome_Utente" required autocomplete="Nome_Utente">

    <a href="#" class="link">Non ricordi l'username?</a>

    <input type="password" placeholder="Password" class="input-field" name="current-password" required autocomplete="current-password">

    <a href="#" class="link">Non ricordi la password?</a>

    <div class="actions">
        <a href="creaAccount.html" class="create-account">Crea un account</a>
        <button type="submit" class="button-submit">Avanti</button>
    </div>
</form>
        </div>
      
    </div>
  </div>
</body>
</html>





