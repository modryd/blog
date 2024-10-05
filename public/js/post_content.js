document.getElementById('fill-random').addEventListener('click', async function() {
    const titleElement = document.getElementById('title');
    const contentElement = document.getElementById('content');

    // Verify dataset.url
    if (!this.dataset.url) {
        console.error('Missing dataset.url');
        titleElement.value = 'Missing dataset.url';
        return;
    }

    try {
        const response = await fetch(this.dataset.url);
        const data = await response.json();

        titleElement.value = data.title;
        contentElement.value = data.content;
    } catch (error) {
        const msg = 'Error fetching ' + this.dataset.url + ': ' + error.message;
        console.error(msg);
        titleElement.value = msg;
    }
});
