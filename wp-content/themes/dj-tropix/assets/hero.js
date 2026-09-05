(function () {
  var section = document.getElementById('hero');
  if (!section) return;

  var slides = section.querySelectorAll('.dj-hero-slide');
  var dots = section.querySelectorAll('.dj-hero-dot');
  if (slides.length <= 1) return;

  var current = 0;
  var interval = 5000;
  var timer = null;

  function goTo(index) {
    current = (index + slides.length) % slides.length;
    slides.forEach(function (s, i) {
      s.classList.toggle('is-active', i === current);
    });
    dots.forEach(function (d, i) {
      d.classList.toggle('is-active', i === current);
    });
  }

  function next() {
    goTo(current + 1);
  }

  function startTimer() {
    if (timer) clearInterval(timer);
    timer = setInterval(next, interval);
  }

  dots.forEach(function (dot, i) {
    dot.addEventListener('click', function () {
      goTo(i);
      startTimer();
    });
  });

  startTimer();
})();

/* Scroll-based visual effects on hero section */
(function () {
  var section = document.getElementById('hero');
  if (!section) return;

  var overlays = section.querySelectorAll('.dj-hero-overlay');
  var inners = section.querySelectorAll('.dj-hero-inner');
  var bgImages = section.querySelectorAll('.dj-hero-bg-image');

  var ticking = false;
  var parallaxFactor = 0.45;

  function clamp(val, min, max) {
    return Math.min(Math.max(val, min), max);
  }

  function updateScrollEffects() {
    var heroHeight = section.offsetHeight;
    var heroTop = section.offsetTop;
    var scrollY = window.scrollY || window.pageYOffset;

    /* Progress 0 = top of hero, 1 = bottom of hero scrolled past */
    var scrollIntoHero = scrollY - heroTop;
    var progress = clamp(scrollIntoHero / heroHeight, 0, 1);

    /* 1. Overlay opacity: 0.35 at top -> 0.9 at bottom */
    var overlayOpacity = 0.35 + progress * 0.55;
    overlays.forEach(function (el) {
      el.style.opacity = String(overlayOpacity);
    });

    /* 2. Hero text fade: 1 at top -> 0.2 at bottom */
    var textOpacity = 1 - progress * 0.8;
    inners.forEach(function (el) {
      el.style.opacity = String(textOpacity);
    });

    /* 3. Parallax: bg moves at ~45% of scroll speed, clamped to hero */
    var parallaxY = clamp(scrollIntoHero, 0, heroHeight) * parallaxFactor;
    bgImages.forEach(function (el) {
      el.style.transform = 'translateY(' + parallaxY + 'px)';
    });

    ticking = false;
  }

  function requestTick() {
    if (ticking) return;
    ticking = true;
    requestAnimationFrame(updateScrollEffects);
  }

  window.addEventListener('scroll', requestTick, { passive: true });
  window.addEventListener('resize', requestTick);
  requestTick();
})();

/* Smooth scroll for hero button hash links */
(function () {
  var heroSection = document.getElementById('hero');
  if (!heroSection) return;

  var hashLinks = heroSection.querySelectorAll('.dj-hero-buttons a[href^="#"]');

  hashLinks.forEach(function (link) {
    link.addEventListener('click', function (event) {
      var href = link.getAttribute('href');
      if (!href || href === '#') return;

      var target = document.querySelector(href);
      if (!target) return;

      event.preventDefault();
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  });
})();
