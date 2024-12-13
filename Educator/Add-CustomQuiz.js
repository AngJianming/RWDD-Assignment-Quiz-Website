// add_quiz.js

document.addEventListener('DOMContentLoaded', () => {
    const addQuestionBtn = document.getElementById('addQuestionBtn');
    const questionsContainer = document.getElementById('questionsContainer');

    // Function to create a new question block
    function createQuestionBlock(index) {
        const questionBlock = document.createElement('div');
        questionBlock.classList.add('question-block');

        questionBlock.innerHTML = `
            <h3>Question ${index + 1}</h3>
            <div class="form-group">
                <label>Question Text:</label>
                <textarea name="questions[${index}][question_text]" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label>Option A:</label>
                <input type="text" name="questions[${index}][option_A]" required>
            </div>
            <div class="form-group">
                <label>Option B:</label>
                <input type="text" name="questions[${index}][option_B]" required>
            </div>
            <div class="form-group">
                <label>Option C:</label>
                <input type="text" name="questions[${index}][option_C]" required>
            </div>
            <div class="form-group">
                <label>Option D:</label>
                <input type="text" name="questions[${index}][option_D]" required>
            </div>
            <div class="form-group">
                <label>Correct Option:</label>
                <select name="questions[${index}][correct_option]" required>
                    <option value="">--Select Correct Option--</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>
            <button type="button" class="remove-question">Remove Question</button>
            <hr>
        `;

        return questionBlock;
    }

    // Add initial question blocks if none exist
    if (questionsContainer.children.length === 0) {
        for (let i = 0; i < 5; i++) {
            const questionBlock = createQuestionBlock(i);
            questionsContainer.appendChild(questionBlock);
        }
    }

    // Event listener to add new questions
    addQuestionBtn.addEventListener('click', () => {
        const currentQuestions = questionsContainer.querySelectorAll('.question-block').length;
        const newQuestion = createQuestionBlock(currentQuestions);
        questionsContainer.appendChild(newQuestion);
    });

    // Event delegation for removing questions
    questionsContainer.addEventListener('click', (e) => {
        if (e.target && e.target.classList.contains('remove-question')) {
            const questionBlocks = questionsContainer.querySelectorAll('.question-block');
            if (questionBlocks.length > 5) { // Ensure at least 5 questions
                e.target.parentElement.remove();
                // Update question numbers
                const remainingQuestions = questionsContainer.querySelectorAll('.question-block');
                remainingQuestions.forEach((block, index) => {
                    block.querySelector('h3').textContent = `Question ${index + 1}`;
                    // Update input names
                    const inputs = block.querySelectorAll('input, textarea, select');
                    inputs.forEach(input => {
                        const name = input.getAttribute('name');
                        if (name) {
                            const newName = name.replace(/questions\[\d+\]/, `questions[${index}]`);
                            input.setAttribute('name', newName);
                        }
                    });
                });
            } else {
                alert('A quiz must have at least 5 questions.');
            }
        }
    });
});
