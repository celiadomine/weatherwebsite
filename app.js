document.addEventListener('DOMContentLoaded', () => {
    const cityLinks = document.querySelectorAll('a[data-lat]');
    const unitLinks = document.querySelectorAll('a[data-unit]');
    const contentDiv = document.getElementById('content');

    function addLinkEventListeners(links) {
        links.forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                const url = link.getAttribute('href');
                loadContent(url, link);
            });
        });
    }

    addLinkEventListeners(cityLinks);
    addLinkEventListeners(unitLinks);

    function loadContent(url, activeLink) {
        fetch(url)
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newContent = doc.getElementById('content').innerHTML;
                contentDiv.innerHTML = newContent;
                history.pushState(null, '', url); // Update the URL without reloading the page
                applyActiveLink(activeLink);
            })
            .catch(error => {
                console.error('Error loading content:', error);
                contentDiv.innerHTML = '<p>Sorry, an error occurred.</p>';
            });
    }

    function applyActiveLink(activeLink) {
        if (activeLink.hasAttribute('data-lat')) {
            document.querySelectorAll('a[data-lat]').forEach(link => {
                link.classList.remove('active-link');
            });
        } else if (activeLink.hasAttribute('data-unit')) {
            document.querySelectorAll('a[data-unit]').forEach(link => {
                link.classList.remove('active-link');
            });
        }
        activeLink.classList.add('active-link');
    }

    window.addEventListener('popstate', () => {
        loadContent(location.href, null);
    });
});
