import {closeModal, openModal, submitForm} from "./ajaxForms.js";

const formName = 'question';
const questionButtons = document.querySelectorAll('.question-modal-open');

if (questionButtons.length !== 0) {
    questionButtons.forEach(function (button) {
        button.addEventListener('click', () => openModal(formName));
    })

    document.getElementById('questionModalClose')
        .addEventListener('click', () => closeModal(formName));
    document.getElementById('questionForm')
        .addEventListener('submit', (event) => submitForm(event, formName));
}
