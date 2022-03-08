'use strict';
let veroeffentlichungsdatum_des_Al = document.getElementById("Veroeffentlichungsdatum_des_Al");
veroeffentlichungsdatum_des_Al.style.textAlign = "center";


var countdown = new Date("Feb 06, 2022 00:00:00").getTime();


function release_countdown() {
  var now = new Date().getTime(); 

  var deadline = countdown - now;

  var tagen = Math.floor(deadline / (1000 * 60 * 60 * 24));
  var stu = Math.floor((deadline % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var min = Math.floor((deadline % (1000 * 60 * 60)) / (1000 * 60));
  var sek = Math.floor((deadline % (1000 * 60)) / 1000);

  document.getElementById("jetzt_anhören").innerHTML = tagen + "d " + stu + "h " + min + "m ";

  if (deadline < 0) {
    clearInterval(interval_für_countdown);
    document.getElementById("countdown").style.top = "85px";

    let btn = document.getElementById("button_m");
    btn.style.backgroundColor = "white";
    btn.disabled = false;
    document.getElementById("jetzt_anhören").innerHTML = "jetzt hören";
    veroeffentlichungsdatum_des_Al.innerHTML = "Hören Sie sich unser Album jetzt an <br /> und geben Sie uns dabei Ihr Feedback";

  }
}

let interval_für_countdown = setInterval(release_countdown, 1000);



