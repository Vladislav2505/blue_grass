let fileInput = document.getElementById('fileInput');

if (fileInput) {
    let loadedFile = document.getElementById('loadedFile');
    let fileList = document.getElementById('fileList');

    fileInput?.addEventListener('change', handleFileInputChange);

    function handleFileInputChange() {
        if (this.files.length < 1) {
            return
        }

        loadedFile.value = null;
        fileList.innerHTML = '';

        for (let i = 0; i < this.files.length; i++) {
            const fileListItem = createFileListItem(this.files[i]);
            fileList.appendChild(fileListItem);
        }
    }

    function createFileListItem(file) {
        const listItem = document.createElement('p');
        listItem.classList.add('text-secondary');
        listItem.innerText = file.name;

        return listItem;
    }
}
