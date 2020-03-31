"use strict";

$('document').ready(function () {
  let prev = '';
  $('.userDetail').click(function () {
    let divs = document.getElementsByClassName('userDetail');
    let infoId = 'infos';

    [].slice.call(divs).forEach(function (div) {
      div.innerHTML = '<i class="fas fa-plus"></i>';
      document.getElementById(infoId.concat(div.id)).style.display = "none";
    });

    if (prev == this.id) {
      document.getElementById(infoId.concat(this.id)).style.display = "none";
      document.getElementById(this.id).innerHTML = '<i class="fas fa-plus"></i>';
      prev = '';
    } else {
      document.getElementById(infoId.concat(this.id)).style.display = "flex";
      document.getElementById(this.id).innerHTML = '<i class="fas fa-minus"></i>';
      prev = this.id;
    }
  });

  let prev2 = '';
  $('.quizDetail').click(function () {
    let divs2 = document.getElementsByClassName('quizDetail');
    let info2Id = 'infosQ';

    [].slice.call(divs2).forEach(function (div) {
      div.innerHTML = '<i class="fas fa-plus"></i>';
      document.getElementById(info2Id.concat(div.id)).style.display = "none";
    });

    if (prev2 == this.id) {
      document.getElementById(info2Id.concat(this.id)).style.display = "none";
      document.getElementById(this.id).innerHTML = '<i class="fas fa-plus"></i>';
      prev2 = '';
    } else {
      document.getElementById(info2Id.concat(this.id)).style.display = "flex";
      document.getElementById(this.id).innerHTML = '<i class="fas fa-minus"></i>';
      prev2 = this.id;
    }
  });
});