<?php

session_start();

require_once "./config/db_config.php";
require_once "./includes/functions.php";

$msg = '';

//if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
//   header("Location: creator.php");
//    exit();
//}   

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email'] ?? '');
    $pass = trim($_POST['pass'] ?? '');

    if (empty($email) || empty($pass)) {
        $msg = "Wypełnij wszystkie pola! ";
    } else {
        try {
            $user = loginUser($pdo, $email, $pass);
            if ($user) {
                $_SESSION['logged_in'] = true;
                $_SESSION['id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                if (characterCheck($pdo, $user['id'])) {
                    header('Location: characterSelection.php');
                } else {
                    header('Location: creator.php');
                }
                exit();

            } else {
                $msg = "Użytkownik z takim adres email lub hasłem nie istnieje! ";
            }
        } catch (\PDOException $e) {
            $msg = "Błąd serwera! Spróbuj ponownie później!";
        }
    }
    
}






?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona logowania</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <h1>Formularz logowania</h1>
    <form action="" method="post">
        <div class="input-group">
            <label for="email">Podaj swój email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="input-group">
            <label for="pass">Podaj swoje hasło</label>
            <input type="password" name="pass" id="pass" required>
        </div>  
        <?php
            if (!empty($msg)) {
                echo "<p style = 'color: red;'>" . $msg . "</p> ";
            }
        ?>

        <input type="submit" value="Zaloguj się">
    </form>

    <p>Nie masz jeszcze konta? <a href="./register.php">Zarejestruj się!</a></p>
    

    
</body>
</html>