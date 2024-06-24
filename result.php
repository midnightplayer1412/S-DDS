<?php
session_start();
require_once 'connection.php';
require_once 'functions.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$cf_values = get_cf_values($conn, $user_id);
$user_name = get_user_name($conn, $user_id);
$disorders = [
    'mdd' => 'Major Depressive Disorder',
    'apd' => 'Antisocial Personality Disorder',
    'ed' => 'Eating Disorder',
    'dd' => 'Delusional Disorder',
    'bpd' => 'Brief Psychotic Disorder',
    'sp' => 'Schizoid Personality',
    'pd' => 'Personality Disorder',
    'gd' => 'General Disorder',
];

function get_disorder_status($cf_value) {
    if ($cf_value > 0.7) {
        return "confirms having";
    } elseif ($cf_value >= 0.4) {
        return "has a high chance of having";
    } elseif ($cf_value >= 0) {
        return "is likely to have";
    } elseif ($cf_value >= -0.4) {
        return "is unlikely to have";
    } else {
        return "will not have";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Survey Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
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
            max-width: 600px;
            width: 100%;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .result {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f4f4f4;
            border-radius: 5px;
            font-size: 18px;
        }

        a.btn {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            margin-top: 20px;
        }

        a.btn:hover {
            background-color: #0056b3;
        }
        footer {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 16px;
        }

        footer p {
            margin: 0;
        }

    </style>
</head>
<body>    
    <div class="container">
        <h1>Survey Results for <?php echo htmlspecialchars($user_name); ?></h1>

        <?php foreach ($disorders as $key => $disorder_name): ?>
            <?php if (isset($cf_values["cf_$key"])): ?>
                <div class="result">
                    <?php
                    $cf_value = $cf_values["cf_$key"];
                    $status = get_disorder_status($cf_value);
                    echo htmlspecialchars("$user_name $status $disorder_name");
                    ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>

        <a href="index.php" class="btn">Back to Home</a>
    </div>
    <footer>
        <p>Helpline Please Call: <strong>15999</strong></p>
    </footer>
</body>
</html>