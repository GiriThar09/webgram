// Simple, robust navbar toggler (vanilla JS)
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.navbar-toggler').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var targetSelector = btn.getAttribute('data-bs-target') || btn.getAttribute('data-target');
      if (!targetSelector) return;
      try {
        var target = document.querySelector(targetSelector);
        if (!target) return;
        target.classList.toggle('show');
        var expanded = btn.getAttribute('aria-expanded') === 'true';
        btn.setAttribute('aria-expanded', (!expanded).toString());
      } catch (e) {
        console.error('Navbar toggler error:', e);
      }
    });
  });
});
