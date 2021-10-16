<?php

$file = fopen("score.txt", "r");
$highest_score = fgets($file);
fclose($file);

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
            body {
                overflow-y: hidden;
                overflow-x: hidden;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="/">GenQuizz</a>
                <span class="navbar-text">
                    Highest score : <?php echo $highest_score; ?>
                </span>
            </div>
        </nav>
        <div class="h-100 row align-items-center justify-content-center" id="playBtn">
            <a href="#" id="playButton" class="button2">     Play     </a>
        </div>
        <div class="h-25 row align-items-center justify-content-center" id="endScreen" hidden>
            <h3 style="color: #f7f4f3; font-family: 'Roboto', sans-serif" id="scoreText"></h3>
        </div>
        <div class="row align-items-center justify-content-center" id="homeBtn" style="display: none;">
            <a href="/" id="homeButton" class="button2">     Back     </a>
        </div>
        <div id="quizzButtons" style="display: none;">
            <div class="h-25 row align-items-center justify-content-center">
                <h3 style="color: #f7f4f3; font-family: 'Roboto', sans-serif" id="question"></h3>
            </div>
            <div class="row align-items-center justify-content-center">
                <a href="#" id="trueButton" class="button2" style="margin-right: 5px;">     True     </a>
                <a href="#" id="falseButton" class="button2" style="margin-left: 5px;">     False     </a>
            </div>
        </div>
    <body>
</html>

<script>

var i = 0;
var resp = '';
var score = 0;

$(document).ready(function () {
    $('#playButton').click(function(e) {
    e.preventDefault();
    var fd = new FormData();
        $.ajax({
            type: 'POST',
            url: "quizz.php",
            dataType: "json",
            success: function(response) {
                $('#playBtn').hide();
                $('#quizzButtons').css("display", "block");
                resp = response;
                startQuizz(response);
            }
        });
    });
});

function startQuizz(response) {
    document.getElementById("question").innerHTML = response['results'][i]['question'];
}

document.getElementById('trueButton').onclick = function(e) {
    if (i == 19) {
        endGame();
        return;
    }
    checkAnswer('True');
    i++;
    startQuizz(resp);
}

document.getElementById('falseButton').onclick = function(e) {
    if (i == 19) {
        endGame();
        return;
    }
    checkAnswer('False');
    i++;
    startQuizz(resp);
}

function endGame() {
    $('#quizzButtons').css("display", "none");
    $('#homeBtn').css("display", "");
    $('#endScreen').replaceWith("<div class='h-25 row align-items-center justify-content-center' \
    id='endScreen''><h3 style='color: #f7f4f3; font-family: Roboto, sans-serif' \
    id='scoreText'>You scored " + score + " points !</h3></div>");
    checkHighest();
}

function checkHighest() {
    if (<?= $highest_score; ?> <= score) {
        $.ajax({
            type: 'POST',
            url: "write_score.php?" + $.param({ score }),
            dataType: "",
            success: function(response) {}
        });
    };
}

function checkAnswer(answer) {
    var result = resp['results'][i]['correct_answer'];
    if (answer == result) {
        score = score + 1;
    }
}

</script>