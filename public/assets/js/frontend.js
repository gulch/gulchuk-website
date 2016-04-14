document.addEventListener("DOMContentLoaded", function() {
    var toggle = document.getElementById('header-toggle');
    var menu = document.getElementById('header-menu');

    toggle.addEventListener("click", function () {
        if(this.classList.contains('is-active')) {
            this.classList.remove('is-active');
        } else {
            this.classList.add('is-active');
        }

        if(menu.classList.contains('is-active')) {
            menu.classList.remove('is-active');
        } else {
            menu.classList.add('is-active');
        }
    });
});

