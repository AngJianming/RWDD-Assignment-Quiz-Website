let totalQuestions = document.querySelectorAll('.question').length;
let answeredQuestions = 0;

// Update the total number of questions
document.getElementById('totalQuestions').textContent = totalQuestions;

function answerQuestion(questionId) {
    const questionElement = document.querySelector(`.question[data-question-id='${questionId}']`);
    questionElement.style.display = 'none';  // Hide answered question
    answeredQuestions++;

    // Update progress bar
    const progressPercentage = (answeredQuestions / totalQuestions) * 100;
    document.getElementById('progress').style.width = `${progressPercentage}%`;
    document.getElementById('progress').textContent = `${Math.round(progressPercentage)}%`;
    document.getElementById('currentQuestion').textContent = answeredQuestions + 1;

    if (answeredQuestions === totalQuestions) {
        alert("Congratulations! You've completed the quiz.");
    }
}