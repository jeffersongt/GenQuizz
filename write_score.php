<?php

$score = $_GET["score"];

$file = fopen("score.txt", "w");
fwrite($file, $score);
fclose($file);

?>