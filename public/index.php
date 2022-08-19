<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LogAnalyzer</title>
  <style>
  </style>
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
            echo "Possible file upload attack!\n";
        }
    } else {
        $uploadfile = $_POST['posted'];
    }
    
    $fday = new DateTime($_POST['fday']);
    $tday = new DateTime($_POST['tday']);
    
    $instance = new LogAnalysis($uploadfile, $fday->format('[d/M/Y:H:i:s'), $tday->format('[d/M/Y:H:i:s'));

    $datefield = $_POST['datefield'];
    $ipfield   = $_POST['ipfield'];
    $headnum   = $_POST['headnum'];

    $aggressive_ip = $instance->getAggressiveIP($datefield, $ipfield, $headnum);
    $get_minutes_num = $instance->getMinutesNum($datefield);

    $post_fday = $_POST['fday'];
    $post_tday = $_POST['tday'];

    echo "<div>";
    echo "<form enctype=\"multipart/form-data\" action=\"\" method=\"POST\">";
    echo "<input type=\"hidden\" name=\"posted\" value=\"$uploadfile\">";
    echo "<input type=\"datetime-local\" name=\"fday\" value=\"$post_fday\">";
    echo "<input type=\"datetime-local\" name=\"tday\" value=\"$post_tday\">";
    echo "<input type=\"number\" name=\"datefield\" min=\"1\" value=\"$datefield\">";
    echo "<input type=\"number\" name=\"ipfield\" min=\"1\" value=\"$ipfield\">";
    echo "<input type=\"number\" name=\"headnum\" min=\"1\" value=\"$headnum\">";
    echo "<input type=\"submit\" value=\"analyze\" />";
    echo "</form>";
    echo "</div>";
} else {
    echo "<div>";
    echo "<form enctype=\"multipart/form-data\" action=\"\" method=\"POST\">";
    echo "<input name=\"logfile\" type=\"file\" />";
    echo "<input type=\"datetime-local\" name=\"fday\">";
    echo "<input type=\"datetime-local\" name=\"tday\">";
    echo "<input type=\"number\" name=\"datefield\" min=\"1\" value=\"4\">";
    echo "<input type=\"number\" name=\"ipfield\" min=\"1\" value=\"1\">";
    echo "<input type=\"number\" name=\"headnum\" min=\"1\" value=\"5\">";
    echo "<input type=\"submit\" value=\"analyze\" />";
    echo "</form>";
    echo "</div>";   
}
?>

<?php
    echo "<pre>$aggressive_ip</pre>";
    echo "<pre>$get_minutes_num</pre>";
    echo "<div>";
    echo "<form action=\"\" method=\"GET\">";
    echo "<input type=\"submit\" value=\"reset\" />";
    echo "</div>";
?>

</body>
</html>