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
});
