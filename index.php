<?php

    session_start();
    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        header('Location: characterSelection.php');
        exit();
    }

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Witaj w kreatorze postaci!</title>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <header>
        <h1>Witaj w Kreatorze Postaci RPG!</h1>
    </header>

    <main>
        <h2>Co chcesz zrobić?</h2>
        
        <div class="options">
            
            <a href="login.php">
                <button>Zaloguj się</button>
            </a>
            
            <p>Masz już konto? Kontynuuj swoją przygodę!</p>

            <hr>
            
            <a href="register.php">
                <button>Zarejestruj nowe konto</button>
            </a>
            <p>Zacznij od nowa! Rejestracja jest szybka i bezpieczna.</p>
        </div>
        
    </main>

    <footer>
        <p>&copy; 2024 Kreator Postaci</p>
    </footer>
    
</body>
</html>
</body>
</html>