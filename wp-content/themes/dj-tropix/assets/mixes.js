(function () {
  var cards = document.querySelectorAll('.dj-mix-card[data-media-url]');
  if (!cards.length) return;

  function stopAll() {
    cards.forEach(function (card) {
      var iframe = card.querySelector('.dj-mix-iframe');
      if (iframe) {
        iframe.src = 'about:blank';
        iframe.style.display = 'none';
      }
      var video = card.querySelector('.dj-mix-video');
      if (video) {
        try {
          video.pause();
        } catch (e) {}
        video.style.display = 'none';
        video.removeAttribute('src');
        var source = video.querySelector('source');
        if (source) source.src = '';
        try {
          video.load();
        } catch (e) {}
      }
      card.classList.remove('is-mp4');
      card.classList.remove('is-playing');
    });
  }

  function detectTypeFromUrl(url) {
    var u = (url || '').toLowerCase();
    if (u.indexOf('youtube.com') !== -1 || u.indexOf('youtu.be') !== -1) return 'youtube';
    if (u.indexOf('soundcloud.com') !== -1) return 'soundcloud';
    if (u.indexOf('mixcloud.com') !== -1) return 'mixcloud';
    if (u.match(/\.mp4(\?.*)?$/)) return 'mp4';
    return '';
  }

  function buildIframeSrc(type, mediaUrl, youtubeId) {
    if (type === 'youtube') {
      return (
        'https://www.youtube.com/embed/' +
        encodeURIComponent(youtubeId || '') +
        '?autoplay=1&rel=0&modestbranding=1'
      );
    }
    if (type === 'soundcloud') {
      return (
        'https://w.soundcloud.com/player/?url=' +
        encodeURIComponent(mediaUrl) +
        '&auto_play=true'
      );
    }
    if (type === 'mixcloud') {
      return (
        'https://www.mixcloud.com/widget/iframe/?hide_cover=1&light=0&autoplay=1&feed=' +
        encodeURIComponent(mediaUrl)
      );
    }
    return '';
  }

  cards.forEach(function (card) {
    var mediaUrl = card.getAttribute('data-media-url') || '';
    var mediaType = card.getAttribute('data-media-type') || detectTypeFromUrl(mediaUrl);
    var videoId = card.getAttribute('data-youtube-id') || '';
    if (!mediaUrl || !mediaType) return;

    var iframe = card.querySelector('.dj-mix-iframe');
    var video = card.querySelector('.dj-mix-video');
    var button = card.querySelector('.dj-mix-play-button button');
    if (!button) return;

    button.addEventListener('click', function () {
      stopAll();
      card.classList.add('is-playing');
      if (mediaType === 'mp4') {
        if (!video) return;
        card.classList.add('is-mp4');
        var source = video.querySelector('source');
        if (source) source.src = mediaUrl;
        try {
          video.load();
        } catch (e) {}
        video.style.display = 'block';
        try {
          video.play();
        } catch (e) {}
        return;
      }

      if (!iframe) return;
      var src = buildIframeSrc(mediaType, mediaUrl, videoId);
      if (!src) return;
      iframe.style.display = 'block';
      iframe.src = src;
    });
  });
})();

