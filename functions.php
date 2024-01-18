<?php

function login($email, $password, $connection) {
    if (session_status() === PHP_SESSION_NONE){
        session_start();
    }

    $parametricQuery = $connection->prepare("SELECT * FROM `users` WHERE `email` = ? AND `psw` = ?;");
    $parametricQuery->bind_param('ss', $email, $password);
    $parametricQuery->execute();
    $results = $parametricQuery->get_result();

    if ($results->num_rows > 0) {
        $row = $results->fetch_assoc();
        var_dump($row);
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        header("Location: ./index.php");
    } else {
        echo "Wrong credentials";
    }
}

function register($name, $surname, $email, $password, $connection) {
    if (session_status() === PHP_SESSION_NONE){
        session_start();
    }

    $parametricQuery = $connection->prepare("INSERT INTO users (name, surname, email, psw) VALUES (?, ?, ?, ?)");
    $parametricQuery->bind_param('ssss', $name, $surname, $email, $password);

    if(!$parametricQuery->execute()) {
        echo 'error';
    }

    header("Location: ./login.php");
}

function getUser($id, $connection) {
    $parametricQuery = $connection->prepare("SELECT * FROM `users` WHERE `id` = ?;");
    $parametricQuery->bind_param('s', $id);
    $parametricQuery->execute();
    $results = $parametricQuery->get_result();

    return $results->fetch_assoc();
}

function changePsw($id, $oldPsw, $newPsw, $connection) {
    if (session_status() === PHP_SESSION_NONE){
        session_start();
    }

    $parametricQuery = $connection->prepare("SELECT * FROM `users` WHERE `id` = ? AND `psw` = ?;");
    $parametricQuery->bind_param('ss', $id, $oldPsw);
    $parametricQuery->execute();
    $results = $parametricQuery->get_result();

    if ($results->num_rows > 0) {
        $parametricQuery = $connection->prepare("UPDATE `users` SET `psw`= ? WHERE `id`= ?;");
        $parametricQuery->bind_param('si', $newPsw, $id);
        header("Location: ./user.php");
    } else {
        echo "Wrong Password";
    }

}