<?php

require_once 'config.php';

try {
	$dsn = "pgsql:host=$host;port=5432;dbname=$db;";
	$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
	die($e->getMessage());
}

$stmt = $pdo->query("SELECT * FROM quizz");

// fetch the highest_score
$row = $stmt->fetch(\PDO::FETCH_ASSOC);
$highest_score = $row['highest_score'];

?>

<html>
    <head>
        <meta charset="utf-8">
        <title>GenQuizz</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <style>
            body {
                background: url(https://coolbackgrounds.io/images/backgrounds/index/compute-ea4c57a4.png) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
            .navbar {
                background-color: #ff7f00;
                border-color: #ff7f00;
            }
            .navbar-text {
                color: #ffffff !important;
            }
            a.button2 {
                display: inline-block;
                padding: 0.5em 3em;
                border: 0.16em solid #ff7f00;
                margin: 0 0.3em 0.3em 0;
                box-sizing:  border-box;
                text-decoration: none;
                text-transform: uppercase;
                font-family: 'Roboto',sans-serif;
                font-weight: 400;
                color: #ff7f00;
                text-align: center;
                transition:  all 0.15s;
            }
            a.button2:hover {
                color: #DDDDDD;
                border-color: #DDDDDD;
            }
            a.button2:active {
                color: #BBBBBB;
                border-color: #BBBBBB;
            }
            a.button2 {
                display: block;
                margin: 0.4em auto;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="#">GenQuizz</a>
                <span class="navbar-text">
                    Highest score : <?php echo $highest_score; ?>
                </span>
            </div>
        </nav>
        <div class="h-100 row align-items-center justify-content-center">
            <a href="" class="button2">     Play     </a>
        </div>
    <body>
</html>