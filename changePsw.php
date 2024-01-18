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

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Change Password</title>
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
            </div>
        </nav>

        <main>
            <div class="container mt-5">
                <form class="row g-3" action="changePsw.php" method="POST">
                    <div class="col-12">
                        <h1 class="text-center">Change Password</h1>
                    </div>
                    <div class="col-12">
                        <label for="password" class="form-label">Old Pasword</label>
                        <input type="password" class="form-control" name="oldPsw" id="oldPsw">
                    </div>
                    <div class="col-12">
                    <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" name="newPsw" id="newPsw">
                        <div class="form-text text-danger">
                            <?php 
                                if (isset($_POST['oldPsw']) && isset($_POST['newPsw'])){
                                    changePsw($_SESSION['id'], $_POST['oldPsw'], $_POST['newPsw'], $connection);
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                </form>
            </div>
        </main>
    </body>
</html>

<?php $connection->close(); ?>