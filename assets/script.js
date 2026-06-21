/* php-generador-mailto - script.js */
(function(){
  'use strict';
  document.querySelectorAll('[data-copy]').forEach(btn => {
    btn.addEventListener('click', async () => {
      const target = document.getElementById(btn.dataset.copy);
      if (!target) return;
      try {
        await navigator.clipboard.writeText(target.textContent);
        const o = btn.textContent;
        btn.textContent = '✅ Copiado!';
        setTimeout(() => btn.textContent = o, 1500);
      } catch(e) { alert('No se pudo copiar. Selecciona manualmente.'); }
    });
  });
})();