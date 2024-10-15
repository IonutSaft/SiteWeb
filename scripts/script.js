let isDarkMode = false;

function toggleTheme() {
  const themeToggleBtn = document.getElementById("themeToggle");
  const container = document.querySelector(".container");

  if (isDarkMode) {
    document.documentElement.style.setProperty("--bg-color", "#f9f9f9");
    document.documentElement.style.setProperty("--text-color", "#000");
    document.documentElement.style.setProperty("--container-bg", "#fff");
    document.documentElement.style.setProperty("--btn-bg-color", "#007bff");
    document.documentElement.style.setProperty("--btn-text-color", "#fff");
    document.documentElement.style.setProperty(
      "--btn-hover-bg-color",
      "#0056b3"
    );
    document.documentElement.style.setProperty("--link-color", "#007bff");
    themeToggleBtn.textContent = "🌙 Dark Mode";
  } else {
    document.documentElement.style.setProperty("--bg-color", "#333");
    document.documentElement.style.setProperty("--text-color", "#fff");
    document.documentElement.style.setProperty("--container-bg", "#444");
    document.documentElement.style.setProperty("--btn-bg-color", "#555");
    document.documentElement.style.setProperty("--btn-text-color", "#fff");
    document.documentElement.style.setProperty("--btn-hover-bg-color", "#777");
    document.documentElement.style.setProperty("--link-color", "#9cf");
    themeToggleBtn.textContent = "☀️ Light Mode";
  }

  // Update theme for the theme toggle button itself
  themeToggleBtn.style.backgroundColor = getComputedStyle(
    document.body
  ).getPropertyValue("--bg-color");
  themeToggleBtn.style.color = getComputedStyle(document.body).getPropertyValue(
    "--text-color"
  );

  isDarkMode = !isDarkMode;
}

function cancel() {
  window.location.href = "login.php";
}
