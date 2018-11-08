<?php

session_start();

if(isset($_SESSION['error'])){
    echo $_SESSION['error']."<br>";
    unset($_SESSION['error']);
}

if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    if($_SESSION['newreg']){
    unset($_SESSION['newreg']);
    }
    header("Location: index.php");
}

//Used for logging in
if(isset($_POST['email']) && isset($_POST['password'])){

        
$email = $_POST['email'];
$password = $_POST['password'];

$dbc_reg = mysqli_connect("localhost","root","","registerformtask");
    
    //Searches for values in server
$query = "SELECT * FROM users WHERE email = '$email' AND password = '$password';";
    
$result = mysqli_query($dbc_reg,$query);
    
    //If matching row is found, logs the user in
    if(mysqli_num_rows($result) == 1){
        
        $_SESSION['login'] = true;
        header("location: index.php");
    }
    else{
        $_SESSION['login'] = false;
        $_SESSION['error'] = "Wrong credentials";
        header("location: index.php");
    }

}
    
//Used for registration
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])){
    
    $name = $_POST['name'];    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $dbc_reg = mysqli_connect("localhost","root","","registerformtask");
    
    $query = "INSERT INTO users (name,email,password) VALUES ('$name','$email','$password')";
    
    //If the query is accepted, loggs the user in and registers them
    if(mysqli_query($dbc_reg,$query)){
        
        unset($_SESSION['error']);
        $_SESSION['login'] = true;
        $_SESSION['newreg'] = true;
        
    }
    //If the email already exists, tells the user this
    //If another error happens, displays lower message
    else{
        $_SESSION['login'] = false;
        $error = mysqli_error($dbc_reg);
        if($error == "Duplicate entry '$email' for key 'email'"){
            $_SESSION['error'] = "That email is already registered, try again!";
            die();
        }else{
            $_SESSION['error'] = "Something went wrong, try again!";
            header("location: index.php");
            die();
        }
        
    }
}
?>
