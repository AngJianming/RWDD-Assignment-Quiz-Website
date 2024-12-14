function moveToNext(currentInput, nextBoxId) {
    // Allow only numbers
    currentInput.value = currentInput.value.replace(/[^0-9]/g, '');
    
    // Check if the current input has a value
    if (currentInput.value.length === 1) {
        // Move focus to the next input box
        const nextInput = document.getElementById(nextBoxId);
        if (nextInput) {
            nextInput.focus();
        }
    }
}

function handleBackspace(event, currentBoxId) {
    if (event.key === 'Backspace') {
        const currentInput = document.getElementById(currentBoxId);
        // If the current input is empty, remove it and focus the previous box
        if (currentInput.value === '') {
            // Move focus to the previous input box
            const previousBoxId = currentInput.previousElementSibling ? currentInput.previousElementSibling.id : null;
            if (previousBoxId) {
                const previousInput = document.getElementById(previousBoxId);
                previousInput.value = ''; // Clear the value in the previous box
                previousInput.focus(); // Move focus to the previous box
            }
        }
    }
}