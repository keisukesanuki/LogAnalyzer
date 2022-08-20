<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LogAnalyzer</title>
  <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>

<?php
require('../lib/LogAnalysis.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (is_uploaded_file($_FILES['logfile']['tmp_name'])) {
        $uploaddir = '../upload/';
        $rand_str = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 16);
        $uploadfile = $uploaddir . $rand_str;
        if (!move_uploaded_file($_FILES['logfile']['tmp_name'], $uploadfile)) {
            echo "File upload has failed.\n";
        }
    } else {
        if (isset($_POST['posted'])){
            $uploadfile = $_POST['posted'];
        } else {
            echo "File does not exist.\n";
        }
    }
    
    $fday = new DateTime($_POST['fday']);
    $tday = new DateTime($_POST['tday']);

    $datefield = $_POST['datefield'];
    $anyfield   = $_POST['anyfield'];
    $headnum   = $_POST['headnum'];

    $instance = new LogAnalysis($uploadfile, $fday->format('[d/M/Y:H:i:s'), $tday->format('[d/M/Y:H:i:s'));
    $aggressive_ip = $instance->getAggressiveItem($datefield, $anyfield, $headnum);
    $get_minutes_num = $instance->getMinutesNum($datefield);

    $post_fday = $_POST['fday'];
    $post_tday = $_POST['tday'];

    echo "<div>";
    echo "<form enctype=\"multipart/form-data\" action=\"\" method=\"POST\">";
    echo "<input type=\"hidden\" name=\"posted\" value=\"$uploadfile\">";
    echo "<input type=\"datetime-local\" name=\"fday\" value=\"$post_fday\">";
    echo "<input type=\"datetime-local\" name=\"tday\" value=\"$post_tday\">";
    echo "<input type=\"number\" name=\"datefield\" min=\"1\" value=\"$datefield\" class=\"datafield\">";
    echo "<input type=\"number\" name=\"anyfield\" min=\"1\" value=\"$anyfield\" class=\"anyfield\">";
    echo "<input type=\"number\" name=\"headnum\" min=\"1\" value=\"$headnum\" class=\"headnum\">";
    echo "<input type=\"submit\" value=\"analyze\" />";
    echo "</form>";
    echo "</div>";

    echo "<h4>TOP $headnum Aggressive $anyfield Field</h4>";
    echo "<pre>$aggressive_ip</pre>";
    echo "<h4>Number of Accesses</h4>";
    echo "<pre>$get_minutes_num</pre>";
    echo "<div>";
    echo "<form action=\"\" method=\"GET\">";
    echo "<input type=\"submit\" value=\"reset\" />";
    echo "</div>";
} else {
    echo "<div>";
    echo "<form enctype=\"multipart/form-data\" action=\"\" method=\"POST\">";
    echo "<input name=\"logfile\" type=\"file\" />";
    echo "<input type=\"datetime-local\" name=\"fday\">";
    echo "<input type=\"datetime-local\" name=\"tday\">";
    echo "<input type=\"number\" name=\"datefield\" min=\"1\" value=\"4\" class=\"datafield\">";
    echo "<input type=\"number\" name=\"anyfield\" min=\"1\" value=\"1\" class=\"anyfield\">";
    echo "<input type=\"number\" name=\"headnum\" min=\"1\" value=\"5\" class=\"headnum\">";
    echo "<input type=\"submit\" value=\"analyze\" />";
    echo "</form>";
    echo "</div>";   
}
?>

</body>
</html>