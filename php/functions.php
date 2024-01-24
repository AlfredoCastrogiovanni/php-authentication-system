<?php

function login($email, $password, $connection) {
    if (session_status() === PHP_SESSION_NONE){
        session_start();
    }

    $parametricQuery = $connection->prepare("SELECT * FROM `users` WHERE `email` = ?");
    $parametricQuery->bind_param('s', $email);
    $parametricQuery->execute();
    $results = $parametricQuery->get_result();

    if ($results->num_rows > 0) {
        $row = $results->fetch_assoc();

        if(password_verify($password, $row['psw'])) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            header("Location: ../index.php");
        }
    }
    echo "Wrong credentials";
}

function register($name, $surname, $email, $password, $connection) {
    if (session_status() === PHP_SESSION_NONE){
        session_start();
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $parametricQuery = $connection->prepare("INSERT INTO users (name, surname, email, psw) VALUES (?, ?, ?, ?)");
    $parametricQuery->bind_param('ssss', $name, $surname, $email, $hash);

    if(!$parametricQuery->execute()) {
        echo 'error';
    }

    header("Location: ./login.php");
}

function getUser($id, $connection) {
    $parametricQuery = $connection->prepare("SELECT * FROM `users` WHERE `id` = ?;");
    $parametricQuery->bind_param('i', $id);
    $parametricQuery->execute();
    $results = $parametricQuery->get_result();

    return $results->fetch_assoc();
}

function changePsw($id, $oldPsw, $newPsw, $connection) {
    if (session_status() === PHP_SESSION_NONE){
        session_start();
    }

    $parametricQuery = $connection->prepare("SELECT * FROM `users` WHERE `id` = ? AND `psw` = ?;");
    $parametricQuery->bind_param('is', $id, $oldPsw);
    $parametricQuery->execute();
    $results = $parametricQuery->get_result();

    if ($results->num_rows > 0) {
        $parametricQuery = $connection->prepare("UPDATE `users` SET `psw` = ? WHERE `id` = ?;");
        $parametricQuery->bind_param('si', $newPsw, $id);
        $parametricQuery->execute();
        header("Location: ./user.php");
    } else {
        echo "Wrong Password";
    }
}

function randomStars() {
    $starsNumber = rand(5, 10);
    $stars = '';
    for($i=0; $i < $starsNumber; $i++) {
        $stars .= '*';
    }
    return $stars;
}