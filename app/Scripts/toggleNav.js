const toggleBtn = document.getElementById('toggleSidebar');
const closeMenuBtn = document.getElementById('closeMenuBtn');
const sidebar = document.querySelector('.sidebar');


toggleBtn.addEventListener('click', () => {
  sidebar.classList.toggle('open');
  if (sidebar.classList.contains('open')) {

    sidebar.setAttribute("aria-hidden", false);
    closeMenuBtn.setAttribute('aria-expanded', true);
  } else {

    sidebar.setAttribute("aria-hidden", true);
    closeMenuBtn.setAttribute('aria-expanded', false);
  }
});

//close sidebar with closeMenuBtn
closeMenuBtn.addEventListener('click', () => {
  sidebar.classList.remove('open');
  sidebar.setAttribute("aria-hidden", true);
  toggleBtn.setAttribute('aria-expanded', false);
  closeMenuBtn.setAttribute('aria-expanded', false);
});

