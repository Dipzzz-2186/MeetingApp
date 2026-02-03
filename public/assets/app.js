document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.card').forEach((el, idx) => {
    el.classList.add('reveal');
    el.style.animationDelay = `${idx * 80}ms`;
  });

  const openBtn = document.querySelector('[data-open-plan]');
  const closeBtn = document.querySelector('[data-close-plan]');
  const modal = document.querySelector('[data-modal]');
  if (openBtn && modal) {
    openBtn.addEventListener('click', () => {
      modal.classList.add('open');
    });
  }
  if (closeBtn && modal) {
    closeBtn.addEventListener('click', () => {
      modal.classList.remove('open');
    });
  }
  if (modal) {
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.classList.remove('open');
      }
    });
  }

  const planRadios = document.querySelectorAll('input[name="plan_type"]');
  const payNow = document.querySelector('input[name="pay_now"]');
  if (planRadios.length && payNow) {
    const sync = () => {
      const selected = document.querySelector('input[name="plan_type"]:checked');
      const isTrial = selected && selected.value === 'trial';
      payNow.disabled = isTrial;
      if (isTrial) {
        payNow.checked = false;
      }
    };
    planRadios.forEach((r) => r.addEventListener('change', sync));
    sync();
  }

  const tabbar = document.querySelector('.tabbar');
  if (tabbar) {
    const indicator = tabbar.querySelector('.tab-indicator');
    const updateIndicator = () => {
      const active = tabbar.querySelector('.tab.active') || tabbar.querySelector('.tab');
      if (!indicator || !active) {
        return;
      }
      const styles = getComputedStyle(tabbar);
      const size = parseFloat(styles.getPropertyValue('--tab-indicator-size')) || 40;
      const offsetVar = parseFloat(styles.getPropertyValue('--tab-indicator-offset')) || 0;
      const tabRect = active.getBoundingClientRect();
      const barRect = tabbar.getBoundingClientRect();
      const offsetX = tabRect.left - barRect.left + (tabRect.width - size) / 2 + offsetVar;
      indicator.style.width = `${size}px`;
      indicator.style.height = `${size}px`;
      indicator.style.transform = `translateX(${offsetX}px)`;
    };
    const rafUpdate = () => requestAnimationFrame(updateIndicator);
    rafUpdate();
    window.addEventListener('resize', rafUpdate);
    window.addEventListener('load', rafUpdate);
    setTimeout(rafUpdate, 120);
    setTimeout(rafUpdate, 300);
    if ('fonts' in document) {
      document.fonts.ready.then(rafUpdate);
    }
    if ('ResizeObserver' in window) {
      const ro = new ResizeObserver(rafUpdate);
      ro.observe(tabbar);
    }
  }
});
