function switchVisibleSignUp() {
  document.getElementById('signup-form').style.display = 'Block';
  document.getElementById('login-form').style.display = 'none';
  document.getElementsByClassName('signup')[0].style.background="#FFF";
  document.getElementsByClassName('login')[0].style.background="none";
  document.getElementsByClassName('login')[0].style.color="white";
  document.getElementsByClassName('signup')[0].style.color="black";
}

function switchVisibleLogin(){
document.getElementById('login-form').style.display = 'Block';
document.getElementById('signup-form').style.display = 'none';
document.getElementsByClassName('login')[0].style.background="#FFF";
document.getElementsByClassName('signup')[0].style.background="none";
document.getElementsByClassName('signup')[0].style.color="white";
document.getElementsByClassName('login')[0].style.color="black";
}



