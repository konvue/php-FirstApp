<?php


$filename = "test.txt";

$handle = fopen($filename, "r");

$contents = fread($handle, filesize($filename));


echo $contents;










?>
<DOCTYPE html>
<html>
<head>

  <meta charset="utf-8" />
  <title>IT</title>

</head>
<body>


<form>

<input type="text" name="sentence" placeholder="Wpisz tekst">
<input type="submit">

<i>



</form>






  <style>

  body {
    background: #ccc ;
  }

  </style>

</body>
</html>
