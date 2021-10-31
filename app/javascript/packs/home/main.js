(() => {
  const mains = document.querySelectorAll(".main_menu_inner");

  const cb = function(entries, observer) {
    entries.forEach(entry => {
      if ( ! entry.isIntersecting ) return;
        observer.unobserve(entry.target);
    });
  }

  const io = new IntersectionObserver(cb);
  mains.forEach(el => io.observe(el))
  
})();