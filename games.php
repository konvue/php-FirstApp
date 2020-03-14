<?php

session_start();

if (!isset($_SESSION['genNum'])) { // Generujemy liczbę jeżeli nie jest wcześniej ustawiona

  $_SESSION['genNum'] = rand(1, 10);

}

if (isset($_POST['generateNew'])) { // Generujemy nową liczbę, gdy naciśniemy przycisk "Generate New Number"
  session_unset();
  header('Location: games.php');
}


if (isset($_POST['checkNumber'])) { // Sprawdzamy czy wylosowana liczba zgadza się z podaną przez użytkownika

  $selectNumber = $_POST['selectNumber'];

  $generateNum = $_SESSION['genNum'];

  if (preg_match ('/^-?[0-9]+$/', $selectNumber)) { // Sprawdzanie czy podana wartośc to liczba
    if ($selectNumber>$generateNum) {
      $question = "Your number is too big<br /><br />";
    }
    elseif ($selectNumber<$generateNum) {
      $question = "Your number is too small<br /><br />";
    }
    else {
      $question = "<a style='color: green;'>Congratulations!</a> Generated number is: " . $generateNum . "<br />  <input type='submit' name='generateNew' value='Generate New number' />";
    }
  }
  else {
    $question = "Write correct number between 1-10";
  }



}

if (isset($_POST['paper']) || isset($_POST['rock']) || isset($_POST['scissors']) ) {  // Sprawdzamy który przycisk został kliknięty

// 1 - paper
// 2 - rock
// 3 - scissors

$generate = rand(1, 3);

 // =========================== Paper ===============================

if (isset($_POST['paper'])) {

    if ($generate == 1 ) {
      $prsEcho = "You choose <b>Paper</b>. Computer pick <b>Paper</b>. Result: <b style='color: orange'>Draw</b> ";
    }
    elseif ($generate == 2) {
      $prsEcho = "You choose <b>Paper</b>. Computer pick <b>Rock</b>. Result: <b style='color: green'>Win</b> ";
    }
    else {
      $prsEcho = "You choose <b>Paper</b>. Computer pick <b>Scissors</b>. Result: <b style='color: red'>Lose</b> ";
    }
}
 // =========================== Rock ===============================

 if (isset($_POST['rock'])) {

     if ($generate == 1 ) {
       $prsEcho = "You choose <b>Rock</b>. Computer pick <b>Paper</b>. Result: <b style='color: red'>Lose</b> ";
     }
     elseif ($generate == 2) {
       $prsEcho = "You choose <b>Rock</b>. Computer pick <b>Rock</b>. Result: <b style='color: orange'>Draw</b> ";
     }
     else {
       $prsEcho = "You choose <b>Rock</b>. Computer pick <b>Scissors</b>. Result: <b style='color: green'>Win</b> ";
     }
 }

  // =========================== Scissors ===============================

 if (isset($_POST['scissors'])) {

     if ($generate == 1 ) {
       $prsEcho = "You choose <b>Scissors</b>. Computer pick <b>Paper</b>. Result: <b style='color: green'>Win</b> ";
     }
     elseif ($generate == 2) {
       $prsEcho = "You choose <b>Scissors</b>. Computer pick <b>Rock</b>. Result: <b style='color: red'>Lose</b> ";
     }
     else {
       $prsEcho = "You choose <b>Scissors</b>. Computer pick <b>Scissors</b>. Result: <b style='color: orange'>Draw</b> ";
     }
 }


}







?>
<DOCTYPE html>
<html>
<head>

  <meta charset="utf-8" />
  <title>Games</title>


</head>
<body>

<p>
  #1 Game - What number is in my mind? Between 1-10
</p>

<form method="post" action="#" name="number">

  <input type="text" name="selectNumber" placeholder="Write your number"/>

  <input type="submit" name="checkNumber" value="Check number" />

<div id="number" style="font-size: 20px; "><br /><br /></div>

<script>

document.getElementById('number').innerHTML = "<?= $question ?>"

</script>

</form>


<p>
  #2 Game - Paper, Rock, Scissors
</p>

<form method="post" action="#" name="prs">

  <input type="submit" value="Paper" name="paper" />
  <input type="submit" value="Rock" name="rock" />
  <input type="submit" value="Scissors" name="scissors" />


</form>

<div id="prsEcho"><br /></div>

<script>

document.getElementById('prsEcho').innerHTML = "<?= $prsEcho ?>"

</script>









<style>

body {
  background: #ccc ;
}

</style>



</body>
</html>
