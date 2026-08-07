/**
 * Onzehonze — révélations au scroll, sans dépendance.
 * Réutilise les attributs data-reveal-* posés dans les Twig :
 *   data-reveal-from="left|right|up|down"  (direction, gérée en CSS)
 *   data-reveal-delay="0.1"                (secondes, cascade)
 *   data-reveal-stagger="0.08"             (secondes, sur un groupe voisin)
 *   data-reveal-once="false"               (rejoue à chaque passage ; défaut : une fois)
 */
(function () {
  var els = document.querySelectorAll('.js-reveal');
  if (!els.length) return;

  // Fallback navigateurs sans IntersectionObserver : on montre tout
  if (!('IntersectionObserver' in window)) {
    els.forEach(function (el) { el.classList.add('is-visible'); });
    return;
  }

  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      var el = entry.target;
      if (entry.isIntersecting) {
        var delay = parseFloat(el.getAttribute('data-reveal-delay')) || 0;
        el.style.transitionDelay = delay + 's';
        el.classList.add('is-visible');
        if (el.getAttribute('data-reveal-once') !== 'false') io.unobserve(el);
      } else if (el.getAttribute('data-reveal-once') === 'false') {
        el.classList.remove('is-visible');
      }
    });
  }, { threshold: 0.15, rootMargin: '0px 0px -10% 0px' });

  els.forEach(function (el) { io.observe(el); });
})();
