<?php


require_once "session.php";



if (isset($_POST['Send'])) {

  $nickUser = $_SESSION['nick'];

  $oldPassword = $_POST['oldPassword'];
  $newPassword = $_POST['NewPassword'];
  $RenewPassword = $_POST['ReNewPassword'];

  $connect = mysqli_connect('localhost','root','','morele');

  $sql = "SELECT `password` FROM `users` WHERE nick='$_SESSION[nick]'";

  $zapytanie = mysqli_query($connect,$sql);

  $wynik = mysqli_fetch_array($zapytanie);

  $hash = $wynik['password'];


      if(password_verify($oldPassword, $hash)){

        if ($newPassword==$RenewPassword) {

          $hashpassword = password_hash($newPassword, PASSWORD_DEFAULT);

          $sql = "UPDATE `users` SET password='$hashpassword' WHERE nick='$nickUser'";

          $zapytanie = mysqli_query($connect,$sql);

          $_SESSION['password'] = $hashpassword;

          $_SESSION['passwordClear'] = $newPassword;

          header('Location: index2.php');


        }
        else {
          echo "Nowe hasło się nie zgadza";
        }

      }
      else {
        echo "Aktualne hasło, które podałeś jest złe. Podaj ponownie";
      }



}

// ==== CHAT BOX ====

function test(){

$connect = mysqli_connect('localhost','root','','morele');

$sqlShow = "SELECT * FROM chat";

$result = mysqli_query($connect, $sqlShow);



while ($chat = mysqli_fetch_array($result)) {

  $nickNameFrom = $chat['from'];
  $nickNameON = $_SESSION['nick'];


  if ($nickNameFrom==$nickNameON) {
    echo
    "<table> <tr>" . $chat['id'] . "<span style='color: green; font-weight: bolder'> " . $chat['from'] .
    "</tr></span><tr> napisałeś: " . $chat['message'] . "</tr><br />";
  }
  else  {
    echo

      "<table> <tr>" . $chat['id'] . "<span style='color: blue; font-weight: bolder'> " . $chat['from'] .
    "</tr></span><tr> napisał: " . $chat['message'] . "</tr><br />";

  }
}

mysqli_close($connect);
}



// Dodawanie wiadomości


if (isset($_POST['SendMessage'])  ) {

  $nickFrom = $_SESSION['nick'];

  $message = $_POST['message'];

  $connect = mysqli_connect('localhost','root','','morele');

  $sqlShow = "INSERT INTO `chat`(`id`, `message`, `from`, `to`) VALUES ('','$message','$nickFrom','')";

  $result = mysqli_query($connect, $sqlShow);

  mysqli_close($connect);

header('Location: index2.php');


}

// Usuwanie wiadomości



if (isset($_POST['DeleteMessage'])) {

  $msgID = $_POST['messageID'];

  $connect = mysqli_connect('localhost','root','','morele');

  $sql = "SELECT `id` FROM `chat` WHERE id=$msgID";

  $score = mysqli_query($connect,$sql);

  $core = mysqli_fetch_array($score);

  if ($core['id']==$msgID) {

    $sqlShow = "DELETE FROM chat WHERE id=$msgID";

    $result = mysqli_query($connect, $sqlShow);

    mysqli_close($connect);

    echo "Wiadomość o id " . $msgID . " została usunięta";
  }
  else {
    echo "Wiadomość o id " . $msgID . " nie istnieje";
  }


}





?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <title>Witaj</title>

</head>
<body>

<br/>

<form action="#" method="post">

<input type="submit" name="logout" value="Logout" />
<input type="submit" name="delete" value="Delete" />

</form>



<form action="#" method="post">

<p>
  Zmień hasło
</p>

<input type="text" name="oldPassword" placeholder="Aktualne Hasło" /><br />

<input type="text" name="NewPassword" placeholder="Nowe Hasło" /><br />
<input type="text" name="ReNewPassword" placeholder="Powórz Nowe Hasło" /><br />

<br />

<input type="submit" name="Send" value="Zapisz" />


</form>

<br />
<p>
  <b>Chat Box</b>
</p>



  <?php test(); ?>

<br />


<form action="#" method="post">

  <input type="text" name="message" placeholder="Wiadomość" />

  <input type="submit" name="SendMessage" value="Wyślij" />

</form>

<br/></br/>

<form action="#" method="post">

  <input type="text" name="messageID" placeholder="ID wiadomości" />

  <input type="submit" name="DeleteMessage" value="Usuń wiadomość" />

</form>

<br /><br />
<a href="games.php">Przejdź do gier</a>


<style>

body {
  background-color: #989696 ;
}

</style>
















</body>
</html>
