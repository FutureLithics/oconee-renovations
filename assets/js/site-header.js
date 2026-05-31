document.addEventListener('DOMContentLoaded', function () {
    var button = document.querySelector('.site-header-menu-toggle');
    var panel = document.querySelector('.site-header .header-right');

    if (!button || !panel) {
        return;
    }

    var breakpoint = window.matchMedia('(max-width: 1024px)');
    var menuLinks = panel.querySelectorAll('a');

    function setMenuOpen(isOpen) {
        button.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        button.setAttribute('aria-label', isOpen ? 'Close menu' : 'Open menu');
        document.body.classList.toggle('mobile-menu-open', isOpen);
    }

    button.addEventListener('click', function () {
        setMenuOpen(button.getAttribute('aria-expanded') !== 'true');
    });

    menuLinks.forEach(function (link) {
        link.addEventListener('click', function () {
            if (breakpoint.matches) {
                setMenuOpen(false);
            }
        });
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            setMenuOpen(false);
        }
    });

    breakpoint.addEventListener('change', function (event) {
        if (!event.matches) {
            setMenuOpen(false);
        }
    });
});
