// Получаем ссылки на элементы страницы
let imageInput = document.getElementById('imageInput'); // Поле загрузки изображения

if (imageInput) {
    let submit = document.querySelector('input[type="submit"]'); // Кнопка отправки формы
    let fileList = document.getElementById('fileList'); // Список файлов
    let uploadImages = new DataTransfer(); // Объект для передачи файлов
    const deleteImageButtons = document.querySelectorAll('.delete-image-button'); // Кнопки удаления изображений

    // Добавляем обработчики событий для кнопок удаления изображений
    deleteImageButtons?.forEach(function (button) {
        button?.addEventListener('click', removeFile);
    });

    // Добавляем обработчик события изменения поля загрузки изображения
    imageInput?.addEventListener('change', handleImageInputChange);

    // Добавляем обработчик события клика по кнопке отправки формы
    submit?.addEventListener('click', handleFormSubmit);


    // Функция обработки изменения значения поля загрузки изображения
    function handleImageInputChange() {
        // Если выбран только один файл, очищаем список файлов
        if (!this.multiple && this.files.length >= 1) {
            fileList.innerHTML = '';
        }

        // Добавляем выбранные файлы в список файлов
        for (let i = 0; i < this.files.length; i++) {
            uploadImages.items.add(this.files[i]);
            const fileListItem = createFileListItem(this.files[i]);
            fileList.appendChild(fileListItem);
        }

        // Если разрешена загрузка нескольких файлов, обновляем значение поля загрузки изображения
        if (this.multiple) {
            imageInput.files = uploadImages.files;
        }
    }

    // Функция создания элемента списка файла
    function createFileListItem(file) {
        const listItem = document.createElement('div');
        listItem.classList.add('relative', 'w-24', 'h-24', 'md:w-48', 'md:h-48', 'mr-2', 'mb-2');

        const thumbnail = document.createElement('img');
        thumbnail.classList.add('thumbnail', 'w-full', 'h-full', 'object-cover');
        thumbnail.file = file;
        listItem.appendChild(thumbnail);

        const deleteImageButton = document.createElement('button');
        deleteImageButton.innerHTML = '&#10006;';
        deleteImageButton.className = 'delete-image-button absolute top-0 right-0 p-1 rounded m-2 text-secondary text-center';
        deleteImageButton.file = file;
        deleteImageButton.addEventListener('click', removeFile);
        listItem.appendChild(deleteImageButton);

        const reader = new FileReader();
        reader.onload = function (e) {
            thumbnail.src = e.target.result;
        };
        reader.readAsDataURL(file);

        return listItem;
    }

    // Функция удаления файла из списка и объекта DataTransfer
    function removeFile() {
        const fileToRemove = this.file;
        const files = Array.from(imageInput.files);
        const filteredFiles = files.filter(f => f !== fileToRemove);
        uploadImages = new DataTransfer();
        filteredFiles.forEach(function (file) {
            uploadImages.items.add(file);
        });
        imageInput.files = uploadImages.files;
        this.parentNode.remove();
    }

    // Функция обработки отправки формы
    function handleFormSubmit(event) {
        event.preventDefault(); // Отменяем стандартное действие отправки формы

        // Получаем ссылки на загруженные изображения
        const imageElements = document.querySelectorAll('.loaded-image');
        const imageUrls = Array.from(imageElements).map(image => image.src);

        // Находим ближайшую форму
        const form = event.target.closest('form');

        // Добавляем скрытые поля с ссылками на изображения в форму
        imageUrls.forEach(function (url) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'loadedImages[]'; // Имя поля, которое будет отправлено на сервер
            input.value = url;
            form.appendChild(input);
        });

        // Отправляем форму
        form.submit();
    }
}
