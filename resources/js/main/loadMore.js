document.addEventListener('DOMContentLoaded', function () {
    const loadMoreButton = document.getElementById('loadMoreButton');
    const listContent = document.getElementById('listContent');

    if (loadMoreButton) {
        loadMoreButton.addEventListener('click', function () {
            const nextPage = Number(loadMoreButton.dataset.page);
            const url = loadMoreButton.dataset.url + `?page=${nextPage}`;

            axios.get(url)
                .then(response => {
                    const content = response.data.content;

                    if (content) {
                        listContent.insertAdjacentHTML('beforeend', content);
                        loadMoreButton.dataset.page = nextPage + 1;
                    }

                    if (!response.data.content || !response.data.next) {
                        document.getElementById('loadMoreContainer').remove()
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    }
})
