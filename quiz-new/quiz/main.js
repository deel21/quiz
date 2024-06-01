let currentQuestionIndex = 0;
let rightAnswers = 0;


// Initially hide the Next button
document.getElementById('next-btn').style.display = 'none';



function checkAnswer(btn, correctAnswer) {
    const selectedAnswer = btn.getAttribute("name");
    document.getElementById("user-choice").value = selectedAnswer;
    //Show the Next button only if it's not the second question
    //if (currentQuestionIndex !== 1) {
        document.getElementById('next-btn').style.display = 'block';
    //}

    // Check if the selected answer is correct
    if (selectedAnswer === correctAnswer) {
        btn.classList.add('correct');
        rightAnswers++;
    } else {
        btn.classList.add('incorrect');

        // Find the correct answer button and add 'correct' class to it
        const answerButtons = document.querySelectorAll('.btn-option');
        answerButtons.forEach(answerBtn => {
            if (answerBtn.getAttribute("name") === correctAnswer) {
                answerBtn.classList.add('correct');
            }
        });

       
    }

    if (currentQuestionIndex === 1) {
       // alert('Wrong answer!');
        // Hide the Next button if it's the second question
        // document.getElementById('next-btn').style.display = 'none';
        document.getElementById('next-btn').innerText = "Show Result";

    }
}


