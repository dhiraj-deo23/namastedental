const date = (document.getElementById(
 "date"
).innerHTML = new Date().getFullYear());

const navbtn = document.getElementById("nav-toggle");
const links = document.getElementById("nav-links");

navbtn.addEventListener("click", () => {
 links.classList.toggle("show-links");
});

const navbar = document.querySelector(".navbar");

window.addEventListener("scroll", () => {
 if (window.pageYOffset > 157.19) {
  navbar.classList.add("fixed");
 } else {
  navbar.classList.remove("fixed");
 }
});

const scrollinks = document.querySelectorAll(".scroll-link");
scrollinks.forEach((link) => {
 link.addEventListener("click", (e) => {
  e.preventDefault();
  links.classList.remove("show-links");
  const id = e.target.getAttribute("href").slice(1);
  const element = document.getElementById(id);
  let position;
  if (navbar.classList.contains("fixed")) {
   position = element.offsetTop - 80 + 60.19;
  } else {
   position = element.offsetTop - 160;
  }
  if (window.innerWidth < 1072) {
   if (navbar.classList.contains("fixed")) {
    position = element.offsetTop - 80 + 60.19;
   } else {
    position = element.offsetTop - 270 - 80 + 77.19;
   }
  }
  window.scrollTo({
   left: 0,
   top: element.offsetTop,
   behavior: "smooth",
  });
 });
});
