const utils = {
    showPage: pageId => {
      const pages = document.getElementsByClassName("page");
      for (let i = 0; i < pages.length; i++) {
        const page = pages[i];
        if (page.id == pageId) page.style.display = "";
        else page.style.display = "none";
      }
    },
    showPage2: pageId => {
      const pages = document.getElementsByClassName("page2");
      for (let i = 0; i < pages.length; i++) {
        const page = pages[i];
        if (page.id == pageId) page.style.display = "";
        else page.style.display = "none";
      }
    },
  };

const selectPage = () => {
    const hash = document.location.hash.replace("#", "");
    switch (hash) {
        case "report":
            utils.showPage(hash);
            break;
        case "participe":
            utils.showPage2(hash);
            utils.showPage("participate");
            break;
        case "commentaire":
            utils.showPage(hash);
          	break;
        default:
            case "show":
                utils.showPage2("show");
                utils.showPage("participate");
                break;
    }
};


window.addEventListener("load", selectPage);
window.addEventListener("hashchange", selectPage);