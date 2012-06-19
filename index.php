<?php
session_start();

if(isset($_POST['captcha']))
  {
    if($_POST['captcha'] == $_SESSION['captcha'])
      {
        echo '<a href="./">back</a><br>'."\n";
        die('YOU ARE A HUMAN');
      }
    else
      {
        unset($_SESSION['captcha']);
        die('CAPTCHA IS WRONG');
      }
  }
else
  {
    $starttime = microtime();
    $string = hash("crc32b", rand(1,9000000).hash("crc32", time(), -3).md5(rand(1000000,999999999))).rand(0,9);
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
<style>

body{
    margin: 25px;
    
}

#captcha2 {
  -moz-animation-duration: 0.03s;
  -webkit-animation-duration: 0.03s;
  -moz-animation-name: captcha2;
  -webkit-animation-name: captcha2;
  -moz-animation-iteration-count: infinite;
  -webkit-animation-iteration-count: infinite;
  -moz-animation-direction: alternate;
  -webkit-animation-direction: alternate;
}


@-moz-keyframes captcha2 {
  from {
    margin-top:3px;
    width:100%
  }

  to {
    margin-top:-3px;
    width:100%;
  }
}

@-webkit-keyframes captcha2 {
  from {
    margin-top:3px;
    width:100%
  }

  to {
    margin-top:-3px;
    width:100%;
  }
}

/*
@-moz-keyframes captcha2 {
  from {
    top:-62px;
    width:100%
  }

  to {
    top:-51px;
    width:100%;
  }
}

@-webkit-keyframes captcha2 {
  from {
    top:-51px;
    width:100%
  }

  to {
    top:-62px;
    width:100%;
  }
}
*/


</style>
<script type="text/javascript">

var curtop = 0;

function captchaup(top)
{
if(curtop == 0)
{
curtop = top-57;
}
++curtop;
document.getElementById('captcha2').style.top = curtop+"px";
}
function captchadown(top)
{
if(curtop == 0)
{
curtop = top-57;
}
--curtop;
document.getElementById('captcha2').style.top = curtop+"px";
}

</script>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<?php


$im     = imagecreatefrompng("./bg.png");
$orange = imagecolorallocate($im, 255, 255, 255);
$px     = (imagesx($im) - rand(8,11) * strlen($string)) / 2;
$i = imagestring($im, 33, $px, rand(6,9), $string, $orange);
$size = getimagesize("./bg.png");
$x = 0;
$y = 0;

