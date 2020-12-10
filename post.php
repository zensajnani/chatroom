<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
if(isset($_SESSION['name'])){
    $text = $_POST['text'];
     
    $fp = fopen("chat.html", 'a');
    fwrite($fp, "
<div id='message'>
    <b>".$_SESSION['name']."</b>: ".
    stripslashes(htmlspecialchars($text))."
    <span><small>(".date("g:i:sA d/m/Y").")</small></span><br>
</div>
");
    fclose($fp);
}
?>