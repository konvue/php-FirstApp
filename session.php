<?php


session_start();

if (!isset($_SESSION['nick'])) {

  $_SESSION['niema'] = "Nie jesteś zalogowany aby tam się dostać";

  header('Location: index.php');
  exit();
}
else {

  if ($_SESSION['nick']=="bartek") {
    echo "Witaj adminie: " . $_SESSION['nick'];
  }
  else {
    echo
    "Witaj użytkowniku: " . $_SESSION['nick'] . "<br />" .
    "Zarejestrowałeś się: " . $_SESSION['data'] . "<br />".
    "Twoje aktualne hasło: " . $_SESSION['password'] . "<br />" .
    "Twoje aktualne hasło: " . $_SESSION['passwordClear'] . "<br />";
  }

}


if (isset($_POST['logout'])) {

  session_unset();

  header('Location: index.php');

}


if (isset($_POST['delete'])) {

  $connect = mysqli_connect('localhost','root','','morele');

  $sql = "DELETE FROM `users` WHERE nick='$_SESSION[nick]'" ;

  mysqli_query($connect,$sql);

  session_unset();

  mysqli_close($connect);

  header('Location: index.php');

}
