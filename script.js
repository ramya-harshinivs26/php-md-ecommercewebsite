

document.addEventListener("DOMContentLoaded", function() {
    // Responsive Navigation Menu
    const navToggle = document.querySelector(".nav-toggle");
    const navMenu = document.querySelector(".nav ul");

    navToggle.addEventListener("click", () => {
        navMenu.classList.toggle("nav-visible");
    });



    // Image Slider for Hero Section
    let currentSlide = 0;
    const slides = document.querySelectorAll(".hero-content img");
    const totalSlides = slides.length;

    const nextSlide = () => {
        slides[currentSlide].classList.remove("active");
        currentSlide = (currentSlide + 1) % totalSlides;
        slides[currentSlide].classList.add("active");
    };

    setInterval(nextSlide, 3000); // Change slide every 3 seconds

    // Smooth Scrolling for Anchor Links
    const scrollLinks = document.querySelectorAll('a[href^="#"]');

    for (let link of scrollLinks) {
        link.addEventListener("click", function(event) {
            event.preventDefault();

            const targetId = this.getAttribute("href").substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop,
                    behavior: "smooth"
                });
            }
        });
    }
});


document.addEventListener("DOMContentLoaded", function() {
    // Responsive Navigation Menu
    const navToggle = document.querySelector(".nav-toggle");
    const navMenu = document.querySelector(".nav ul");

    navToggle.addEventListener("click", () => {
        navMenu.classList.toggle("nav-visible");
    });
});

document.addEventListener("DOMContentLoaded", function() {
    // Responsive Navigation Menu
    const navToggle = document.querySelector(".nav-toggle");
    const navMenu = document.querySelector(".nav ul");

    navToggle.addEventListener("click", () => {
        navMenu.classList.toggle("nav-visible");
    });

    // Smooth Scrolling for Anchor Links
    const scrollLinks = document.querySelectorAll('a[href^="#about"]');

    for (let link of scrollLinks) {
        link.addEventListener("click", function(event) {
            event.preventDefault();

            const targetId = this.getAttribute("href").substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop,
                    behavior: "smooth"
                });
            }
        });
    }
});


/*checkout page*/

document.addEventListener("DOMContentLoaded", function() {
    // Handle responsive navigation toggle
    const nav = document.querySelector('nav ul');
    const navToggle = document.createElement('button');
    navToggle.innerText = 'Menu';
    navToggle.setAttribute('aria-expanded', 'false');
    navToggle.classList.add('nav-toggle');
    document.querySelector('header').insertBefore(navToggle, nav);

    navToggle.addEventListener('click', function() {
        const expanded = navToggle.getAttribute('aria-expanded') === 'true' || false;
        navToggle.setAttribute('aria-expanded', !expanded);
        nav.classList.toggle('visible');
    });

    // Make sure nav visibility is adjusted on window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            nav.classList.remove('visible');
            navToggle.setAttribute('aria-expanded', 'false');
        }
    });
});
