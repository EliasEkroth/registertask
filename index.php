<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>register form task</title>
</head>

<body>

    <?php
    session_start();
    ?>
        <!--Makes error message red-->
        <div class="errordiv">
            <style>
                .errordiv {
                    color: red;
                }

            </style>
            <?php
            //Diplays error message, then removes it
    if (isset($_SESSION['error'])){
        echo $_SESSION['error']."<br>";
        unset($_SESSION['error']);
    }
    ?>
        </div>
        <?php
    //Chooses what welcome message is displayed
    if(isset($_SESSION['login']) && $_SESSION['login'] == true){
        //If user is newly registered
        if(isset($_SESSION['newreg'])){
            echo "You are now registered! Welcome!";
            unset($_SESSION['newreg']);
        } else{
            //If the user is logging in again. 
                echo "Welcome back!";

        }
        ?>
            <!--Logging out when logged in-->
            <form action="submit.php" method="POST">
                <br><input type="submit" value="Logout" name="logout">
            </form>
            <?php
        }

         else{ ?> Login

                <!--Used for logging in if already registered-->
                <form action="submit.php" method="POST">

                    Email: <input type="email" name="email" required><br> Password: <input type="password" name="password" required><br>
                    <input type="submit">

                </form>
                <!--Used to register a new user-->
                <br> Register
                <form action="submit.php" method="POST" required>
                    Name: <input type="text" name="name" required><br> Email: <input type="email" name="email" required><br> Password: <input type="password" name="password" required><br>
                    <input type="submit">
                </form>
                <?php
        }
?>
</body>

</html>
