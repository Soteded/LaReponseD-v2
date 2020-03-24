"use strict";

$('document').ready(function () {
    $('.userDetail').click(function () {
    let divs = document.getElementsByClassName('userDetail');
    let infoId = 'infos';

    [].slice.call(divs).forEach(function (div) {
        div.innerHTML = '<i class="fas fa-plus"></i>';
        document.getElementById(infoId.concat(div.id)).style.display = "none";
    });

    document.getElementById(infoId.concat(this.id)).style.display = "flex";
    document.getElementById(this.id).innerHTML = '<i class="fas fa-minus"></i>';
  });
});