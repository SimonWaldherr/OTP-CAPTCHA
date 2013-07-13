<?php
session_start();

if (isset($_POST['captcha'])) {
  if ($_POST['captcha'] == $_SESSION['captcha']) {
    echo '<a href="./">back</a><br>' . "\n";
    die('YOU ARE A HUMAN');
  } else {
    unset($_SESSION['captcha']);
    die('CAPTCHA IS WRONG');
  }
} else {
  $starttime           = microtime();
  $string              = hash("crc32b", rand(1, 9000000) . hash("crc32", time(), -3) . md5(rand(1000000, 999999999))) . rand(0, 9);
  $_SESSION['captcha'] = $string;
}

?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="expires" content="0" />
  <meta name="robots" content="All" />
  <meta name="keywords" content="Captcha,Algorithmus,PHP,text,GD,GD-Lib">
  <title>Captcha Algo</title>
  <link href="./style.css" rel="stylesheet" type="text/css">
  <script src="./script.js"></script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<?php

include './otp.php';
$b64im = otpCAPTCHA($string);

?>

<div style="height:57px; width:204px; margin:15px;">
  <div style="position:relative; top:<?php echo $b64im[3]; ?>px; left:<?php echo $b64im[2]; ?>px; height:57px; width:204px;">
    <img src="data:image/jpg;base64,<?php echo $b64im[0]; ?>" alt="captcha" />
  </div>
  <div id="captcha2" style="position:relative; top:-57px; left:0px; height:57px; width:204px;">
    <img src="data:image/png;base64,<?php echo $b64im[1]; ?>" alt="captcha" />
  </div>
  </div>
  <div>
    <form action="" method="post">
      <input name="captcha" type="text">
      <p>
        <input type="submit" value="Next">
      </p>
    </form>
  </div>
</body>
</html>
