<?php

session_start();

require_once "./config/db_config.php";
require_once "./includes/functions.php";

$msg = '';
$ageRequired = date('Y-m-d', strtotime('-18 years'));


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = trim($_POST['email'] ?? '');
    $pass1 = trim($_POST['pass1'] ?? '');
    $pass2 = trim($_POST['pass2'] ?? '');
    $age = ($_POST['age'] ?? '');

    if (empty($email) || empty($pass1) || empty($pass2) || empty($age)) {
        $msg = "<p style = 'color: red; font-size: 15px;'>Wypełnij wszystkie pola!</p>"; 
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = "<p style = 'color: red; font-size: 15px;'>Niepoprawny format adresu email!</p>";
    } else if ($pass1 !== $pass2) {
        $msg = "<p style = 'color: red; font-size: 15px;'>Hasła muszą być jednakowe!</p>";
    } else if (strlen($pass1) < 8) {
        $msg = "<p style = 'color: red; font-size: 15px;'>Hasło musi mieć conajmniej 8 znaków</p>";
    } else if ($age > $ageRequired) {
        $msg = "<p style = 'color: red; font-size: 15px;'>Musisz mieć conajmniej 18 lat!</p>";
    } else {
        try {
            $role = ($email === 'admin@gantasy.com') ? 'admin' : 'user';
            
            registerUser($pdo, $email, $pass1, $age, $role);

            header('Location: successfulReg.html?success=1');
            exit();

        } catch (\PDOException $e) {
            if ($e -> getCode() == '23000') {
                $msg = "<p style = 'color: red; font-size: 15px;'>Konto z takim adresem email już istnieje!</p>";
            } else {
                $msg = "<p style = 'color: red; font-size: 15px;'>Wystąpił błąd ze strony serwera. Spróbuj ponownie później!</p>";
            }
        }
    }


}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona rejestracji</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <h1>Formularz rejestracji</h1>

    <form action="" method="post" novalidate>
        <div class="input-group">
            <label for="email">Podaj swój email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="input-group">
            <label for="pass1">Wpisz hasło do twojego nowego konta</label>
            <input type="password" name="pass1" id="pass1" required>
        </div>
        <div class="input-group">
            <label for="pass2">Wpisz ponownie hasło</label>
            <input type="password" name="pass2" id="pass2" required>
        </div>
        <div class="input-group">
            <label for="age">Wybierz swoją datę urodzenia</label>
            <input type="date" name="age" id="age" required>
        </div>
        
        <?php
        if (!empty($msg)) {
            echo $msg;
        }
        ?>
        
        <input type="submit" value="Zarejestruj się">
    </form>

    <p>Masz już konto? <a href="./login.php">Zaloguj się!</a></p>

    <p>
        <a href="index.php">Powrót do strony głównej</a>
    </p>
</body>
</html> 