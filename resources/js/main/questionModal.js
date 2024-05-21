const questionButtons = document.querySelectorAll('.question-modal-open');

if (questionButtons.length !== 0) {
    questionButtons.forEach(function (button) {
        button.addEventListener('click', openModal);
    })

    document.getElementById('questionModalClose').addEventListener('click', closeModal);
    document.getElementById('questionForm').addEventListener('submit', submitForm);

    const messageBlock = document.getElementById('questionFormMessage');

    function openModal() {
        const modal = document.getElementById('questionModal');

        if (modal) {
            messageBlock.classList.add('hidden');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.querySelector('body').classList.add('hide-scroll')
            setTimeout(function () {
                modal.querySelector('.bg-white').classList.remove('opacity-0', 'scale-95');
            }, 50);
        }
    }

    function closeModal() {
        const modal = document.getElementById('questionModal');

        if (modal) {
            modal.querySelector('.bg-white').classList.add('opacity-0', 'scale-95');

            setTimeout(function () {
                document.querySelector('body').classList.remove('hide-scroll')
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                messageBlock.innerHTML = '';
            }, 300);
        }
    }

    function submitForm(event) {
        event.preventDefault();

        messageBlock.innerHTML = '';
        messageBlock.classList.remove('hidden');

        const personalData = document.getElementById('question-personal-data');

        if (personalData && !personalData.checked) {
            showErrors('Вы должны дать согласие на обработку персональных данных');
            return;
        }

        const formData = new FormData(this);

        axios.post(this.action, Object.fromEntries(formData))
            .then(response => {
                showSuccess(response.data.success);
                this.reset();
            })
            .catch(error => {
                if (error.response.status === 422) {
                    const errors = error.response.data.errors;
                    const errorMessages = Object.values(errors)
                        .flatMap(errorArray => errorArray.map(error => `${error}`));

                    showErrors(errorMessages)
                } else {
                    const errorMsg = error.response.data.error;
                    showErrors(errorMsg);
                }
            })
    }

    function showErrors(message) {
        messageBlock.textContent = '';

        messageBlock.classList.add('text-error');
        if (messageBlock.classList.contains('text-success')) {
            messageBlock.classList.remove('text-success');
        }

        if (Array.isArray(message)) {
            for (const msg of message) {
                messageBlock.appendChild(document.createElement('p')).textContent = msg;
            }
        } else {
            messageBlock.textContent = message;
        }
    }

    function showSuccess(message) {
        messageBlock.textContent = '';

        messageBlock.classList.add('text-success');
        if (messageBlock.classList.contains('text-error')) {
            messageBlock.classList.remove('text-error');
        }

        messageBlock.textContent = message;
    }
}
