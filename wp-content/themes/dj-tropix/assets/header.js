(function () {
  var header = document.querySelector('.site-header');
  if (!header) return;
  var mixesSection = document.getElementById('mixes');

  function updateHeader() {
    if (window.scrollY > 0) {
      header.classList.add('site-header--scrolled');
    } else {
      header.classList.remove('site-header--scrolled');
    }
  }

  updateHeader();
  window.addEventListener('scroll', updateHeader, { passive: true });

  function scrollToMixes(event) {
    if (!mixesSection) return;
    event.preventDefault();
    mixesSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }

  // Standard anchor target.
  var mixesLinks = document.querySelectorAll('a[href="#mixes"]');
  mixesLinks.forEach(function (link) {
    link.addEventListener('click', scrollToMixes);
  });

  // Fallback: header "Listen Now" links that still point to "#".
  var headerLinks = header.querySelectorAll('a[href="#"]');
  headerLinks.forEach(function (link) {
    if (link.textContent && link.textContent.trim().toLowerCase() === 'listen now') {
      link.setAttribute('href', '#mixes');
      link.addEventListener('click', scrollToMixes);
    }
  });
})();
