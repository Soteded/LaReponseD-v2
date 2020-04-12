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

  $('#searchInput').keyup(function () {
    // Declare variables
    let input, filter, div, li, a, i, txtValue;
    input = document.getElementById('searchInput');
    filter = input.value.toUpperCase();
    div = document.getElementById("searchResult");
    li = div.getElementsByClassName('searchElement');

    let totalHide = 0;
  
    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
      a = li[i].getElementsByClassName("quizTitre")[0];
      txtValue = a.textContent || a.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        li[i].style.display = "";
      } else {
        li[i].style.display = "none";
      }
    }
  })

  let prevSearch = "";

  $('.searchSort').click(function () {
    let active = document.getElementsByClassName('btn-primary');
    active[0].classList.add('btn-secondary');
    active[0].classList.remove('btn-primary');

    let self = this;

    let quizBucket = new Array();
    let quizList = $$('div.searchElement');

    for (let i = 0; i < quizList.length; i++) {
      let obj = {
        created_at: quizList[i].getElementsByClassName('created_at')[0].textContent,
        titre: quizList[i].getElementsByClassName('quizTitre')[0].textContent,
        Creator: quizList[i].getElementsByClassName('creator')[0].textContent,
        compteur: quizList[i].getElementsByClassName('compteur')[0].textContent,
        noteAvg: quizList[i].getElementsByClassName('noteAvg')[0].textContent,
      };

      quizBucket[i] = new Array();

      quizBucket[i][0] = obj;
      quizBucket[i][1] = quizList[i].dispose();
    }

    self.classList.remove('btn-secondary');
    self.classList.add('btn-primary');

    if (self.id == prevSearch) {
      switch (self.id) {
        case 'compteur':
        case 'noteAvg':
          quizBucket.sort(function (a,b) {
            return b[0][self.id]-a[0][self.id];
          });
          break;
      
        default:
          quizBucket.sort(function(a, b) {
            if (a[0][self.id].toLowerCase() === b[0][self.id].toLowerCase()) {
              return 0;
            }
            if (a[0][self.id].toLowerCase() > b[0][self.id].toLowerCase()) {
              return -1;
            } else {
              return 1;
            }
          });
          break;
      }

      prevSearch = "";

    } else {
      switch (self.id) {
        case 'compteur':
        case 'noteAvg':
          quizBucket.sort(function (a,b) {
            return a[0][self.id]-b[0][self.id];
          });
          break;
      
        default:
          quizBucket.sort(function(a, b) {
            if (a[0][self.id].toLowerCase() === b[0][self.id].toLowerCase()) {
              return 0;
            }
            if (a[0][self.id].toLowerCase() > b[0][self.id].toLowerCase()) {
              return 1;
            } else {
              return -1;
            }
          });
          break;
      }

      prevSearch = self.id;
    }

    // re-inject sorted divs into page
    for (let i = 0; i < quizList.length; i++) {
      quizBucket[i][1].inject(document.getElementById('searchResult'));
    }
  })
});