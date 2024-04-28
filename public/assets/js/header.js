document.addEventListener('DOMContentLoaded', function() {
    var links = document.querySelectorAll('.navbar-dark .navbar-nav .nav-link');

    links.forEach(function(link) {
        // Перевіряємо, чи URL поточної сторінки збігається з URL посилання
        if (link.href === window.location.href) {
            // Якщо збігається, додаємо клас для підкреслення посилання
            link.classList.add('underline');
        }
    });
});
