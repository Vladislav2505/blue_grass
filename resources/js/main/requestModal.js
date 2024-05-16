const requestButtons = document.querySelectorAll('.request-modal-open');

if (requestButtons.length !== 0) {
    requestButtons.forEach(function (button) {
        button.addEventListener('click', openModal);
    })

    document.getElementById('requestModalClose').addEventListener('click', closeModal);
    document.getElementById('requestForm').addEventListener('submit', submitForm);

    const messageBlock = document.getElementById('requestFormMessage');

    function openModal() {
        const modal = document.getElementById('requestModal');

        if (modal) {
            messageBlock.classList.add('hidden');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.querySelector('body').classList.add('overflow-y-hidden')
            setTimeout(function () {
                modal.querySelector('.bg-white').classList.remove('opacity-0', 'scale-95');
            }, 50);
        }
    }

    function closeModal() {
        const modal = document.getElementById('requestModal');

        if (modal) {
            modal.querySelector('.bg-white').classList.add('opacity-0', 'scale-95');

            setTimeout(function () {
                document.querySelector('body').classList.remove('overflow-y-hidden')
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

        const personalData = document.getElementById('request-personal-data');

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
