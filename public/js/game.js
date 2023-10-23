let count = 0;
let currentQuestion;

$(document).ready(function () {
    loadNewQuestion();
});
document.addEventListener("DOMContentLoaded", function () {
    var option1 = document.getElementById("option1");
    var option2 = document.getElementById("option2");
    var option3 = document.getElementById("option3");
    var option4 = document.getElementById("option4");

    option1.addEventListener("click", function () {
        setTimeout(function () {
            submitOption(option1.value);
        }, 500);
    });
    option2.addEventListener("click", function () {
        setTimeout(function () {
            submitOption(option2.value);
        }, 500);
    });
    option3.addEventListener("click", function () {
        setTimeout(function () {
            submitOption(option3.value);
        }, 500);
    });
    option4.addEventListener("click", function () {
        setTimeout(function () {
            submitOption(option4.value);
        }, 500);
    });
});

function loadNewQuestion() {
    $('#resultAnswer').text("");
    fetch('http://localhost:8181/partida/getQuestion', {
        method: 'GET'
    })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Error al llamar al controlador');
            }
        })
        .then(data => {
            console.log(data);
            setQuestionData(data,count);
            currentQuestion = data;
        })
        .catch(error => {
            console.error(error);
        });
}
function submitOption(value) {
    if(value == currentQuestion.correct_option){
        $('#resultAnswer').text("¡Correcto!");
        count++;
        setTimeout(function() {
            loadNewQuestion()
        }, 1000);

    }else{
        $('#resultAnswer').text("¡Perdiste!");
        count=0;
        setTimeout(function() {
        window.location.href = '/partida/';
        }, 1000);
    }
}

function setQuestionData(question, count) {
    $('#questionDescription').text(question.description);
    $('#option1').text(question.option_1);
    $('#option2').text(question.option_2);
    $('#option3').text(question.option_3);
    $('#option4').text(question.option_4);
    $('#countCorrectAnswer').text("Respuestas correctas: " + count);
    setContainerColor(question.idCategory);
}
function setContainerColor(category) {
    switch (category) {
        case '1':
            $('#questionContainer').css('background-color', '#0eff97');
            $('#nameCategory').text("Categoría 1");
            break;
        case '2':
            $('#questionContainer').css('background-color', '#ffe35c');
            $('#nameCategory').text("Categoría 2");
            break;
        default:
            $('#questionContainer').css('background-color', '#c5c5c5');
            $('#nameCategory').text("Sin categoría");
            break;
    }
}