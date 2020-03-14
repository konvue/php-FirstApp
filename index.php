
<?php

session_start();

if (isset($_SESSION['nick'])) {

  header('Location: index2.php');

  exit();

}

$time = date("H:i Y.m.d");


if(isset($_POST['zarejestruj'])){

  $nickAT = $_POST['nick'];
  $nick = strtolower($nickAT);
  $password = $_POST['password'];
  $passwordVerify = $_POST['passwordVerify'];

        if ($password==$passwordVerify) {
          $hash = password_hash($password, PASSWORD_DEFAULT);
        }
        else {
          echo "Hasła się nie zgadzają";
          exit();
        }

        $polaczenie = mysqli_connect('localhost','root','','morele');

        $sql = "SELECT `nick` FROM `users` WHERE nick='$nick'";

        $zapytanie = mysqli_query($polaczenie, $sql);

        $core = mysqli_fetch_array($zapytanie);

        mysqli_close($polaczenie);

        $check = $core['nick'];

          if (empty($check)) {

            $polaczenie = mysqli_connect('localhost','root','','morele');

            $zapytanie = mysqli_query($polaczenie,"INSERT INTO `users`(`id`, `nick`, `password`, `date`) VALUES ('','$nick','$hash','$time')");

            mysqli_close($polaczenie);

            echo "Dziękujemy za rejestrację";
          }
          else {
            echo "Osoba o takim nicku jest już zarejestrowana";
          }
}
else {

echo "Wpisz dane poniżej, aby się zarejestrować";

}

// Login

if(isset($_POST['Zaloguj'])){

  $loginNick = $_POST['lNick'];
  $loginPassword = $_POST['lPassword'];

  $polaczenie = mysqli_connect('localhost','root','','morele');

  $sql = "SELECT nick FROM `users` WHERE nick='$loginNick'";

  $zapytanie = mysqli_query($polaczenie,$sql);

  $wynik = mysqli_fetch_array($zapytanie);

  if ($wynik['nick']==$loginNick) {

    $sql = "SELECT `password`,`date` FROM `users` WHERE nick='$loginNick'";

    $zapytanie = mysqli_query($polaczenie,$sql);

    $wynik = mysqli_fetch_array($zapytanie);

    $hash = $wynik['password'];

      if(password_verify($loginPassword, $hash)){

        $_SESSION['nick'] = $loginNick   ;
        $_SESSION['password'] = $hash  ;
        $_SESSION['passwordClear'] = $loginPassword  ;
        $_SESSION['data'] = $wynik['date'] ;

        header('Location: index2.php');


      }
      else {
        $qwe = "Nie prawidłowe hasło";
      }
  }
  else {
    $qwe = "Nie ma takiego użytkownika";
  }


  mysqli_close($polaczenie);

}

function users(){

$polaczenie = mysqli_connect('localhost','root','','morele');

$sql = "SELECT * FROM users" ;

$result = mysqli_query($polaczenie, $sql);

while ($show = mysqli_fetch_array($result)) {

echo "<table><tr><td>";
    echo
    $show['id'] .
    " | " .
    $show['nick'] .
    " | " .
    $show['password'] .
    " | " .
    $show['date'] .
    "</td>" ;
  }
mysqli_close($polaczenie);
}

?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <title>Lets Go PHP</title>

</head>
<body>




    <form action="#" method="post" name="rejestracja">

      <input type="text" name="nick" placeholder="Podaj Nick" required> </br>
      <input type="password" name="password" placeholder="Podaj hasło" required> </br>
      <input type="password" name="passwordVerify" placeholder="Podaj ponownie hasło" required> </br>

      <input type="checkbox" name="box" required>
      <label>Akceptuję regulamin</label>
</br>
      <input type="submit" name="zarejestruj" />

  </form>

<!-- ===========================    LOGOWANIE    ================================================ -->
<div style="height: 100px;"></div>
<p>
  Logowanie
</p>
  <form action="#" method="post" name="logowanie">

    <input type="text" name="lNick" placeholder="Nick"> </br>
    <input type="password" name="lPassword" placeholder="Hasło"> </br>

    <input type="submit" name="Zaloguj" />

</form>

<div id="111"></div>

<br />

<p>
  Rekordy userów
</p>

<?php users();?>


<style>

body {
  background-color: #989696 ;
}

</style>




<script>

document.getElementById('111').innerHTML = "<?php echo $qwe; ?>"

</script>























</body>
</html>
