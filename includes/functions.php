<?php

function saveCharacter($pdo, $data, $uId) {
    $sql = "INSERT INTO characters (uId, nickname, class, race, gender, height, experience, gold_amount)
            VALUES (:uId, :nick, :class, :race, :gender, :height, :exp, :gold)";

    $stmt = $pdo -> prepare($sql);

    return $stmt -> execute([
        'uId' => $uId,
        'nick' => $data['nickname'],
        'class' => $data['class'],
        'race' => $data['race'],
        'gender' => $data['gender'],
        'height' => $data['height'],
        'exp' => 0,
        'gold' => 0
    ]);

}

function registerUser($pdo, $email, $pass, $age, $role = 'user') {
    $passHash = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "INSERT INTO `users`(`email`, `pass_hash`, `role`, `age`) 
            VALUES (:email, :passH, :role, :age)";
    
    $stmt = $pdo -> prepare($sql);

    return $stmt -> execute([
        'email' => $email,
        'passH' => $passHash,
        'role' => $role,
        'age' => $age
    ]);
}

function loginUser($pdo, $email, $pass) {
    $sql = "SELECT * FROM users WHERE `email` = :email";
    $stmt = $pdo -> prepare($sql);
    $stmt -> execute(['email' => $email]);
    $user = $stmt->fetch();

    if (empty($user)) {
        return false;
    }

    if (password_verify($pass, $user['pass_hash'])) {
        return [
            'id' => $user['id'],
            'role' => $user['role']
        ];
    }


}

function characterCheck($pdo, $uId) {
    $sql = "SELECT COUNT(*) FROM characters WHERE `uId` = :id ";
    $stmt = $pdo -> prepare($sql);
    $stmt -> execute(['id' => $uId]);
    return $stmt -> fetchColumn() > 0;
}

function characterPick($pdo, $uId) {
    $sql = "SELECT * FROM characters WHERE `uId` = :id";
    $stmt = $pdo -> prepare($sql);
    $stmt -> execute(['id' => $uId]);
    return $stmt -> fetchAll();
}


?>