<nav>
  <section class="hero nav-menu">
    <div class="navbar">
      <div class="navbar-item">
        <?php
          wp_nav_menu(
            array(
              'theme_location'  => 'header-menu',
              'menu'            => 'Header-meny',
              'walker'          => new Bulmascores_Nav_Walker(),
              'container'       => false,
              'items_wrap'      => '<div class="navbar-start">%3$s</div>',
            )
          );
          ?>
      </div>

        <div class="navbar-end">
          <div class="navbar-item">
      		    <a class="logo" href="">
      				  <?php the_field('header', 'option'); ?>
      		    </a>
          </div>
        </div>
    </div>
  </section>
</nav>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // Get all "navbar-burger" elements
  const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
  // Check if there are any navbar burgers
  if ($navbarBurgers.length > 0) {
    // Add a click event on each of them
    $navbarBurgers.forEach( el => {
      el.addEventListener('click', () => {
        // Get the target from the "data-target" attribute
        const target = el.dataset.target;
        const $target = document.getElementById(target);
        // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
        el.classList.toggle('is-active');
        $target.classList.toggle('is-active');
      });
    });
  }
});
</script>
