function isLinkActive(linkPath) {
  var currentPath = window.location.pathname;
  return currentPath === linkPath;
}

// Get all the links in the sidebar
var links = document.querySelectorAll("#sidebar a");

// Check each link to see if it should be active
links.forEach(function (link) {
  if (isLinkActive(link.getAttribute("href"))) {
    link.parentElement.classList.add("active");
  } else {
    link.parentElement.classList.remove("active");
  }
});
