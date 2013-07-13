<?php

function otpCAPTCHA($string) {
  $im     = imagecreatefrompng("./bg.png");
  $orange = imagecolorallocate($im, 255, 255, 255);
  $px     = (imagesx($im) - rand(8, 11) * strlen($string)) / 2;
  $i      = imagestring($im, 33, $px, rand(6, 9), $string, $orange);
  $size   = getimagesize("./bg.png");
  $x      = 0;
  $y      = 0;

  $im2              = imagecreate($size[0] * 2, $size[1] * 2);
  $im3              = imagecreate($size[0] * 2, $size[1] * 2);
  $bg_c             = rand(200, 255);
  $background_color = ImageColorAllocate($im2, $bg_c, $bg_c, $bg_c);
  $background_color = ImageColorAllocate($im3, $bg_c, $bg_c, $bg_c);
  $bgcr             = '#' . 'EEEEEE';
  $move             = rand(0, 8) - 4;
  $move2            = rand(0, 8) - 4;
  while ($y != $size[1]) {
    while ($x != $size[0]) {
      $rand = rand(0, 1);
      if ((imagecolorat($im, $x, $y) == 0) && ($rand == 0)) {
        imagesetpixel($im2, $x * 2 - $move, $y * 2 - $move2, 0);
        imagesetpixel($im2, $x * 2 + 1 - $move, $y * 2 - $move2, 16777215);
        imagesetpixel($im2, $x * 2 - $move, $y * 2 + 1 - $move2, 16777215);
        imagesetpixel($im2, $x * 2 + 1 - $move, $y * 2 + 1 - $move2, 0);

        imagesetpixel($im3, $x * 2, $y * 2, 16777215);
        imagesetpixel($im3, $x * 2 + 1, $y * 2, 0);
        imagesetpixel($im3, $x * 2, $y * 2 + 1, 0);
        imagesetpixel($im3, $x * 2 + 1, $y * 2 + 1, 16777215);
      } elseif ((imagecolorat($im, $x, $y) == 0) && ($rand == 1)) {
        imagesetpixel($im3, $x * 2, $y * 2, 0);
        imagesetpixel($im3, $x * 2 + 1, $y * 2, 16777215);
        imagesetpixel($im3, $x * 2, $y * 2 + 1, 16777215);
        imagesetpixel($im3, $x * 2 + 1, $y * 2 + 1, 0);
        if (rand(0, 68) < 67) {
          imagesetpixel($im2, $x * 2 - $move, $y * 2 - $move2, 16777215);
          imagesetpixel($im2, $x * 2 + 1 - $move, $y * 2 - $move2, 0);
          imagesetpixel($im2, $x * 2 - $move, $y * 2 + 1 - $move2, 0);
          imagesetpixel($im2, $x * 2 + 1 - $move, $y * 2 + 1 - $move2, 16777215);
        } else {
          imagesetpixel($im2, $x * 2 - 3, $y * 2 - $move2, 0);
          imagesetpixel($im2, $x * 2 + 1 - $move, $y * 2 - $move2, 16777215);
          imagesetpixel($im2, $x * 2 - 3, $y * 2 + 1 - $move2, 16777215);
          imagesetpixel($im2, $x * 2 + 1 - $move, $y * 2 + 1 - $move2, 0);
        }
      } elseif ((imagecolorat($im, $x, $y) == 16777215) && ($rand == 0)) {
        imagesetpixel($im2, $x * 2 - $move, $y * 2 - $move2, 0);
        imagesetpixel($im2, $x * 2 + 1 - $move, $y * 2 - $move2, 16777215);
        imagesetpixel($im2, $x * 2 - $move, $y * 2 + 1 - $move2, 16777215);
        imagesetpixel($im2, $x * 2 + 1 - $move, $y * 2 + 1 - $move2, 0);

        imagesetpixel($im3, $x * 2, $y * 2, 0);
        imagesetpixel($im3, $x * 2 + 1, $y * 2, 16777215);
        imagesetpixel($im3, $x * 2, $y * 2 + 1, 16777215);
        imagesetpixel($im3, $x * 2 + 1, $y * 2 + 1, 0);
      } elseif ((imagecolorat($im, $x, $y) == 16777215) && ($rand == 1)) {
        imagesetpixel($im2, $x * 2 - $move, $y * 2 - $move2, 16777215);
        imagesetpixel($im2, $x * 2 + 1 - $move, $y * 2 - $move2, 0);
        imagesetpixel($im2, $x * 2 - $move, $y * 2 + 1 - $move2, 0);
        imagesetpixel($im2, $x * 2 + 1 - $move, $y * 2 + 1 - $move2, 16777215);

        imagesetpixel($im3, $x * 2, $y * 2, 16777215);
        imagesetpixel($im3, $x * 2 + 1, $y * 2, 0);
        imagesetpixel($im3, $x * 2, $y * 2 + 1, 0);
        imagesetpixel($im3, $x * 2 + 1, $y * 2 + 1, 16777215);
      }
      ++$x;
    }
    if ($x == $size[0]) {
      $x = 0;
    }
    ++$y;
  }
  $endtime    = microtime();
  $scripttime = $startime[0] - $endtime[0];

  imagecolortransparent($im3, 0);
  imagecolortransparent($im2, 0);

  ob_start();
  imagejpeg($im2);
  $b64im = array();
  $b64im[0] = base64_encode(ob_get_contents());
  ob_end_clean();
  ob_start();
  imagepng($im3);
  $b64im[1] = base64_encode(ob_get_contents());
  ob_end_clean();
  $b64im[2] = $move;
  $b64im[3] = $move2;
  return $b64im;
}

?>