<!-- hämtar content som finns på sidan "shop" och visar detta -->
<?php get_header();
get_template_part('partials/navbar'); ?>

<div class="container">
  <div class="columns is-centered">
    <div class="column is-three-quarters">
      <?php
      if ( have_posts() ) {
      	while ( have_posts() ) {
      		the_post();
          the_content();
      	} // end while
      } // end if
      ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
