<?php
    session_start();
    if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
        header('location: login.php');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Blogesation</title>
</head>
<body>
    <section>
        <?php echo require('header.php') ?>

        <main>
            <?php 
                $conn = require('first.php');

                $fetchQuery = "SELECT * FROM blogs ORDER BY time DESC";

                $data = "";

                $result = mysqli_query($conn, $fetchQuery);
                
                while ($row = mysqli_fetch_assoc($result)) { 
                    $data .= '
                    <article>
                        <img src="https://w7.pngwing.com/pngs/527/663/png-transparent-logo-person-user-person-icon-rectangle-photography-computer-wallpaper.png" alt="Profile">
                        <div>
                            <p>@'. $row["username"] . '</p>
                            <p class="desc">'. $row["description"] .'</p>
                        </div>
                    </article>
                    ';
                }

                echo $data;
            ?>
        </main>
    </section>

</body>
</html>