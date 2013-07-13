var curtop = 0;

function captchaup(top) {
  if (curtop == 0) {
    curtop = top - 57;
  }
  ++curtop;
  document.getElementById('captcha2').style.top = curtop + "px";
}

function captchadown(top) {
  if (curtop == 0) {
    curtop = top - 57;
  }
  --curtop;
  document.getElementById('captcha2').style.top = curtop + "px";
}
