## Use constant for easy path navigation
make a <?php echo ROOT?> to point to a ROOT constant
``const ROOT = "http://localhost";``
or use define function to create the ROOT

so ``<img src="<?php echo ROOT?>/pathtofolder/img">``
you must use this convention for loading css and js files as well.

when using it online, you will have to change it to pint to your actual url
lijk "https://meetand.com/"

## Use content security policy
find out how you can include this into the project
what is SRI in security

## cross site request forgery
find out how you can include this into the project

## add sidebar toggle

/* Reset */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

/* Layout container */
.container {
  display: flex;
  height: 100vh;
  overflow: hidden;
}

/* Sidebar (left pane) */
.sidebar {
  width: 250px;
  background: #f4f4f4;
  padding: 1rem;
  flex-shrink: 0;
}

/* Content (right pane) */
.content {
  flex: 1;
  overflow-y: auto;
  padding: 1rem;
  background: #fff;
}

/* Toggle button only on mobile */
.mobile-toggle {
  display: none;
  position: fixed;
  top: 1rem;
  left: 1rem;
  z-index: 1000;
  padding: 0.5rem 1rem;
  font-size: 1.2rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .mobile-toggle {
    display: block;
  }

  .container {
    flex-direction: column;
  }

  .sidebar {
    position: fixed;
    top: 0;
    left: -250px;
    width: 250px;
    height: 100vh;
    background: #f4f4f4;
    transition: left 0.3s ease-in-out;
    z-index: 999;
  }

  .sidebar.open {
    left: 0;
  }

  .content {
    height: 100vh;
    overflow-y: auto;
    flex: 1;
  }
}
<script>
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.querySelector('.sidebar');
    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('open');
    });
  </script>



