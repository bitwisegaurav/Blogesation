<?php

    $msg = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST['username']) && isset($_POST['description'])){
            $username = $_POST['username'];
            $description = $_POST['description'];

            $conn = require('first.php');

            $insertQuery = "INSERT INTO blogs (time, username, description) VALUES (UNIX_TIMESTAMP(), '$username', '$description')";

            if(mysqli_query($conn, $insertQuery)){
                $blogsvalue = mysqli_query($conn, "SELECT blogs FROM users WHERE username = '$username'");
                $updateQuery = "UPDATE users SET blogs = '$blogsvalue' WHERE username = '$username'";
                $msg = "Blog created successfully";
            }
            else{
                $msg = "Error creating blog" . mysqli_error($conn);
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog - Blogesation</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ff7f00;
            min-height: 100vh;
            box-sizing: border-box;
            padding: 20px;
        }

        section {
            flex: 1;
            width: 100%;
            max-width: 500px;
            margin: 30px 0;
            background-color: #fff;
            border-radius: 10px; 
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        /* Form Styles */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2rem;
            padding: 2rem;
            height: 100%;
        }

        form > h1{
            margin: 0;
            color: #4e3b28;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 100%; 
        }

        .input-group label {
            font-weight: bold;
            color: #4e3b28;
        }

        .input-group input, textarea {
            padding: 10px;
            border: 1px solid #ff7f00;
            border-radius: 5px;
            outline: none;
            resize: none;
        }

        .input-group textarea{
            height: 200px;
        }
        
        .input-group input:focus, textarea:focus{
            border: 2px solid #ff7f00; 
        }

        .input-group input::placeholder, textarea::placeholder {
            color: #999;
            font-family: sans-serif;
        }

        button {
            padding: 10px 20px;
            background-color: #ff7f00; 
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #c86400;
        }
    </style>
</head>
<body>
    <section>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <h1>Create Blog</h1>
            <?php echo $msg ?>
            <div class="input-group">
                <label for="description">Description :</label>
                <textarea name="description" placeholder="Enter your username" required></textarea>
            </div>
            <button type="submit" name="createblog">Submit</button>
        </form>
    </section>
</body>
</html>