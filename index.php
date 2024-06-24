<?php
session_start();
require_once 'connection.php';
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $age = $_POST['age'];

    $user_id = save_user_details($conn, $email, $name, $age);
    if ($user_id) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_age'] = $age;
        if (initialize_cf_values($conn, $user_id, $age)) {
            header('Location: questions.php');
            exit();
        } else {
            $error = "Failed to initialize survey. Please try again.";
        }
    } else {
        $error = "Failed to save user details. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Survey - User Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
            text-align: left;
            font-weight: bold;
            color: #555;
        }

        input[type="email"],
        input[type="text"],
        input[type="number"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h1>Simple Disorder Diagnosis System</h1>
    <div class="container">
        <h1>Enter Your Details</h1>
        <form method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required><br>

            <input type="submit" value="Start Survey">
        </form>
    </div>
</body>
</html>