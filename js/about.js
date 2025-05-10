// Show scroll-to-top button when user scrolls down
window.addEventListener('scroll', function () {
  const btn = document.getElementById("scrollTopBtn");
  if (window.pageYOffset > 300) {
    btn.style.display = "block";
  } else {
    btn.style.display = "none";
  }
});

// Scroll to top smoothly when button is clicked
document.getElementById("scrollTopBtn").addEventListener("click", function () {
  window.scrollTo({
    top: 0,
    behavior: "smooth"
  });
});