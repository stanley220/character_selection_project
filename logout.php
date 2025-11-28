<?php
session_start();
session_unset();     // Usuwa zmienne sesji
session_destroy();   // Niszczy całą sesję
header('Location: login.php'); // Przekierowanie na stronę logowania
exit();
?>