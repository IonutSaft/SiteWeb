function goHome() {
  window.location.href = "welcome.php";
}

function background1() {
  document.querySelector("body").style.background =
    "url('images/bg1.jpg') center center/cover no-repeat fixed";
}
function background2() {
  document.querySelector("body").style.background =
    "url('images/bg2.jpg') center center/cover no-repeat fixed";
}
function background3() {
  document.querySelector("body").style.background =
    "url('images/bg3.jpg') center center/cover no-repeat fixed";
}
function background4() {
  document.querySelector("body").style.background =
    "url('images/bg4.jpg') center center/cover no-repeat fixed";
}

const quizData = [
  {
    question:
      "What is the name of Funny Valentine's stand in Jojo's Bizarre Adventure Part 7, Steel Ball Run?",
    options: [
      "Dirty Deeds Done Dirt Cheap",
      "Filthy Acts Done For A Reasonable Price",
      "Civil War",
      "God Bless The USA",
    ],
    correctAnswer: "Dirty Deeds Done Dirt Cheap",
  },
  {
    question:
      "What is the last name of Edward and Alphonse in the Fullmetal Alchemist series.",
    options: ["Ellis", "Eliek", "Elric", "Elwood"],
    correctAnswer: "Elric",
  },
  {
    question:
      'In "Future Diary", what is the name of Yuno Gasai\'s Phone Diary?',
    options: [
      "Murder Diary",
      "Yukiteru Diary",
      "Escape Diary",
      "Justice Diary",
    ],
    correctAnswer: "Yukiteru Diary",
  },
  {
    question: 'What year did "Attack on Titan" first air?',
    options: ["2012", "2013", "2014", "2015"],
    correctAnswer: "2013",
  },
  {
    question:
      'Which animation studio animated the 2016 anime "Mob Psycho 100"?',
    options: ["A-1 Pictures", "Madhouse", "Shaft", "Bones"],
    correctAnswer: "Bones",
  },
  {
    question:
      'Who wrote and directed the animated movie "Spirited Away" (2001)?',
    options: [
      "Hayao Miyazaki",
      "Isao Takahata",
      "Mamoru Hosoda",
      "Hidetaka Miyazaki",
    ],
    correctAnswer: "Hayao Miyazaki",
  },
  {
    question:
      'Which Japanese music group was formed to produce theme music for the anime "Guilty Crown"?',
    options: ["Goose house", "Garnidelia", "Egoist", "Babymetal"],
    correctAnswer: "Egoist",
  },
  {
    question:
      'In the anime "Assassination Classroom" what is the class that Koro-sensei teaches?',
    options: ["Class 3-A", "Class 3-B", "Class 3-D", "Class 3-E"],
    correctAnswer: "Class 3-E",
  },
  {
    question: 'In the "Overlord" Anime who was Cocytus made by',
    options: [
      "Peroroncino",
      "Bukubukuchagama",
      "Warrior Takemikazuchi",
      "Ulbert Alain Odle",
    ],
    correctAnswer: "Warrior Takemikazuchi",
  },
  {
    question:
      'In "Hunter x Hunter", which of the following is NOT a type of Nen aura?',
    options: ["Emission", "Transmutation", "Specialization", "Restoration"],
    correctAnswer: "Restoration",
  },
];

let currentQuestion = 0;
let score = 0;
let autoProgress = false;

const quizContainer = document.getElementById("quizContainer");
const questionNumberElement = document.getElementById("questionNumber");
const scoreElement = document.getElementById("score");
const questionTextElement = document.getElementById("questionText");
const answerOptionsElement = document.getElementById("answerOptions");
const nextButton = document.getElementById("nextButton");
const quizResultElement = document.getElementById("quizResult");
const resultTextElement = document.getElementById("resultText");
const finalScoreElement = document.getElementById("finalScore");
const autoProgressToggle = document.getElementById("autoProgressToggle");

// Function to initialize quiz
function initializeQuiz() {
  displayQuestion();
  nextButton.addEventListener("click", () => {
    displayNextQuestion();
  });

  // Event listener for retake quiz button
  const retakeButton = document.getElementById("retakeButton");
  retakeButton.addEventListener("click", () => {
    resetQuiz();
  });

  // Event listener for auto progress toggle
  autoProgressToggle.addEventListener("change", () => {
    autoProgress = autoProgressToggle.checked;
  });
}

// Function to reset quiz state
function resetQuiz() {
  currentQuestion = 0;
  score = 0;
  quizContainer.classList.remove("d-none");
  quizResultElement.classList.add("d-none");
  updateScore();
  displayQuestion();
}

// Function to display current question
function displayQuestion() {
  const currentQuizData = quizData[currentQuestion];
  const totalQuestions = quizData.length;
  questionNumberElement.textContent = `Question ${
    currentQuestion + 1
  }/${totalQuestions}`;
  questionTextElement.textContent = currentQuizData.question;
  answerOptionsElement.innerHTML = "";
  currentQuizData.options.forEach((option, index) => {
    const button = document.createElement("button");
    button.textContent = option;
    button.classList.add("btn", "btn-dark", "mb-2");
    button.addEventListener("click", () => {
      checkAnswer(button, currentQuizData.correctAnswer);
      if (autoProgress) {
        displayNextQuestion();
      }
    });
    answerOptionsElement.appendChild(button);
  });
}

// Function to check answer
function checkAnswer(button, correctAnswer) {
  if (button.textContent === correctAnswer) {
    button.classList.add("btn-correct");
    score++;
  } else {
    button.classList.add("btn-incorrect");
    answerOptionsElement.querySelectorAll("button").forEach((btn) => {
      if (btn.textContent === correctAnswer) {
        btn.classList.add("btn-correct");
      }
    });
  }
  updateScore();
  disableAnswerButtons();
}

// Function to display next question
function displayNextQuestion() {
  currentQuestion++;
  if (currentQuestion < quizData.length) {
    displayQuestion();
  } else {
    showQuizResult();
  }
}

// Function to update score display
function updateScore() {
  scoreElement.textContent = `Score: ${score}`;
}

// Function to disable answer buttons after selection
function disableAnswerButtons() {
  answerOptionsElement.querySelectorAll("button").forEach((button) => {
    button.disabled = true;
  });
}

// Function to show quiz result
function showQuizResult() {
  quizContainer.classList.add("d-none");
  quizResultElement.classList.remove("d-none");
  finalScoreElement.textContent = score;
  if (score >= 7) {
    resultTextElement.textContent = "Congratulations! You did well!";
  } else if (score >= 4) {
    resultTextElement.textContent = "Nice try! Keep practicing!";
  } else {
    resultTextElement.textContent = "Whomp whomp!";
  }
}

// Initialize the quiz when the page is loaded
document.addEventListener("DOMContentLoaded", initializeQuiz);
