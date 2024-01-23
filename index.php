<?php 
    if (session_status() === PHP_SESSION_NONE){
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Homepage</title>
        <!-- Boostrap CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    </head>
    <body>
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Site</a>
                <?php if(empty($_SESSION["name"])) { ?>
                <a href="pages/login.php" class="ms-auto">
                    <button class="btn btn-outline-success me-2">Login</button>
                </a>
                <a href="pages/register.php">
                    <button class="btn btn-outline-warning">Register</button>
                </a>
                <?php } else { ?>
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="pages/user.php">My Profile</a>
                        </li>
                    </ul>
                    <span class="navbar-text me-3">
                        Welcome
                        <span class="fw-bold"><?php echo $_SESSION["name"]; ?></span>
                    </span>
                    <a href="pages/logout.php">
                    <button class="btn btn-outline-secondary">Log out</button>
                    </a>
                <?php } ?>
            </div>
        </nav>
    </body>
</html>