    <?php


    session_start();
    require "./config/db_config.php";
    require_once "./includes/functions.php";

    if(!isset($_SESSION['id'])) {
        header('Location: login.php');
    }

    $uId = $_SESSION['id'];
    $msg = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nickname = htmlspecialchars(trim($_POST['nickname'] ?? ''));    
        $class = htmlspecialchars($_POST['class'] ?? '');    
        $race = htmlspecialchars($_POST['race'] ?? '');    
        $gender = htmlspecialchars($_POST['gender'] ?? '');    
        $height = intval(htmlspecialchars($_POST['height'] ?? 0))   ;
        
        if (empty($nickname) || empty($class) || empty($race) || empty($gender) || empty($height)) {
            $msg = "<p style='color: red;'> Uzupełnij pola poprawnie! ";    
        }
        else {
            $character_data = [
                'nickname' => $nickname,
                'class'    => $class,
                'race'     => $race,
                'gender'   => $gender,
                'height'   => $height
            ];
            
            try {
                saveCharacter($pdo, $character_data, $uId);
                $msg = "<p style='color: green;'> Postać **$nickname** zapisana w bazie!</p>";
                header('Location: characterSelection.php');
                exit();

            } catch (\PDOException $e) {
                if($e->getCode()==23000) {
                    $msg = "<p style='color: red;'> Istnieje już użytkownik o podanej nazwie!";
                }else {
                    $msg = "<p style='color: red;'>Wystąpił błąd serwera. (" . $e->getMessage() . ")</p>";
                }
                
            }
        }
    }

    ?>

    <!DOCTYPE html>
    <html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kreator Postaci Gry</title>
        <link rel="stylesheet" href="./css/test.css">
        </style>
    </head>
    <body>
        
        <h1>Kreator postaci</h1>
        <h2>Uzupełnij informacje o twojej postaci</h2>
        
        <form action="" method="post">
            
            <label for="nickname">Nickname postaci:</label>
            <input type="text" id="nickname" name="nickname" required>
            
            <label for="class">Klasa postaci:</label>
            <select name="class" id="class" required>
                <option value="">-- Wybierz klasę --</option>
                <option value="knight">Rycerz</option>
                <option value="mage">Mag</option>
                <option value="priest">Kapłan</option>
                <option value="archer">Łucznik</option>
                <option value="axeman">Topornik</option>
            </select>
            
            <label for="race">Rasa:</label>
            <select name="race" id="race" required>
                <option value="">-- Wybierz rasę --</option>
                <option value="human">Człowiek</option>
                <option value="elf">Elf</option>
                <option value="dwarf">Krasnolud</option>
            </select>
            
            <label for="gender">Płeć:</label>
            <select name="gender" id="gender" required>
                <option value="">-- Wybierz płeć --</option>
                <option value="male">Mężczyzna</option>
                <option value="female">Kobieta</option>
                <option value="other">Inne</option>
            </select>
            
            <label for="heightInput">Wzrost (w cm): <span id="heightValue">175 cm</span></label>
            
            <input type="range" id="heightInput" name="height" min="100" max="250" value="175" oninput="heightUpdate(this.value)">  
            
            <?php
                if (!empty($msg)) {
                    echo $msg;
                }
            ?>

            <input type="submit" value="Utwórz Postać">

        </form>
        
        <script src="./scripts/scripts.js"></script>
        
    </body>
    </html>