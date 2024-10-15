function startQuiz() {
  // Add logic here to start the quiz
  // Redirect to quiz page or show quiz questions
  window.location.href = "quiz.html";
}

function openProfile() {
  window.location.href = "profile.php";
}

function goHome() {
  window.location.href = "welcome.php";
}

function openAbout() {
  window.location.href = "info.html";
}

const range = document.querySelector("input[type='range']");
const content = document.querySelector(".main-container");
range.addEventListener("input", function () {
  const rangevalue = range.value;
  content.style.fontSize = rangevalue + "px";
});
