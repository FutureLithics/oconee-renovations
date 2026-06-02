document.addEventListener('DOMContentLoaded', function () {
    var button = document.querySelector('.archive-listing__load-more');
    var grid = document.querySelector('.archive-listing__grid');

    if (!button || !grid) {
        return;
    }

    var originalLabel = button.textContent.trim();
    var loading = false;

    function setLoadingState(isLoading) {
        loading = isLoading;
        button.classList.toggle('is-loading', isLoading);
        button.setAttribute('aria-busy', isLoading ? 'true' : 'false');
        button.textContent = isLoading ? 'Loading...' : originalLabel;
    }

    function removeButton() {
        var wrap = button.closest('.archive-listing__cta-wrap');

        if (wrap) {
            wrap.remove();
        } else {
            button.remove();
        }
    }

    button.addEventListener('click', function (event) {
        if (loading) {
            event.preventDefault();
            return;
        }

        event.preventDefault();

        var nextUrl = button.getAttribute('href');

        if (!nextUrl) {
            removeButton();
            return;
        }

        setLoadingState(true);

        fetch(nextUrl, {
            credentials: 'same-origin'
        })
            .then(function (response) {
                if (!response.ok) {
                    throw new Error('Failed to load more archive items.');
                }

                return response.text();
            })
            .then(function (html) {
                var parser = new DOMParser();
                var doc = parser.parseFromString(html, 'text/html');
                var newCards = doc.querySelectorAll('.archive-listing__grid .archive-listing__card');
                var nextButton = doc.querySelector('.archive-listing__load-more');

                if (!newCards.length) {
                    removeButton();
                    return;
                }

                newCards.forEach(function (card) {
                    grid.appendChild(card);
                });

                if (nextButton) {
                    button.setAttribute('href', nextButton.getAttribute('href'));
                    setLoadingState(false);
                } else {
                    removeButton();
                }
            })
            .catch(function () {
                setLoadingState(false);
                window.location.href = nextUrl;
            });
    });
});
