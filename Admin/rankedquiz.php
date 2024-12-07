<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Ranked Levels</title>
    <link rel="stylesheet" href="rankedquiz.css">
    <?php include '../Constants/Combine-admin.php'; ?>
</head>
<body>
    <div class="container">
        <h1 class="page-title">Quizzes</h1>
        <div class="content">
            <div class="levels" id="levels-container">
                <!-- Existing levels will be loaded here -->
            </div>
            <div class="actions">
                <button id="add-level-btn">Add New Level</button>
                <button id ="delete-level-btn">Delete Level</button>
                <button id="edit-level-btn">Edit Quiz</button>
            </div>
        </div>
    </div>

    <script>
        // Function to save levels to localStorage
        function saveLevels() {
            const levelsContainer = document.getElementById('levels-container');
            const levels = Array.from(levelsContainer.querySelectorAll('.level')).map(level => level.textContent.trim());
            localStorage.setItem('levels', JSON.stringify(levels));
        }

        // Function to load levels from localStorage
        function loadLevels() {
            const levelsContainer = document.getElementById('levels-container');
            const savedLevels = JSON.parse(localStorage.getItem('levels'));

            if (savedLevels) {
                levelsContainer.innerHTML = ''; // Clear existing levels
                savedLevels.forEach(levelText => {
                    const newLevel = document.createElement('button');
                    newLevel.classList.add('level');
                    newLevel.textContent = levelText;
                    levelsContainer.appendChild(newLevel);

                    // Add click event to mark as selected
                    addLevelClickListener(newLevel);
                });
            }
        }

        // Add click listener to mark level as selected
        function addLevelClickListener(level) {
            level.addEventListener('click', function () {
                // Remove 'selected' class from all levels
                document.querySelectorAll('.level').forEach(level => level.classList.remove('selected'));
                // Add 'selected' class to clicked level
                this.classList.add('selected');
            });
        }

        // Add New Level Button
        document.getElementById('add-level-btn').addEventListener('click', function () {
            const levelsContainer = document.getElementById('levels-container');
            const levels = document.querySelectorAll('.level');
            let lastLevelNumber = 0;

            levels.forEach(level => {
                const levelText = level.textContent.trim();
                if (levelText.startsWith('Level')) {
                    const number = parseInt(levelText.split(' ')[1]);
                    if (number > lastLevelNumber) {
                        lastLevelNumber = number;
                    }
                }
            });

            const confirmAdd = confirm(`Are you sure you want to add Level ${lastLevelNumber + 1}?`);

            if (confirmAdd) {
                const newLevel = document.createElement('button');
                newLevel.classList.add('level');
                newLevel.textContent = `Level ${lastLevelNumber + 1}`;
                levelsContainer.appendChild(newLevel);

                addLevelClickListener(newLevel); // Add click listener
                saveLevels(); // Save levels
            }
        });

        // Delete Level Button
        document.getElementById('delete-level-btn').addEventListener('click', function () {
            const levels = Array.from(document.querySelectorAll('.level'));
            const selectedLevel = document.querySelector('.level.selected');

            if (levels.length === 0) {
                alert('No levels to delete.');
                return;
            }

            const latestLevel = levels[levels.length - 1];

            if (selectedLevel) {
                const levelText = selectedLevel.textContent.trim();

                if (selectedLevel !== latestLevel) {
                    alert('You can only delete the latest level.');
                    return;
                }

                const confirmDelete = confirm(`Are you sure you want to delete ${levelText}?`);

                if (confirmDelete) {
                    selectedLevel.remove();
                    saveLevels();
                }
            } else {
                alert('Please select a level to delete.');
            }
        });

        // Edit Level Button
        document.getElementById('edit-level-btn').addEventListener('click', function () {
            const selectedLevel = document.querySelector('.level.selected');

            if (selectedLevel) {
                const levelText = selectedLevel.textContent.trim();
                window.location.href = `addranked.php?level=${encodeURIComponent(levelText)}`;
            } else {
                alert('Please select a level to edit.');
            }
        });


        // Load levels on page load
        window.addEventListener('load', function () {
            loadLevels();
        });

    </script>
</body>
</html>
