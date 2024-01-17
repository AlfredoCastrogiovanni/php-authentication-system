<?php 
    if (session_status() === PHP_SESSION_NONE){
        session_start();
    }

    session_unset();
    session_destroy();
    header( "refresh:3; url=index.php" );
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
        <main class="d-flex justify-content-center align-items-center" style="width: 100vw; height: 100vh;">
            <h1>You have been logged out successfully!</h1>
        </main>
    </body>
</html>