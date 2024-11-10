function getLatestHighScorer() {
    if (leaderboard.length === 0) return "No student yet.";

    // Sort by score (descending), then by date (most recent first)
    const sortedLeaderboard = leaderboard.sort((a, b) => {
        if (b.score === a.score) return b.date - a.date; // latest date for same score
        return b.score - a.score;
    });

    const latestHighScorer = sortedLeaderboard[0];
    return `Latest High Scorer: ${latestHighScorer.studnet_username} | ${latestHighScorer.score} | ${latestHighScorer.level}`; //which level they are on
}

console.log(getLatestHighScorer());

const leaderboard = document.getElementById("leaderboard");
const rankingTemplate = document.getElementById("ranking-template");

// Function to clear the leaderboard
function clearLeaderboard() {
    while (leaderboard.firstChild) {
        leaderboard.removeChild(leaderboard.firstChild);
    }
}

// Function to update the leaderboard
function updateLeaderboard (student) {
    // Sort student by power in descending order
    student.sort((student1, student2) => student2.power - student1.power);

    // Loop through the sorted student and display their rank, name, and power
    student.forEach((student, index) => {
        const rank = index + 1;

        // Clone the template element for each player
        const template = rankingTemplate.cloneNode(true);
        template.querySelector(".rank").textContent = `${rank}.`;
        template.querySelector(".student_username").textContent = studnet_username;
        template.querySelector(".power-value").textContent = student.power;

        // Append the player entry to the leaderboard
        leaderboard.appendChild(template);
    });
}

// Example only is not going to be in database
const student = [
    { name: "Student1", points: 1500 },
    { name: "Student2", points: 2000 },
    { name: "Student3", points: 1800 },
];

// Update leaderboard every second (similar to the Lua script's task.wait loop)
setInterval(() => {
    clearLeaderboard();
    updateLeaderboard (student);
}, 1000);