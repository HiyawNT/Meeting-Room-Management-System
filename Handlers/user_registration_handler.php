<?php

define('BASEPATH', true); // Access connection script if you omit this line file will be blank
require "../config/config.php";



if(isset($_POST['submit'])){  
    // Ensure fields are not empty
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $department = !empty($_POST['department']) ? trim($_POST['department']) : null;
    
    // Check if the username already exists in the database
    $sql = "SELECT id FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    
    // Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // If $user is not FALSE, the username already exists.
    if($user !== false){
        echo '<script>alert("Username already exists")</script>';
    } else{
        // Hash the password
        $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
        
        // Insert the new user into the database
        $sql = "INSERT INTO users (username, password, email, department) VALUES (:username, :password, :email, :department)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $passwordHash);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':department', $department);
        $result = $stmt->execute();
        ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
        
        // If the registration is successful, redirect to the login page.
        if($result){
            echo '<script>alert("Registration successful! Please login.")</script>';
            header('Location: ../admin/users.php');
            // echo '<script>window.location.replace("login.php");</script>';
            exit;
        } else{
            // If the registration fails, display an error message.
            echo '<script>alert("Registration failed. Please try again later.")</script>';
        }
    }
}
?>
