document.querySelectorAll(".--msgs .alert").forEach((alert) => {
  alert.querySelector("button").addEventListener("click", (e) => {
    e.preventDefault();
    alert.remove();
  });
});
