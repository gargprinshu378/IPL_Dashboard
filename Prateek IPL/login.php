<?php

    /**
        *@file login.php
        *Contains the login form and authentication logic.
    */

    // Start the session and include the User class

    session_start();
    include('User.php');

    // Process the form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $user = new User();

        // Validate the user's credentials
        if ($user->login($username, $password)) {
            $_SESSION["username"] = $username;
            header("Location: dashboard.php");
        } else {
            echo "Invalid username or password";
        }
    }
?>

<link rel="stylesheet" href="/css/login.css">
<!-- Creating the form using method post -->
<form method="post">
    <!-- Input username -->
    <label>Username:</label>
    <input type="text" name="username"><br>

    <!-- Input Password -->
    <label>Password:</label>
    <input type="password" name="password"><br>

    <!-- Submit type -->
    <input type="submit" value="Login">
</form>

<br><br>

<!-- Main page link -->
<a href="/index.php">Go to main page</a>
