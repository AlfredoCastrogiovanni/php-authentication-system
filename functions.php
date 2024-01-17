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