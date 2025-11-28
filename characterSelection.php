<?php

session_start();

require_once './config/db_config.php';
require_once './includes/functions.php';

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$uId = $_SESSION['id'];

$characters = characterPick($pdo, $uId);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wybieranie postaci</title>
    <link rel="stylesheet" href="./css/selection.css">
</head>
<body>
    <h1>Twoje postacie:</h1>

    <table>
        <tr>
            <th>Nickname</th>
            <th>Klasa</th>
            <th>Rasa</th>
            <th>Płeć</th>
            <th>Wzrost</th>
            <th>Doświadczenie</th>
            <th>Majątek</th>
        </tr>

        <?php
        
        foreach ($characters as $char) {
            echo <<<T
                <tr>
                    <td>{$char['nickname']}</td>
                    <td>{$char['class']}</td>
                    <td>{$char['race']}</td>
                    <td>{$char['gender']}</td>
                    <td>{$char['height']}</td>
                    <td>{$char['experience']}</td>
                    <td>{$char['gold_amount']}</td>
                    <td>
                        <form action="select_char.php" method="POST">
                            <input type="hidden" name="char_id" value="{$char['id']}">
                            <input type="submit" value="Wybierz">
                        </form>
                    </td>
                </tr>
            T;
        }
        
        ?>
    </table>
    
    <p><a href="./creator.php">Stwórz kolejną postać </a>albo <a href="./logout.php">Wyloguj się!</a></p>



</body>
</html>