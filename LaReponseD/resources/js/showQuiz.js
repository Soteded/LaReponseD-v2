const utils = {
    showPage: pageId => {
      const pages = document.getElementsByClassName("page");
      for (let i = 0; i < pages.length; i++) {
        const page = pages[i];
        if (page.id == pageId) page.style.display = "";
        else page.style.display = "none";
      }
    },
  };


const selectPage = () => {
    $('#buttonShow').click( function() {
      $('.showCommentaires').slideToggle();
    })
    const hash = document.location.hash.replace("#", "");
    switch (hash) {
        case "report":
            utils.showPage(hash);
            break;
        case "participe":
            utils.showPage(hash);
            break;
        case "commentaire":
            utils.showPage(hash);
            break;
        default:
            case "show":
                utils.showPage("show");
                break;
    }
};


window.addEventListener("load", selectPage);
window.addEventListener("hashchange", selectPage);