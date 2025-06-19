const toggleBtn = document.getElementById('toggleside-nav');
const closeMenuBtn = document.getElementById('closeMenuBtn');
const sideNav = document.querySelector('.side-nav');


toggleBtn.addEventListener('click', () => {
  sideNav.classList.toggle('open');
  if (side - nav.classList.contains('open')) {

    sideNav.setAttribute("aria-hidden", false);
    closeMenuBtn.setAttribute('aria-expanded', true);
  } else {

    sideNav.setAttribute("aria-hidden", true);
    closeMenuBtn.setAttribute('aria-expanded', false);
  }
});

//close side-nav with closeMenuBtn
closeMenuBtn.addEventListener('click', () => {
  sideNav.classList.remove('open');
  sideNav.setAttribute("aria-hidden", true);
  toggleBtn.setAttribute('aria-expanded', false);
  closeMenuBtn.setAttribute('aria-expanded', false);
});

