const searchForm = document.querySelector(".navbar__searchArea");
const bottomRow = document.querySelector(".navbar__bottomRow");
const navbarRightArea = document.querySelector(".navbar__rightArea");
const navToggleBtn = document.querySelector(".navbar__toggleBtn");
const navbarRightAreaLinks = document.querySelectorAll(".navbar__userLinks");
const navbar = document.querySelector(".navbar");
const navbarTopRow = document.querySelector(".navbar__topRow");

const hr = document.createElement("hr");
const bottomSearchForm = searchForm.cloneNode(true);
bottomSearchForm.id = "searchForm";

window.onload = () => {
  bottomRow.prepend(bottomSearchForm);
};
window.onresize = () => showHideLinks();

navToggleBtn.addEventListener("click", () => {
  bottomRow.classList.toggle("show");
  navToggleBtn.classList.toggle("active");
  showHideLinks();
});

const showHideLinks = () => {
  bottomRow.append(hr);
  navbarRightAreaLinks.forEach((link) => {
    window.innerWidth < 500
      ? bottomRow.append(link)
      : navbarRightArea.prepend(link);
  });
};

let previousPagePosition =
  window.scrollY ||
  window.scrollTop ||
  document.getElementsByTagName("html")[0].scrollTop;

window.onscroll = () => {
  let presentScrollPos =
    window.scrollY ||
    window.scrollTop ||
    document.getElementsByTagName("html")[0].scrollTop;

  presentScrollPos > 0
    ? (navbarTopRow.style.height = "70px")
    : (navbarTopRow.style.height = "100px");

  if (presentScrollPos > window.innerHeight) {
    navbar.style.position = "fixed";
    previousPagePosition < presentScrollPos
      ? (navbar.style.top = "-100%")
      : (navbar.style.top = "0");
  } else {
    navbar.style.position = "sticky";
    navbar.style.top = "0";
  }

  previousPagePosition = presentScrollPos;
};
