document.addEventListener('DOMContentLoaded', function () {
    var imageSelectors = [
        '.entry-content .wp-block-gallery img',
        '.entry-content .blocks-gallery-grid img',
        '.entry-content .wp-block-image img'
    ];
    var images = Array.prototype.slice.call(document.querySelectorAll(imageSelectors.join(', ')));

    if (!images.length) {
        return;
    }

    var modal = document.createElement('div');
    modal.className = 'oconee-lightbox';
    modal.setAttribute('hidden', 'hidden');
    modal.innerHTML = [
        '<div class="oconee-lightbox__backdrop" data-lightbox-close="true"></div>',
        '<div class="oconee-lightbox__dialog" role="dialog" aria-modal="true" aria-label="Expanded image">',
        '<button class="oconee-lightbox__close" type="button" aria-label="Close image viewer">&times;</button>',
        '<button class="oconee-lightbox__nav oconee-lightbox__nav--prev" type="button" aria-label="Previous image">&#10094;</button>',
        '<figure class="oconee-lightbox__figure">',
        '<img class="oconee-lightbox__image" alt="" />',
        '<figcaption class="oconee-lightbox__caption"></figcaption>',
        '</figure>',
        '<button class="oconee-lightbox__nav oconee-lightbox__nav--next" type="button" aria-label="Next image">&#10095;</button>',
        '</div>'
    ].join('');

    document.body.appendChild(modal);

    var backdrop = modal.querySelector('.oconee-lightbox__backdrop');
    var dialog = modal.querySelector('.oconee-lightbox__dialog');
    var dialogImage = modal.querySelector('.oconee-lightbox__image');
    var dialogCaption = modal.querySelector('.oconee-lightbox__caption');
    var closeButton = modal.querySelector('.oconee-lightbox__close');
    var prevButton = modal.querySelector('.oconee-lightbox__nav--prev');
    var nextButton = modal.querySelector('.oconee-lightbox__nav--next');
    var currentGroup = [];
    var currentIndex = 0;

    function getImageUrl(image) {
        var link = image.closest('a');
        var href = link ? link.getAttribute('href') : '';

        if (href && /\.(avif|gif|jpe?g|png|webp|svg)(\?.*)?$/i.test(href)) {
            return href;
        }

        return image.currentSrc || image.src || '';
    }

    function getCaption(image) {
        var figure = image.closest('figure');
        var figcaption = figure ? figure.querySelector('figcaption') : null;

        if (figcaption && figcaption.textContent.trim()) {
            return figcaption.textContent.trim();
        }

        return image.getAttribute('alt') || '';
    }

    function getGroup(image) {
        var gallery = image.closest('.wp-block-gallery, .blocks-gallery-grid');

        if (!gallery) {
            return [image];
        }

        return Array.prototype.slice.call(gallery.querySelectorAll('img'));
    }

    function updateNav() {
        var multiple = currentGroup.length > 1;
        prevButton.hidden = false;
        nextButton.hidden = false;
        prevButton.disabled = !multiple || currentIndex <= 0;
        nextButton.disabled = !multiple || currentIndex >= currentGroup.length - 1;
    }

    function renderImage(index) {
        currentIndex = index;

        var image = currentGroup[currentIndex];
        dialogImage.src = getImageUrl(image);
        dialogImage.alt = image.getAttribute('alt') || '';

        var caption = getCaption(image);
        dialogCaption.textContent = caption;
        dialogCaption.hidden = !caption;

        updateNav();
    }

    function openLightbox(image) {
        currentGroup = getGroup(image);
        currentIndex = Math.max(currentGroup.indexOf(image), 0);

        renderImage(currentIndex);
        modal.hidden = false;
        document.body.classList.add('oconee-lightbox-open');
        closeButton.focus();
    }

    function closeLightbox() {
        modal.hidden = true;
        dialogImage.removeAttribute('src');
        document.body.classList.remove('oconee-lightbox-open');
    }

    function showPrevious() {
        if (currentIndex <= 0) {
            return;
        }

        renderImage(currentIndex - 1);
    }

    function showNext() {
        if (currentIndex >= currentGroup.length - 1) {
            return;
        }

        renderImage(currentIndex + 1);
    }

    images.forEach(function (image) {
        image.classList.add('oconee-lightbox-trigger');

        image.addEventListener('click', function (event) {
            event.preventDefault();
            openLightbox(image);
        });

        var parentLink = image.closest('a');
        if (parentLink) {
            parentLink.addEventListener('click', function (event) {
                event.preventDefault();
                openLightbox(image);
            });
        }
    });

    modal.addEventListener('click', function (event) {
        if (
            event.target.closest('.oconee-lightbox__figure') ||
            event.target.closest('.oconee-lightbox__nav') ||
            event.target.closest('.oconee-lightbox__close')
        ) {
            return;
        }

        if (!modal.hidden) {
            closeLightbox();
        }
    });

    closeButton.addEventListener('click', function () {
        closeLightbox();
    });

    prevButton.addEventListener('click', function () {
        showPrevious();
    });

    nextButton.addEventListener('click', function () {
        showNext();
    });

    document.addEventListener('keydown', function (event) {
        if (modal.hidden) {
            return;
        }

        if (event.key === 'Escape') {
            closeLightbox();
        } else if (event.key === 'ArrowLeft' && currentGroup.length > 1) {
            showPrevious();
        } else if (event.key === 'ArrowRight' && currentGroup.length > 1) {
            showNext();
        }
    });
});
