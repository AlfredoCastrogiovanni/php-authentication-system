<?php
    require_once __DIR__ . '//functions.php';

    if (session_status() === PHP_SESSION_NONE){
        session_start();
    }

    define('DB_ADDRESS', 'localhost:3306');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'my_db');

    $connection = new mysqli(DB_ADDRESS, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ( $connection && $connection->connect_error){
        var_dump("Failed connection with the database, with error $connection->connect_error" );
    }

    if (isset($_GET['name']) && isset($_GET['surname']) && isset($_GET['email']) && isset($_GET['password'])){
        register($_GET['name'], $_GET['surname'], $_GET['email'], $_GET['password'], $connection);
    }

    $connection->close();
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <!-- Boostrap CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    </head>
    <body>
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand me-auto" href="index.php">Site</a>
                <a href="login.php">
                    <button class="btn btn-outline-success me-2">Login</button>
                </a>
            </div>
        </nav>

        <main>
            <div class="container mt-5">
                <form class="row g-3" action="register.php">
                    <div class="col-12">
                        <h1 class="text-center">Register</h1>
                    </div>
                    <div class="col-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="col-12">
                        <label for="surname" class="form-label">Surname</label>
                        <input type="text" class="form-control" name="surname" id="surname">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </div>
                </form>
            </div>
        </main>
    </body>
</html>