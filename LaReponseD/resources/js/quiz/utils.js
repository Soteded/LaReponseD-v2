

const selectPage = () => {
  const hash = document.location.hash.replace("#", "");
  const path = hash.split("/");
  switch (path[0]) {
    case "question":
      utils.showPage("question");
      utils.fill(id);
      break;
    default:
    case "quiz":
      utils.showPage("quiz");
      break;
  }
};

const utils = {
    showPage: pageId => {
      const pages = document.getElementsByClassName("page");
      for (let i = 0; i < pages.length; i++) {
        const page = pages[i];
        if (page.id == pageId) page.style.display = "";
        else page.style.display = "none";
      }
    },
    fill: (id) => {
      document.getElementById("numQuestion").innerText = id;
    }
  };
  
window.addEventListener("load", selectPage);
window.addEventListener("hashchange", selectPage);