document.querySelectorAll('oembed[url]').forEach(el => {
    const url = el.getAttribute('url');
    if (url.includes("youtube.com/watch?v=")) {
      const embedUrl = url.replace("watch?v=", "embed/");
      const wrapper = document.createElement('div');
      wrapper.classList.add('video-responsive');
  
      const iframe = document.createElement('iframe');
      iframe.setAttribute('src', embedUrl);
      iframe.setAttribute('frameborder', '0');
      iframe.setAttribute('allowfullscreen', '');
  
      wrapper.appendChild(iframe);
      el.replaceWith(wrapper);
    }
  });
  