$im2 = imagecreate($size[0]*2, $size[1]*2);
$im3 = imagecreate($size[0]*2, $size[1]*2);
$bg_c = rand(200,255);
$background_color = ImageColorAllocate ($im2, $bg_c, $bg_c, $bg_c);
$background_color = ImageColorAllocate ($im3, $bg_c, $bg_c, $bg_c);
$bgcr = '#'.'EEEEEE';
$move = rand(0,8)-4;
$move2 = rand(0,8)-4;
  while($y != $size[1])
   {
    while($x != $size[0])
     {
      $rand = rand(0, 1);
      if((imagecolorat($im, $x, $y) == 0) && ($rand == 0))
       {
        imagesetpixel($im2, $x*2-$move, $y*2-$move2, 0);
        imagesetpixel($im2, $x*2+1-$move, $y*2-$move2, 16777215);
        imagesetpixel($im2, $x*2-$move, $y*2+1-$move2, 16777215);
        imagesetpixel($im2, $x*2+1-$move, $y*2+1-$move2, 0);

        imagesetpixel($im3, $x*2, $y*2, 16777215);
        imagesetpixel($im3, $x*2+1, $y*2, 0);
        imagesetpixel($im3, $x*2, $y*2+1, 0);
        imagesetpixel($im3, $x*2+1, $y*2+1, 16777215);
       }
      elseif((imagecolorat($im, $x, $y) == 0) && ($rand == 1))
       {
        imagesetpixel($im3, $x*2, $y*2, 0);
        imagesetpixel($im3, $x*2+1, $y*2, 16777215);
        imagesetpixel($im3, $x*2, $y*2+1, 16777215);
        imagesetpixel($im3, $x*2+1, $y*2+1, 0);
        if(rand(0,68)<67)
          {
            imagesetpixel($im2, $x*2-$move, $y*2-$move2, 16777215);
            imagesetpixel($im2, $x*2+1-$move, $y*2-$move2, 0);
            imagesetpixel($im2, $x*2-$move, $y*2+1-$move2, 0);
            imagesetpixel($im2, $x*2+1-$move, $y*2+1-$move2, 16777215);
		  }
		else
		  {
            imagesetpixel($im2, $x*2-3, $y*2-$move2, 0);
            imagesetpixel($im2, $x*2+1-$move, $y*2-$move2, 16777215);
            imagesetpixel($im2, $x*2-3, $y*2+1-$move2, 16777215);
            imagesetpixel($im2, $x*2+1-$move, $y*2+1-$move2, 0);
		  }
       }
      elseif((imagecolorat($im, $x, $y) == 16777215) && ($rand == 0))
       {
        imagesetpixel($im2, $x*2-$move, $y*2-$move2, 0);
        imagesetpixel($im2, $x*2+1-$move, $y*2-$move2, 16777215);
        imagesetpixel($im2, $x*2-$move, $y*2+1-$move2, 16777215);
        imagesetpixel($im2, $x*2+1-$move, $y*2+1-$move2, 0);

        imagesetpixel($im3, $x*2, $y*2, 0);
        imagesetpixel($im3, $x*2+1, $y*2, 16777215);
        imagesetpixel($im3, $x*2, $y*2+1, 16777215);
        imagesetpixel($im3, $x*2+1, $y*2+1, 0);
       }
      elseif((imagecolorat($im, $x, $y) == 16777215) && ($rand == 1))
       {
        imagesetpixel($im2, $x*2-$move, $y*2-$move2, 16777215);
        imagesetpixel($im2, $x*2+1-$move, $y*2-$move2, 0);
        imagesetpixel($im2, $x*2-$move, $y*2+1-$move2, 0);
        imagesetpixel($im2, $x*2+1-$move, $y*2+1-$move2, 16777215);

        imagesetpixel($im3, $x*2, $y*2, 16777215);
        imagesetpixel($im3, $x*2+1, $y*2, 0);
        imagesetpixel($im3, $x*2, $y*2+1, 0);
        imagesetpixel($im3, $x*2+1, $y*2+1, 16777215);
       }
      ++$x;
     }
    if($x == $size[0])
     {
      $x = 0;
     }
    ++$y;
   }
$endtime = microtime();
$scripttime = $startime[0] - $endtime[0];

imagecolortransparent($im3, 0);
imagecolortransparent($im2, 0);

ob_start();
imagejpeg($im2);
$b64im2 = base64_encode(ob_get_contents());
ob_end_clean();
ob_start();
imagepng($im3);
$b64im3 = base64_encode(ob_get_contents());
ob_end_clean();

$move3 = $move2+rand(0,4)-2;
echo '<div><a href="javascript:captchaup('.$move3.');">&darr;</a> - <a href="javascript:captchadown('.$move3.');">&uarr;</a></div><div style="height:57px; width:204px; margin:15px;"><div style="position:relative; top:'.$move3.'px; left:'.$move.'px; height:57px; width:204px;"><img src="data:image/jpg;base64,'.$b64im2.'" alt="captcha" /></div><div id="captcha2" style="position:relative; top:-57px; left:0px; height:57px; width:204px;"><img src="data:image/png;base64,'.$b64im3.'" alt="captcha" /></div></div><div><form action="" method="post"><input name="captcha" type="text"><p><input type="submit" value="Next"></p></form></div></body></html>';
?>
