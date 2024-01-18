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

    $user = getUser($_SESSION['id'], $connection);
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Profile</title>
        <!-- Boostrap CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    </head>
    <body>
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Site</a>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="user.php">My Profile</a>
                    </li>
                </ul>
                <span class="navbar-text me-3">
                    Welcome
                    <span class="fw-bold"><?php echo $_SESSION["name"]; ?></span>
                </span>
                <a href="logout.php">
                <button class="btn btn-outline-secondary">Log out</button>
                </a>
            </div>
        </nav>

        <main>
            <div class="container mt-5">
                <div class="row">
                    <dic class="col-12">
                        <div class="card">
                            <div class="card-header">
                                My Profile
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <span class="fw-bold">Name: </span> <span><?php echo $user['name']; ?></span>
                                </div>
                                <div class="mb-3">
                                    <span class="fw-bold">Surname: </span> <span><?php echo $user['surname']; ?></span>
                                </div>
                                <div class="mb-3">
                                    <span class="fw-bold">Email: </span> <span><?php echo $user['email']; ?></span>
                                </div>
                                <div class="mb-3">
                                    <span class="fw-bold">Password: </span> <span>********</span>
                                </div>
                                <div class="mb-3">
                                    <a href="changePsw.php">
                                        <button class="btn btn-primary">Change Password</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </dic>
                </div>
            </div>
        </main>
    </body>
</html>