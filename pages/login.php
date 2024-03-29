<?php
    require_once __DIR__ . '/../php/functions.php';
    require_once __DIR__ . '/../php/costants.php';

    if (session_status() === PHP_SESSION_NONE){
        session_start();
    }

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
        <title>Login</title>
        <!-- Boostrap CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    </head>
    <body>
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand me-auto" href="../index.php">Site</a>
                <a href="register.php">
                    <button class="btn btn-outline-warning">Register</button>
                </a>
            </div>
        </nav>

        <main>
            <div class="container mt-5">
                <form class="row g-3" action="login.php" method="POST">
                    <div class="col-12">
                        <h1 class="text-center">Login</h1>
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="col-12">
                    <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                        <div class="form-text text-danger">
                            <?php 
                                if (isset($_POST['email']) && isset($_POST['password'])){
                                    login($_POST['email'], $_POST['password'], $connection);
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </div>
                </form>
            </div>
        </main>
    </body>
</html>

<?php $connection->close(); ?>