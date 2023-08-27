<?php

define('BASEPATH', true); // Access connection script if you omit this line file will be blank
require "../config/config.php";



if(isset($_POST['submit'])){  
    // Ensure fields are not empty
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;    
    // Check if the username already exists in the database
    $sql = "SELECT id FROM admins WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    
    // Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // If $user is not FALSE, the username already exists.
    if($user !== false){
        echo '<script>alert("Username already exists")</script>';
        header("Location : admin_register.php");
    } else{
        // Hash the password
        $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
        
        // Insert the new user into the database
        $sql = "INSERT INTO admins (username, password, email) VALUES (:username, :password, :email)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $passwordHash);
        $stmt->bindValue(':email', $email);
        $result = $stmt->execute();
        ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
        
        // If the registration is successful, redirect to the login page.
        if($result){
            echo '<script>alert("Registration successful! Please login.")</script>';
            header('Location: ../login.php');

            exit;
        } else{
            // If the registration fails, display an error message.
            echo '<script>alert("Registration failed. Please try again later.")</script>';
            header("Location : admin_register.php");
        }
    }
}
?>
